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
        'city',
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
        //'fee_number',
    ];

    public $fieldInSet = [
        'categories',
        'tags_public',
        'tags_private',
        'facilities',
        'photos',
        'related_articles',
        'related_places',
        'opening_hours',
        'areas',
        'organization',
        'district',
    ];

    protected $fieldFullTextSearch = [
        'title',
        'content',
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

    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = parent::allQuery($search, $skip, $limit);
        if (array_key_exists('age_start', $search) && array_key_exists('age_end', $search)) {
            $query->where('age_start','<=',$search['age_end'])
                  ->where('age_end','>=',$search['age_start']);
        }
        if (array_key_exists('fee_start', $search) && array_key_exists('fee_end', $search)) {
            $query->whereBetween('fee_number', [$search['fee_start'],$search['fee_end']]);
        }
        return $query;
    }
}
