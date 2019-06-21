<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Category_article;
use App\Repositories\Category_articleRepository;

trait MakeCategory_articleTrait
{
    /**
     * Create fake instance of Category_article and save it in database
     *
     * @param array $categoryArticleFields
     * @return Category_article
     */
    public function makeCategory_article($categoryArticleFields = [])
    {
        /** @var Category_articleRepository $categoryArticleRepo */
        $categoryArticleRepo = \App::make(Category_articleRepository::class);
        $theme = $this->fakeCategory_articleData($categoryArticleFields);
        return $categoryArticleRepo->create($theme);
    }

    /**
     * Get fake instance of Category_article
     *
     * @param array $categoryArticleFields
     * @return Category_article
     */
    public function fakeCategory_article($categoryArticleFields = [])
    {
        return new Category_article($this->fakeCategory_articleData($categoryArticleFields));
    }

    /**
     * Get fake data of Category_article
     *
     * @param array $categoryArticleFields
     * @return array
     */
    public function fakeCategory_articleData($categoryArticleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'icon' => $fake->word,
            'rank_home' => $fake->randomDigitNotNull,
            'rank_place' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $categoryArticleFields);
    }
}
