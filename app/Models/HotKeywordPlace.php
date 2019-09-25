<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HotKeywordPlace
 * @package App\Models
 * @version September 25, 2019, 3:51 am UTC
 *
 * @property string keyword
 * @property integer rank
 * @property string status
 */
class HotKeywordPlace extends Model
{
    use SoftDeletes;

    public $table = 'hot_keyword_places';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'keyword',
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
        'keyword' => 'string',
        'rank' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'keyword' => 'required|unique:hot_keyword_places,keyword',
        'rank' => 'required'
    ];

    
}
