<?php

namespace App\Repositories;

use App\Models\Facility;
use App\Repositories\BaseRepository;

/**
 * Class FacilityRepository
 * @package App\Repositories
 * @version June 7, 2019, 4:19 am UTC
*/

class FacilityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon',
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
        return Facility::class;
    }
}
