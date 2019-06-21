<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Category_place;
use App\Repositories\Category_placeRepository;

trait MakeCategory_placeTrait
{
    /**
     * Create fake instance of Category_place and save it in database
     *
     * @param array $categoryPlaceFields
     * @return Category_place
     */
    public function makeCategory_place($categoryPlaceFields = [])
    {
        /** @var Category_placeRepository $categoryPlaceRepo */
        $categoryPlaceRepo = \App::make(Category_placeRepository::class);
        $theme = $this->fakeCategory_placeData($categoryPlaceFields);
        return $categoryPlaceRepo->create($theme);
    }

    /**
     * Get fake instance of Category_place
     *
     * @param array $categoryPlaceFields
     * @return Category_place
     */
    public function fakeCategory_place($categoryPlaceFields = [])
    {
        return new Category_place($this->fakeCategory_placeData($categoryPlaceFields));
    }

    /**
     * Get fake data of Category_place
     *
     * @param array $categoryPlaceFields
     * @return array
     */
    public function fakeCategory_placeData($categoryPlaceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $categoryPlaceFields);
    }
}
