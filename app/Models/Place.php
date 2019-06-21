<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Place
 * @package App\Models
 * @version June 7, 2019, 4:31 am UTC
 *
 * @property \App\Models\City city
 * @property \App\Models\District district
 * @property \App\Models\Organization organization
 * @property string title
 * @property integer city
 * @property integer district
 * @property string categories
 * @property integer organization
 * @property integer heart
 * @property integer bookmark
 * @property string address
 * @property float lat
 * @property float long
 * @property string transport_short
 * @property string transport_long
 * @property string telephone
 * @property integer age_start
 * @property integer age_end
 * @property boolean book
 * @property string opening
 * @property string opening_select
 * @property string fee
 * @property integer fee_number
 * @property string area
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
class Place extends Model
{
    use SoftDeletes;

    public $table = 'places';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'city',
        'district',
        'categories',
        'organization',
        'heart',
        'bookmark',
        'address',
        'gps',
        'transport_short',
        'transport_long',
        'telephone',
        'age_start',
        'age_end',
        'book',
        'opening',
        'opening_hours',
        'fee',
        'fee_number',
        'areas',
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
        'city' => 'integer',
        'district' => 'integer',
        'categories' => 'string',
        'organization' => 'integer',
        'heart' => 'integer',
        'bookmark' => 'integer',
        'address' => 'string',
        'gps' => 'string',
        'transport_short' => 'string',
        'transport_long' => 'string',
        'telephone' => 'string',
        'age_start' => 'integer',
        'age_end' => 'integer',
        'book' => 'boolean',
        'opening' => 'string',
        'opening_hours' => 'string',
        'fee' => 'string',
        'fee_number' => 'integer',
        'areas' => 'string',
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
        'city' => 'required',
        'district' => 'required',
        'categories' => 'required',
        'organization' => 'required',
        'address' => 'required',
        'gps' => 'required',
        'book' => 'required',
        'areas' => 'required',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function organizationObj()
    {
        return $this->belongsTo(\App\Models\Organization::class, 'organization');
    }
}
