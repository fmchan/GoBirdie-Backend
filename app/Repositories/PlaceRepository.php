<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\BaseRepository;

/**
 * Class PlaceRepository
 * @package App\Repositories
 * @version June 7, 2019, 4:31 am UTC
*/

class PlaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'city',
        'district',
        'categories',
        'organization',
        'heart',
        'bookmark',
        'address',
        'lat',
        'long',
        'transport_short',
        'transport_long',
        'telephone',
        'age_start',
        'age_end',
        'book',
        'opening',
        'opening_select',
        'fee',
        'fee_number',
        'area',
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
        return Place::class;
    }
}
