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
        'rank_place',
        'status'
    ];
    protected $fieldSearchableAdvance = [
        'rank_home',
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
    public function getFieldSearchableAdvance()
    {
        return $this->fieldSearchableAdvance;
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category_place::class;
    }
}
