<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\BaseRepository;

/**
 * Class ArticleRepository
 * @package App\Repositories
 * @version June 7, 2019, 4:26 am UTC
*/

class ArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'start',
        'end',
        'display',
        'city',
        'district',
        'heart',
        'bookmark',
        'address',
        'gps',
        'transport_short',
        'transport_long',
        'telephone',
        'book',
        'opening',
        'fee',
        'email',
        'website',
        'rank',
        'status',
    ];

    protected $fieldFullTextSearch = [
        'title',
        'content',
    ];

    protected $fieldInSet = [
        'categories',
        'tags_public',
        'tags_private',
        'facilities',
        'photos',
        'related_articles',
        'related_places',
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
    public function getFieldsInSet()
    {
        return $this->fieldInSet;
    }
    public function fieldFullTextSearch()
    {
        return $this->fieldFullTextSearch;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article::class;
    }
}
