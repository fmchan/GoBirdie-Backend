<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category_article
 * @package App\Models
 * @version June 7, 2019, 4:16 am UTC
 *
 * @property string name
 * @property string icon
 * @property integer rank_home
 * @property integer rank_place
 * @property string status
 */
class Category_article extends Model
{
    use SoftDeletes;

    public $table = 'category_articles';
    

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
        //'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024'
    ];

    
}
