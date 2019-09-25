<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\BaseRepository;

/**
 * Class PageRepository
 * @package App\Repositories
 * @version September 25, 2019, 4:46 am UTC
*/

class PageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alias',
        'title',
        'content',
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
        return Page::class;
    }
}
