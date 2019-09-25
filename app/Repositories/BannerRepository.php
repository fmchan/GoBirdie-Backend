<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Repositories\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:33 am UTC
*/

class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Banner::class;
    }
}
