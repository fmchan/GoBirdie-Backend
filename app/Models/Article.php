<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * @package App\Models
 * @version June 7, 2019, 4:26 am UTC
 *
 * @property string title
 * @property string start
 * @property string end
 * @property integer city
 * @property integer district
 * @property string categories
 * @property integer heart
 * @property integer bookmark
 * @property string address
 * @property float lat
 * @property float long
 * @property string transport_short
 * @property string transport_long
 * @property string telephone
 * @property boolean book
 * @property string opening
 * @property string fee
 * @property string tags_public
 * @property string tags_private
 * @property string email
 * @property string website
 * @property string content
 * @property string facilities
 * @property string photos
 * @property string related_articles
 * @property string related_places
 * @property integer rank
 * @property string status
 */
class Article extends Model
{
    use SoftDeletes;

    public $table = 'articles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'start',
        'end',
        'city',
        'district',
        'categories',
        'heart',
        'bookmark',
        'address',
        'gps',
        'transport_short',
        'transport_long',
        'telephone',
        'book',
        'opening',
        'fee',
        'tags_public',
        'tags_private',
        'email',
        'website',
        'content',
        'facilities',
        'photos',
        'related_articles',
        'related_places',
        'rank',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'start' => 'date',
        'end' => 'date',
        'city' => 'integer',
        'district' => 'integer',
        'categories' => 'string',
        'heart' => 'integer',
        'bookmark' => 'integer',
        'address' => 'string',
        'gps' => 'string',
        'transport_short' => 'string',
        'transport_long' => 'string',
        'telephone' => 'string',
        'book' => 'boolean',
        'opening' => 'string',
        'fee' => 'string',
        'tags_public' => 'string',
        'tags_private' => 'string',
        'email' => 'string',
        'website' => 'string',
        'content' => 'string',
        'facilities' => 'string',
        'photos' => 'string',
        'related_articles' => 'string',
        'related_places' => 'string',
        'rank' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'start' => 'required',
        'end' => 'required',
        'city' => 'required',
        'district' => 'required',
        'categories' => 'required',
        'address' => 'required',
        'gps' => 'required',
        'book' => 'required',
        'photo.*' => 'image|mimes:jpeg,png,jpg|max:10240'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cityObj()
    {
        return $this->belongsTo(\App\Models\City::class, 'city');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function districtObj()
    {
        return $this->belongsTo(\App\Models\District::class, 'district');
    }

    public function getPhotos() {
        if (empty($this->photos)) return null;
        return explode(",", $this->photos);
    }
    public function resize($i, $w = null, $h = null) {
        $photos = explode(",", $this->photos);
        $path = '/uploads/article_images/'.$photos[$i];
        if ($w == null && $h == null) return url($path);
        $image = '/resizer.php?';
        if ($w > -1) $image .= '&w='.$w;
        if ($h > -1) $image .= '&h='.$h;
        $image .= '&zc=1';
        $image .= '&src='.$path;
        return url($image);
    }

    private function keysToValues($s, $l) {
        $r = array();
        foreach (explode(",",$s) as $v) if (isset($l[$v])) array_push($r, $l[$v]);
        return $r;
    }
    public function getTagsPublic() {
        if (empty($this->tags_public)) return null;
        return $this->keysToValues($this->tags_public, Tag::pluck('name','id')->toArray());
    }
    public function getTagsPrivate() {
        if (empty($this->tags_private)) return null;
        return $this->keysToValues($this->tags_private, Tag::pluck('name','id')->toArray());
    }
    public function getFacilities() {
        if (empty($this->facilities)) return null;
        return $this->keysToValues($this->facilities, Facility::pluck('name','id')->toArray());
    }
    public function getCategories() {
        if (empty($this->categories)) return null;
        return $this->keysToValues($this->categories, Category_article::pluck('name','id')->toArray());
    }
    public function getRelatedArticles() {
        if (empty($this->articles)) return null;
        return $this->keysToValues($this->articles, Article::pluck('title','id')->toArray());
    }
    public function getRelatedPlaces() {
        if (empty($this->places)) return null;
        return $this->keysToValues($this->places, Place::pluck('title','id')->toArray());
    }

}
