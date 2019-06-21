<?php

namespace App\Repositories;

use App\Models\Hour;
use App\Repositories\BaseRepository;

/**
 * Class HourRepository
 * @package App\Repositories
 * @version June 19, 2019, 3:24 am UTC
*/

class HourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Hour::class;
    }
}
