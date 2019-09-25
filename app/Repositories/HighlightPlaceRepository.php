<?php

namespace App\Repositories;

use App\Models\HighlightPlace;
use App\Repositories\BaseRepository;

/**
 * Class HighlightPlaceRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:43 am UTC
*/

class HighlightPlaceRepository extends BaseRepository
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
        return HighlightPlace::class;
    }
}
