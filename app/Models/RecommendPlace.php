<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RecommendPlace
 * @package App\Models
 * @version September 25, 2019, 3:50 am UTC
 *
 * @property \App\Models\Place place
 * @property integer place_id
 * @property integer rank
 * @property string status
 */
class RecommendPlace extends Model
{
    use SoftDeletes;

    public $table = 'recommend_places';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'place_id',
        'type',
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
        'place_id' => 'integer',
        'type' => 'string',
        'rank' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'place_id' => 'required|exists:places,id',
        'rank' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function place()
    {
        return $this->belongsTo(\App\Models\Place::class, 'place_id');
    }
}
