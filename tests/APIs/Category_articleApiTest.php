<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCategory_articleTrait;
use Tests\ApiTestTrait;

class Category_articleApiTest extends TestCase
{
    use MakeCategory_articleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category_article()
    {
        $categoryArticle = $this->fakeCategory_articleData();
        $this->response = $this->json('POST', '/api/categoryArticles', $categoryArticle);

        $this->assertApiResponse($categoryArticle);
    }

    /**
     * @test
     */
    public function test_read_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $this->response = $this->json('GET', '/api/categoryArticles/'.$categoryArticle->id);

        $this->assertApiResponse($categoryArticle->toArray());
    }

    /**
     * @test
     */
    public function test_update_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $editedCategory_article = $this->fakeCategory_articleData();

        $this->response = $this->json('PUT', '/api/categoryArticles/'.$categoryArticle->id, $editedCategory_article);

        $this->assertApiResponse($editedCategory_article);
    }

    /**
     * @test
     */
    public function test_delete_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $this->response = $this->json('DELETE', '/api/categoryArticles/'.$categoryArticle->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/categoryArticles/'.$categoryArticle->id);

        $this->response->assertStatus(404);
    }
}
