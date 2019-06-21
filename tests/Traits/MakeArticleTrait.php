<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Article;
use App\Repositories\ArticleRepository;

trait MakeArticleTrait
{
    /**
     * Create fake instance of Article and save it in database
     *
     * @param array $articleFields
     * @return Article
     */
    public function makeArticle($articleFields = [])
    {
        /** @var ArticleRepository $articleRepo */
        $articleRepo = \App::make(ArticleRepository::class);
        $theme = $this->fakeArticleData($articleFields);
        return $articleRepo->create($theme);
    }

    /**
     * Get fake instance of Article
     *
     * @param array $articleFields
     * @return Article
     */
    public function fakeArticle($articleFields = [])
    {
        return new Article($this->fakeArticleData($articleFields));
    }

    /**
     * Get fake data of Article
     *
     * @param array $articleFields
     * @return array
     */
    public function fakeArticleData($articleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'start' => $fake->word,
            'end' => $fake->word,
            'city' => $fake->randomDigitNotNull,
            'district' => $fake->randomDigitNotNull,
            'categories' => $fake->word,
            'heart' => $fake->randomDigitNotNull,
            'bookmark' => $fake->randomDigitNotNull,
            'address' => $fake->text,
            'lat' => $fake->word,
            'long' => $fake->word,
            'transport_short' => $fake->text,
            'transport_long' => $fake->text,
            'telephone' => $fake->text,
            'book' => $fake->word,
            'opening' => $fake->text,
            'fee' => $fake->text,
            'tags_public' => $fake->word,
            'tags_private' => $fake->word,
            'email' => $fake->word,
            'website' => $fake->word,
            'content' => $fake->text,
            'facilities' => $fake->word,
            'photos' => $fake->word,
            'related_articles' => $fake->word,
            'related_places' => $fake->word,
            'rank' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $articleFields);
    }
}
