<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HotKeywordArticle
 * @package App\Models
 * @version September 25, 2019, 3:52 am UTC
 *
 * @property string keyword
 * @property integer rank
 * @property string start
 * @property string end
 * @property string status
 */
class HotKeywordArticle extends Model
{
    use SoftDeletes;

    public $table = 'hot_keyword_articles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'keyword',
        'rank',
        'start',
        'end',
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
        'start' => 'datetime',
        'end' => 'datetime',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'keyword' => 'required|unique:hot_keyword_articles,keyword',
        'rank' => 'required',
        'start' => 'sometimes|nullable|date|required_with:end',
        'end' => 'sometimes|nullable|date|after:start|required_with:start',
    ];

    
}
