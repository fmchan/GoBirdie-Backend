<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HotKeywordArticle;
use App\Repositories\HotKeywordArticleRepository;

trait MakeHotKeywordArticleTrait
{
    /**
     * Create fake instance of HotKeywordArticle and save it in database
     *
     * @param array $hotKeywordArticleFields
     * @return HotKeywordArticle
     */
    public function makeHotKeywordArticle($hotKeywordArticleFields = [])
    {
        /** @var HotKeywordArticleRepository $hotKeywordArticleRepo */
        $hotKeywordArticleRepo = \App::make(HotKeywordArticleRepository::class);
        $theme = $this->fakeHotKeywordArticleData($hotKeywordArticleFields);
        return $hotKeywordArticleRepo->create($theme);
    }

    /**
     * Get fake instance of HotKeywordArticle
     *
     * @param array $hotKeywordArticleFields
     * @return HotKeywordArticle
     */
    public function fakeHotKeywordArticle($hotKeywordArticleFields = [])
    {
        return new HotKeywordArticle($this->fakeHotKeywordArticleData($hotKeywordArticleFields));
    }

    /**
     * Get fake data of HotKeywordArticle
     *
     * @param array $hotKeywordArticleFields
     * @return array
     */
    public function fakeHotKeywordArticleData($hotKeywordArticleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'keyword' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'start' => $fake->word,
            'end' => $fake->word,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $hotKeywordArticleFields);
    }
}
