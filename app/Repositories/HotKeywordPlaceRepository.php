<?php

namespace App\Repositories;

use App\Models\HotKeywordPlace;
use App\Repositories\BaseRepository;

/**
 * Class HotKeywordPlaceRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:51 am UTC
*/

class HotKeywordPlaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'keyword',
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
        return HotKeywordPlace::class;
    }
}
