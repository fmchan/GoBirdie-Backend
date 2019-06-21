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
        'title',
        'start',
        'end',
        'city',
        'district',
        'categories',
        'heart',
        'bookmark',
        'address',
        'lat',
        'long',
        'transport_short',
        'transport_long',
        'telephone',
        'book',
        'opening',
        'fee',
        'tags_public',
        'tags_private',
        'email',
        'website',
        'content',
        'facilities',
        'photos',
        'related_articles',
        'related_places',
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
        return Article::class;
    }
}
