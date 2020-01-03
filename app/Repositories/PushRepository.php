<?php

namespace App\Repositories;

use App\Models\Push;
use App\Repositories\BaseRepository;

/**
 * Class PushRepository
 * @package App\Repositories
 * @version January 3, 2020, 2:01 pm HKT
*/

class PushRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'json',
        'ttl',
        'image',
        'channel'
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
        return Push::class;
    }
}
