<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHighlightArticleTrait;
use Tests\ApiTestTrait;

class HighlightArticleApiTest extends TestCase
{
    use MakeHighlightArticleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_highlight_article()
    {
        $highlightArticle = $this->fakeHighlightArticleData();
        $this->response = $this->json('POST', '/api/highlightArticles', $highlightArticle);

        $this->assertApiResponse($highlightArticle);
    }

    /**
     * @test
     */
    public function test_read_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $this->response = $this->json('GET', '/api/highlightArticles/'.$highlightArticle->id);

        $this->assertApiResponse($highlightArticle->toArray());
    }

    /**
     * @test
     */
    public function test_update_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $editedHighlightArticle = $this->fakeHighlightArticleData();

        $this->response = $this->json('PUT', '/api/highlightArticles/'.$highlightArticle->id, $editedHighlightArticle);

        $this->assertApiResponse($editedHighlightArticle);
    }

    /**
     * @test
     */
    public function test_delete_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $this->response = $this->json('DELETE', '/api/highlightArticles/'.$highlightArticle->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/highlightArticles/'.$highlightArticle->id);

        $this->response->assertStatus(404);
    }
}
