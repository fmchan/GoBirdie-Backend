<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Banner;
use App\Repositories\BannerRepository;

trait MakeBannerTrait
{
    /**
     * Create fake instance of Banner and save it in database
     *
     * @param array $bannerFields
     * @return Banner
     */
    public function makeBanner($bannerFields = [])
    {
        /** @var BannerRepository $bannerRepo */
        $bannerRepo = \App::make(BannerRepository::class);
        $theme = $this->fakeBannerData($bannerFields);
        return $bannerRepo->create($theme);
    }

    /**
     * Get fake instance of Banner
     *
     * @param array $bannerFields
     * @return Banner
     */
    public function fakeBanner($bannerFields = [])
    {
        return new Banner($this->fakeBannerData($bannerFields));
    }

    /**
     * Get fake data of Banner
     *
     * @param array $bannerFields
     * @return array
     */
    public function fakeBannerData($bannerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'photo' => $fake->word,
            'type' => $fake->word,
            'link' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'start' => $fake->word,
            'end' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $bannerFields);
    }
}
