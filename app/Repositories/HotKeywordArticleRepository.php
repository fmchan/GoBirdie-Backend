<?php

namespace App\Repositories;

use App\Models\HotKeywordArticle;
use App\Repositories\BaseRepository;

/**
 * Class HotKeywordArticleRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:52 am UTC
*/

class HotKeywordArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'keyword',
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
        return HotKeywordArticle::class;
    }
}
