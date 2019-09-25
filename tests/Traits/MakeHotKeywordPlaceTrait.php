<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HotKeywordPlace;
use App\Repositories\HotKeywordPlaceRepository;

trait MakeHotKeywordPlaceTrait
{
    /**
     * Create fake instance of HotKeywordPlace and save it in database
     *
     * @param array $hotKeywordPlaceFields
     * @return HotKeywordPlace
     */
    public function makeHotKeywordPlace($hotKeywordPlaceFields = [])
    {
        /** @var HotKeywordPlaceRepository $hotKeywordPlaceRepo */
        $hotKeywordPlaceRepo = \App::make(HotKeywordPlaceRepository::class);
        $theme = $this->fakeHotKeywordPlaceData($hotKeywordPlaceFields);
        return $hotKeywordPlaceRepo->create($theme);
    }

    /**
     * Get fake instance of HotKeywordPlace
     *
     * @param array $hotKeywordPlaceFields
     * @return HotKeywordPlace
     */
    public function fakeHotKeywordPlace($hotKeywordPlaceFields = [])
    {
        return new HotKeywordPlace($this->fakeHotKeywordPlaceData($hotKeywordPlaceFields));
    }

    /**
     * Get fake data of HotKeywordPlace
     *
     * @param array $hotKeywordPlaceFields
     * @return array
     */
    public function fakeHotKeywordPlaceData($hotKeywordPlaceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'keyword' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $hotKeywordPlaceFields);
    }
}
