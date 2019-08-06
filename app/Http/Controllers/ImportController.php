<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use File;
use Excel;
use App\Rules\PhotoExist;
use DB;
use App\Models\Article;

class ImportController extends AppBaseController
{
	private $image_dir = 'import_images';

    public function imports() {
    	$files = File::allFiles('uploads/'.$this->image_dir);
    	//print_r($files);
        return view('imports.index')->with(['files'=>$files]);
    }

    public function uploadImages(Request $request) {
        $request->validate([
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg|max:20480'
        ]);
        if ($request->hasFile('photo')) {
            foreach($request->file('photo') as $image) {
                $destinationPath = public_path('uploads/'.$this->image_dir);
                $image->move($destinationPath, $image->getClientOriginalName());
            }
        }
        Flash::success('Images uploaded successfully.');
        return redirect(route('imports.index'));
    }

    public function deleteImage(Request $request) {
        $filename = $request->input('filename');
        File::delete(public_path($filename));
        Flash::success('Photo: '.$filename.' deleted successfully.');
        return redirect(route('imports.index'));
    }

    public function importExcel(Request $request) {
        $request->validate([
            'import_file' => 'required|mimes:xls,xlsx',
            'type' => 'required'
        ]);
        $type = $request->input('type');
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()) {
            $arr = array();
            foreach($data->toArray() as $key => $value) {
                foreach($value as $row) {
                    $a = array(
                     'title'  => $row['title'],
                     'city'  => $row['city'],
                     'district'  => $row['district'],
                     'address'   => $row['address'],
                     'transport_short'   => $row['transport_short'],
                     'transport_long'   => $row['transport_long'],
                     'telephone'   => $row['telephone'],
                     'content'   => $row['content'],
                     'opening'   => $row['opening'],
                     'gps'   => $row['gps'],
                     'fee'   => $row['fee'],
                     'book'   => $row['book'],
                     'email'   => $row['email'],
                     'website'   => $row['website'],
                     'rank'   => $row['rank'],
                     'status'   => $row['status'],

                     'category'  => (empty($row['categories'])) ? null : explode(',', $row['categories']),
                     'tag_public'  => (empty($row['tags_public'])) ? null : explode(',', $row['tags_public']),
                     'tag_private'  => (empty($row['tags_private'])) ? null : explode(',', $row['tags_private']),
                     'facility'  => (empty($row['facilities'])) ? null : explode(',', $row['facilities']),
                     'photo'  => (empty($row['photos'])) ? null : explode(',', $row['photos']),

                     'categories'  => $row['categories'],
                     'tags_public'  => $row['tags_public'],
                     'tags_private'  => $row['tags_private'],
                     'facilities'  => $row['facilities'],
                     'photos'  => $row['photos'],
                    );

                    if ($type == 'article') {
	                     $a['start']  = $row['start'];
	                     $a['end']  = $row['end'];
                         $a['display']  = $row['display'];
                    } else {
	                     $a['organization']  = $row['organization'];
	                     $a['age_start']  = $row['age_start'];
	                     $a['age_end']  = $row['age_end'];
	                     $a['opening_hours']  = $row['opening_hours'];
	                     $a['fee_number']  = $row['fee_number'];
	                     $a['areas']  = $row['areas'];
                    }

                    $arr[] = $a;
                }
            }

            $r = new Request();
            $r->setMethod('POST');
            $r->request->add($arr);
            $v = [
                "*.title"          => "required",
                "*.city"           => "required|exists:cities,id",
                "*.district"       => "required|exists:districts,id",
                "*.category"     => "required",
                "*.tag_public.*"  => "exists:tags,id",
                "*.tag_private.*" => "exists:tags,id",
                "*.facility.*"   => "exists:facilities,id",
                "*.status" => "required",
                "*.email" => "email",
                "*.address" => "required",
                "*.gps" => "required",
                "*.book" => "required",
                "*.rank" => "required|integer",
                "*.photo.*" => [new PhotoExist],
            ];
            if ($type == 'article') {
                $v["*.start"] = "required|date";
                $v["*.end"] = "required|date";
                $v["*.display"] = "required|date";
                $v["*.category.*"]   = "exists:category_articles,id";
            } else {
                $v["*.organization"] = "exists:organizations,id";
                $v["*.age_start"] = "integer";
                $v["*.age_end"] = "integer";
                $v["*.fee_number"] = "integer";
                $v["*.category.*"]   = "exists:category_places,id";
            }
            $data = $r->validate($v);

            if (!empty($arr)) {
            	$images = array();
            	foreach($arr as $k=>$a) {
					if (!empty($a['photos']))
                		$images = array_merge($images, $a['photo']);
            		unset($arr[$k]['category']);
            		unset($arr[$k]['tag_public']);
            		unset($arr[$k]['tag_private']);
            		unset($arr[$k]['facility']);
            		unset($arr[$k]['photo']);
            		$a['created_at'] = new \DateTime();
            		$a['updated_at'] = new \DateTime();
            	}
            	$images = array_unique($images);
            	foreach($images as $img) {
            		File::copy(public_path('uploads/'.$this->image_dir.'/'.$img), public_path('uploads/'.$type.'_images/'.$img));
            	}
            	//print_r($arr);
                if (DB::table($type == 'article'? 'articles': 'places')->insert($arr)) {
                	foreach($images as $img)
                		File::delete(public_path('uploads/'.$this->image_dir.'/'.$img));
                	Flash::success('Import successfully.');
                } else
                	Flash::error('Import unsuccessfully.');
            }
        }
        return redirect(route('imports.index'));
    }
}