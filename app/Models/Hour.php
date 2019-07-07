<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Hour
 * @package App\Models
 * @version June 19, 2019, 3:24 am UTC
 *
 * @property string name
 * @property integer rank
 * @property string status
 */
class Hour extends Model
{
    use SoftDeletes;

    public $table = 'hours';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
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
        'rank' => 'required'
    ];

    
}
