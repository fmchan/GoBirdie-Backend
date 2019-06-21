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
    public $table = 'articles';

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
}
