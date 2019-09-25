<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\RecommendPlace;
use App\Repositories\RecommendPlaceRepository;

trait MakeRecommendPlaceTrait
{
    /**
     * Create fake instance of RecommendPlace and save it in database
     *
     * @param array $recommendPlaceFields
     * @return RecommendPlace
     */
    public function makeRecommendPlace($recommendPlaceFields = [])
    {
        /** @var RecommendPlaceRepository $recommendPlaceRepo */
        $recommendPlaceRepo = \App::make(RecommendPlaceRepository::class);
        $theme = $this->fakeRecommendPlaceData($recommendPlaceFields);
        return $recommendPlaceRepo->create($theme);
    }

    /**
     * Get fake instance of RecommendPlace
     *
     * @param array $recommendPlaceFields
     * @return RecommendPlace
     */
    public function fakeRecommendPlace($recommendPlaceFields = [])
    {
        return new RecommendPlace($this->fakeRecommendPlaceData($recommendPlaceFields));
    }

    /**
     * Get fake data of RecommendPlace
     *
     * @param array $recommendPlaceFields
     * @return array
     */
    public function fakeRecommendPlaceData($recommendPlaceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'place_id' => $fake->randomDigitNotNull,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $recommendPlaceFields);
    }
}
