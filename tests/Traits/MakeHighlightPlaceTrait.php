<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HighlightPlace;
use App\Repositories\HighlightPlaceRepository;

trait MakeHighlightPlaceTrait
{
    /**
     * Create fake instance of HighlightPlace and save it in database
     *
     * @param array $highlightPlaceFields
     * @return HighlightPlace
     */
    public function makeHighlightPlace($highlightPlaceFields = [])
    {
        /** @var HighlightPlaceRepository $highlightPlaceRepo */
        $highlightPlaceRepo = \App::make(HighlightPlaceRepository::class);
        $theme = $this->fakeHighlightPlaceData($highlightPlaceFields);
        return $highlightPlaceRepo->create($theme);
    }

    /**
     * Get fake instance of HighlightPlace
     *
     * @param array $highlightPlaceFields
     * @return HighlightPlace
     */
    public function fakeHighlightPlace($highlightPlaceFields = [])
    {
        return new HighlightPlace($this->fakeHighlightPlaceData($highlightPlaceFields));
    }

    /**
     * Get fake data of HighlightPlace
     *
     * @param array $highlightPlaceFields
     * @return array
     */
    public function fakeHighlightPlaceData($highlightPlaceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'place_id' => $fake->randomDigitNotNull,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $highlightPlaceFields);
    }
}
