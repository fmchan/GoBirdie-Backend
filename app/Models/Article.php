<?php

namespace App\Models;

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
class Article extends GenericModel
{
    public function __construct(array $attributes = [])
    {
        $this->table = 'articles';
        $this->image_dir = 'article_images';

        $fillable = [
            'start',
            'end'
        ];
        $casts = [
            'start' => 'date',
            'end' => 'date'
        ];
        $rules = [
            'start' => 'required',
            'end' => 'required'
        ];
        $this->fillable = array_merge($this->fillable, $fillable);
        $this->casts = array_merge($this->casts, $casts);
        self::$rules = array_merge(self::$rules, $rules);

        parent::__construct($attributes);
    }
    public function getCategories() {
        if (empty($this->categories)) return null;
        return $this->keysToValues($this->categories, Category_article::pluck('name','id')->toArray());
    }
}
