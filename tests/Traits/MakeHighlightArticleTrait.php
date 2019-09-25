<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HighlightArticle;
use App\Repositories\HighlightArticleRepository;

trait MakeHighlightArticleTrait
{
    /**
     * Create fake instance of HighlightArticle and save it in database
     *
     * @param array $highlightArticleFields
     * @return HighlightArticle
     */
    public function makeHighlightArticle($highlightArticleFields = [])
    {
        /** @var HighlightArticleRepository $highlightArticleRepo */
        $highlightArticleRepo = \App::make(HighlightArticleRepository::class);
        $theme = $this->fakeHighlightArticleData($highlightArticleFields);
        return $highlightArticleRepo->create($theme);
    }

    /**
     * Get fake instance of HighlightArticle
     *
     * @param array $highlightArticleFields
     * @return HighlightArticle
     */
    public function fakeHighlightArticle($highlightArticleFields = [])
    {
        return new HighlightArticle($this->fakeHighlightArticleData($highlightArticleFields));
    }

    /**
     * Get fake data of HighlightArticle
     *
     * @param array $highlightArticleFields
     * @return array
     */
    public function fakeHighlightArticleData($highlightArticleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'article_id' => $fake->randomDigitNotNull,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $highlightArticleFields);
    }
}
