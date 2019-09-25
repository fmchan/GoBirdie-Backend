<?php

namespace App\Repositories;

use App\Models\HighlightArticle;
use App\Repositories\BaseRepository;

/**
 * Class HighlightArticleRepository
 * @package App\Repositories
 * @version September 25, 2019, 3:49 am UTC
*/

class HighlightArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'article_id',
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
        return HighlightArticle::class;
    }
}
