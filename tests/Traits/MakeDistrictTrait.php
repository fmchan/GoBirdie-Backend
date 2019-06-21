<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\District;
use App\Repositories\DistrictRepository;

trait MakeDistrictTrait
{
    /**
     * Create fake instance of District and save it in database
     *
     * @param array $districtFields
     * @return District
     */
    public function makeDistrict($districtFields = [])
    {
        /** @var DistrictRepository $districtRepo */
        $districtRepo = \App::make(DistrictRepository::class);
        $theme = $this->fakeDistrictData($districtFields);
        return $districtRepo->create($theme);
    }

    /**
     * Get fake instance of District
     *
     * @param array $districtFields
     * @return District
     */
    public function fakeDistrict($districtFields = [])
    {
        return new District($this->fakeDistrictData($districtFields));
    }

    /**
     * Get fake data of District
     *
     * @param array $districtFields
     * @return array
     */
    public function fakeDistrictData($districtFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'city' => $fake->randomDigitNotNull,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $districtFields);
    }
}
