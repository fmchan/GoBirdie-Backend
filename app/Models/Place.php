<?php

namespace App\Models;

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
class Place extends GenericModel
{
    public function __construct(array $attributes = [])
    {
        $this->table = 'places';
        $this->image_dir = 'place_images';
        $fillable = [
            'organization',
            'age_start',
            'age_end',
            'opening_hours',
            'fee_number',
            'areas'
        ];
        $casts = [
            'organization' => 'integer',
            'age_start' => 'integer',
            'age_end' => 'integer',
            'opening_hours' => 'string',
            'fee_number' => 'integer',
            'areas' => 'string'
        ];
        //$rules = [];
        $this->fillable = array_merge($this->fillable, $fillable);
        $this->casts = array_merge($this->casts, $casts);
        //self::$rules = array_merge(self::$rules, $rules);

        parent::__construct($attributes);
    }

    public function getCategories() {
        if (empty($this->categories)) return null;
        return $this->keysToValues($this->categories, Category_place::pluck('name','id')->toArray());
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function organizationObj()
    {
        return $this->belongsTo(\App\Models\Organization::class, 'organization');
    }
}
