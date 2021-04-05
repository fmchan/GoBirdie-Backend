<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category_place
 * @package App\Models
 * @version June 7, 2019, 4:18 am UTC
 *
 * @property string name
 * @property integer rank
 * @property string status
 */
class Category_place extends Model
{
    use SoftDeletes;

    public $table = 'category_places';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'icon',
        'rank_home',
        'rank_place',
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
        'icon' => 'string',
        'rank_home' => 'integer',
        'rank_place' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        //'rank_home' => 'required',
        'rank_place' => 'required',
    ];

    
}
