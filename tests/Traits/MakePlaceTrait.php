<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Place;
use App\Repositories\PlaceRepository;

trait MakePlaceTrait
{
    /**
     * Create fake instance of Place and save it in database
     *
     * @param array $placeFields
     * @return Place
     */
    public function makePlace($placeFields = [])
    {
        /** @var PlaceRepository $placeRepo */
        $placeRepo = \App::make(PlaceRepository::class);
        $theme = $this->fakePlaceData($placeFields);
        return $placeRepo->create($theme);
    }

    /**
     * Get fake instance of Place
     *
     * @param array $placeFields
     * @return Place
     */
    public function fakePlace($placeFields = [])
    {
        return new Place($this->fakePlaceData($placeFields));
    }

    /**
     * Get fake data of Place
     *
     * @param array $placeFields
     * @return array
     */
    public function fakePlaceData($placeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'city' => $fake->randomDigitNotNull,
            'district' => $fake->randomDigitNotNull,
            'categories' => $fake->word,
            'organization' => $fake->randomDigitNotNull,
            'heart' => $fake->randomDigitNotNull,
            'bookmark' => $fake->randomDigitNotNull,
            'address' => $fake->text,
            'lat' => $fake->word,
            'long' => $fake->word,
            'transport_short' => $fake->text,
            'transport_long' => $fake->text,
            'telephone' => $fake->text,
            'age_start' => $fake->randomDigitNotNull,
            'age_end' => $fake->randomDigitNotNull,
            'book' => $fake->word,
            'opening' => $fake->text,
            'opening_select' => $fake->word,
            'fee' => $fake->text,
            'fee_number' => $fake->randomDigitNotNull,
            'area' => $fake->word,
            'tags_public' => $fake->word,
            'tags_private' => $fake->word,
            'email' => $fake->word,
            'website' => $fake->word,
            'content' => $fake->text,
            'facilities' => $fake->word,
            'photos' => $fake->word,
            'related_articles' => $fake->word,
            'related_places' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $placeFields);
    }
}
