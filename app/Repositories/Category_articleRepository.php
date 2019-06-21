<?php

namespace App\Repositories;

use App\Models\Category_article;
use App\Repositories\BaseRepository;

/**
 * Class Category_articleRepository
 * @package App\Repositories
 * @version June 7, 2019, 4:16 am UTC
*/

class Category_articleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon',
        'rank_home',
        'rank_place',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category_article::class;
    }
}
