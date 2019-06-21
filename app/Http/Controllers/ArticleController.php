<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Tag;
use App\Models\City;
use App\Models\District;
use App\Models\Facility;
use App\Models\Article;
use App\Models\Place;
use App\Models\Category_article;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class ArticleController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $articles = $this->articleRepository->paginate(10);

        return view('articles.index')
            ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */

    private function pluckData() {
        $data['cities'] = City::where('status','A')->pluck('name','id')->all();
        $data['districts'] = District::where('status','A')->pluck('name','id')->all();
        $data['categories'] = Category_article::where('status','A')->pluck('name','id')->all();
        $data['facilities'] = Facility::where('status','A')->pluck('name','id')->all();
        $data['tags'] = Tag::pluck('name','id')->all();
        $data['articles'] = Article::where('status','A')->pluck('title','id')->all();
        $data['places'] = Place::where('status','A')->pluck('title','id')->all();
        return $data;
    }
    public function create()
    {
        return view('articles.create', $this->pluckData());
    }

    private function editor($content) {
        var_dump(libxml_use_internal_errors(true));

        $dom = new \DomDocument();
        if (!$dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)) {
            foreach (libxml_get_errors() as $error) {
                Flash::error($error);
            }

            libxml_clear_errors();
        }
    
        $images = $dom->getElementsByTagName('img');
        
        // foreach <img> in the submited content
        foreach($images as $img){
            $src = $img->getAttribute('src');
            
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){
                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/uploads/articles/$filename.$mimetype";
    
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)  // encode file to the specified mimetype
                  ->save(public_path($filepath));
                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!--endforeach

        return $dom->saveHTML();
    }

    private function uploadImages(Request $request, $originals = null) {
        if ($request->hasFile('photo')) {
            $data = array();
            foreach($request->file('photo') as $image) {
                $name = md5(uniqid() . time()) . '.' . $image->getClientOriginalExtension();
                
                $destinationPath = public_path('uploads/article_images');
                $image->move($destinationPath, $name);
                array_push($data, $name);
            }
            //print_r($data);
            $photos = implode(",", $data);
            if (!empty($originals))
                $photos = $originals.",".$photos;
        } else
            $photos = $originals;
        return $photos;
    }

    public function deleteImage($id, Request $request) {
        $article = Article::findOrfail($id);

        if (empty($article)) {
            Flash::error('Article not found');
            return redirect(route('articles.index'));
        }
        $filename = $request->input('filename');
        $photos = array();
        if (!empty($article->photos))
            $photos = explode(',', $article->photos);

        //print_r($photos);
        foreach ($photos as $k => $photo)
            if ($photo == $filename)
                unset($photos[$k]);
        $article->photos = implode(',', $photos);
        //print_r($article->photos);
        $article->save();

        File::delete(public_path('/uploads/article_images/'.$filename));
        return redirect(route('articles.show', ['id' => $id]));
    }

    private function arrToStr(Request $request, $field) {
        $arr = $request->input($field);
        if (empty($arr)) return null;
        $request->except($field);
        return implode(',', $arr);
    }

    private function requestToInput(Request $request, $article = null) {
        $input = $request->all();

        $input['photos'] = $this->uploadImages($request, $article->photos);

        foreach($request->input($field) as $item) {
            if (!is_numeric($item)) {
                $tag = new Tag;
                $tag->name = $item;
                $tag->save();
            }
        }
        $input['tags_public'] = $this->arrToStr($request, 'tags_public');
        $input['tags_private'] = $this->arrToStr($request, 'tags_private');
        $input['categories'] = $this->arrToStr($request, 'categories');
        $input['facilities'] = $this->arrToStr($request, 'facilities');
        $input['related_articles'] = $this->arrToStr($request, 'related_articles');
        $input['related_places'] = $this->arrToStr($request, 'related_places');

        $input['content'] = $this->editor($input['content']);

        echo $input['tags_public'];

        return $input;
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $article = $this->articleRepository->create($this->requestToInput($request));

        Flash::success('Article saved successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $data = $this->pluckData();
        $data['article'] = $article;

        return view('articles.edit')->with($data);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param int $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }
        $this->requestToInput($request, $article);
        /*$article = $this->articleRepository->update($this->requestToInput($request, $article), $id);

        Flash::success('Article updated successfully.');

        return redirect(route('articles.index'));*/
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->find($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('Article deleted successfully.');

        return redirect(route('articles.index'));
    }
}
