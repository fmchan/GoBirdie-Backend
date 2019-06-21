<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Hour;
use App\Repositories\HourRepository;

trait MakeHourTrait
{
    /**
     * Create fake instance of Hour and save it in database
     *
     * @param array $hourFields
     * @return Hour
     */
    public function makeHour($hourFields = [])
    {
        /** @var HourRepository $hourRepo */
        $hourRepo = \App::make(HourRepository::class);
        $theme = $this->fakeHourData($hourFields);
        return $hourRepo->create($theme);
    }

    /**
     * Get fake instance of Hour
     *
     * @param array $hourFields
     * @return Hour
     */
    public function fakeHour($hourFields = [])
    {
        return new Hour($this->fakeHourData($hourFields));
    }

    /**
     * Get fake data of Hour
     *
     * @param array $hourFields
     * @return array
     */
    public function fakeHourData($hourFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $hourFields);
    }
}
