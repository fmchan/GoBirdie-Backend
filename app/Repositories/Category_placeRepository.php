<?php

namespace App\Repositories;

use App\Models\Category_place;
use App\Repositories\BaseRepository;

/**
 * Class Category_placeRepository
 * @package App\Repositories
 * @version June 7, 2019, 4:18 am UTC
*/

class Category_placeRepository extends BaseRepository
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
        return Category_place::class;
    }
}
