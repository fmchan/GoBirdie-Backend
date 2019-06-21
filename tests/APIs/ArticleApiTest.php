<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeArticleTrait;
use Tests\ApiTestTrait;

class ArticleApiTest extends TestCase
{
    use MakeArticleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_article()
    {
        $article = $this->fakeArticleData();
        $this->response = $this->json('POST', '/api/articles', $article);

        $this->assertApiResponse($article);
    }

    /**
     * @test
     */
    public function test_read_article()
    {
        $article = $this->makeArticle();
        $this->response = $this->json('GET', '/api/articles/'.$article->id);

        $this->assertApiResponse($article->toArray());
    }

    /**
     * @test
     */
    public function test_update_article()
    {
        $article = $this->makeArticle();
        $editedArticle = $this->fakeArticleData();

        $this->response = $this->json('PUT', '/api/articles/'.$article->id, $editedArticle);

        $this->assertApiResponse($editedArticle);
    }

    /**
     * @test
     */
    public function test_delete_article()
    {
        $article = $this->makeArticle();
        $this->response = $this->json('DELETE', '/api/articles/'.$article->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/articles/'.$article->id);

        $this->response->assertStatus(404);
    }
}
