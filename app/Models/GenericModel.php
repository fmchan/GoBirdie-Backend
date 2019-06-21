<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GenericModel
 * @package App\Models
 */
class GenericModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
