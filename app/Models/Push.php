<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Push
 * @package App\Models
 * @version January 3, 2020, 2:01 pm HKT
 *
 * @property string title
 * @property string body
 * @property string json
 * @property integer ttl
 * @property string image
 * @property string channel
 */
class Push extends Model
{
    use SoftDeletes;

    public $table = 'pushes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'body',
        'json',
        'ttl',
        'image',
        'channel'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'json' => 'string',
        'ttl' => 'integer',
        'image' => 'string',
        'channel' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'body' => 'required|max:225'
    ];

    
}
