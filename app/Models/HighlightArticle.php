<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HighlightArticle
 * @package App\Models
 * @version September 25, 2019, 3:49 am UTC
 *
 * @property \App\Models\Article article
 * @property integer article_id
 * @property integer rank
 * @property string status
 */
class HighlightArticle extends Model
{
    use SoftDeletes;

    public $table = 'highlight_articles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'article_id',
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
        'article_id' => 'integer',
        'rank' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'article_id' => 'required|exists:articles,id',
        'rank' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function article()
    {
        return $this->belongsTo(\App\Models\Article::class, 'article_id');
    }
}
