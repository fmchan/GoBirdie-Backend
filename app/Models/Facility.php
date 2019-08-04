<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Facility
 * @package App\Models
 * @version June 7, 2019, 4:19 am UTC
 *
 * @property string name
 * @property string icon
 * @property integer rank
 * @property string status
 */
class Facility extends Model
{
    use SoftDeletes;

    public $table = 'facilities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'icon',
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
        'icon' => 'string',
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
        'rank' => 'required',
        //'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024'
    ];

    
}
