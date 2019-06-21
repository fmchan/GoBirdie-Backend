<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class District
 * @package App\Models
 * @version June 7, 2019, 4:22 am UTC
 *
 * @property \App\Models\City city
 * @property string name
 * @property integer city
 * @property integer rank
 * @property string status
 */
class District extends Model
{
    use SoftDeletes;

    public $table = 'districts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'city',
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
        'name' => 'string',
        'city' => 'integer',
        'rank' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cityObj()
    {
        return $this->belongsTo(\App\Models\City::class, 'city');
    }
}
