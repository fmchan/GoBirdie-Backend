<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Area;
use App\Repositories\AreaRepository;

trait MakeAreaTrait
{
    /**
     * Create fake instance of Area and save it in database
     *
     * @param array $areaFields
     * @return Area
     */
    public function makeArea($areaFields = [])
    {
        /** @var AreaRepository $areaRepo */
        $areaRepo = \App::make(AreaRepository::class);
        $theme = $this->fakeAreaData($areaFields);
        return $areaRepo->create($theme);
    }

    /**
     * Get fake instance of Area
     *
     * @param array $areaFields
     * @return Area
     */
    public function fakeArea($areaFields = [])
    {
        return new Area($this->fakeAreaData($areaFields));
    }

    /**
     * Get fake data of Area
     *
     * @param array $areaFields
     * @return array
     */
    public function fakeAreaData($areaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $areaFields);
    }
}
