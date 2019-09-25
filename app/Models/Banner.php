<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Banner
 * @package App\Models
 * @version September 25, 2019, 3:33 am UTC
 *
 * @property string title
 * @property string photo
 * @property string type
 * @property string link
 * @property integer rank
 * @property string start
 * @property string end
 * @property string status
 */
class Banner extends Model
{
    use SoftDeletes;

    public $table = 'banners';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'photo',
        'type',
        'link',
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
        'title' => 'string',
        'photo' => 'string',
        'type' => 'string',
        'link' => 'string',
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
        'title' => 'required',
        'link' => 'required_if:type,E,A,P',
        'start' => 'sometimes|nullable|date|required_with:end',
        'end' => 'sometimes|nullable|date|after:start|required_with:start',
        'banner' => 'nullable|required_without:update|image|mimes:jpeg,png,jpg',
        'rank' => 'required'
    ];

    
}
