<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\BaseRepository;

/**
 * Class AreaRepository
 * @package App\Repositories
 * @version June 19, 2019, 3:23 am UTC
*/

class AreaRepository extends BaseRepository
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
        return Area::class;
    }
}
