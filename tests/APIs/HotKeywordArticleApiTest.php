<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHotKeywordArticleTrait;
use Tests\ApiTestTrait;

class HotKeywordArticleApiTest extends TestCase
{
    use MakeHotKeywordArticleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hot_keyword_article()
    {
        $hotKeywordArticle = $this->fakeHotKeywordArticleData();
        $this->response = $this->json('POST', '/api/hotKeywordArticles', $hotKeywordArticle);

        $this->assertApiResponse($hotKeywordArticle);
    }

    /**
     * @test
     */
    public function test_read_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $this->response = $this->json('GET', '/api/hotKeywordArticles/'.$hotKeywordArticle->id);

        $this->assertApiResponse($hotKeywordArticle->toArray());
    }

    /**
     * @test
     */
    public function test_update_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $editedHotKeywordArticle = $this->fakeHotKeywordArticleData();

        $this->response = $this->json('PUT', '/api/hotKeywordArticles/'.$hotKeywordArticle->id, $editedHotKeywordArticle);

        $this->assertApiResponse($editedHotKeywordArticle);
    }

    /**
     * @test
     */
    public function test_delete_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $this->response = $this->json('DELETE', '/api/hotKeywordArticles/'.$hotKeywordArticle->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/hotKeywordArticles/'.$hotKeywordArticle->id);

        $this->response->assertStatus(404);
    }
}
