<?php

namespace App\Repositories;

use App\Models\RecommendPlace;
use App\Repositories\BaseRepository;

/**
 * Class RecommendPlaceRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:50 am UTC
*/

class RecommendPlaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'place_id',
        'rank',
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
        return RecommendPlace::class;
    }
}
