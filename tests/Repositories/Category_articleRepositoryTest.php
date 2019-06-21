<?php namespace Tests\Repositories;

use App\Models\Category_article;
use App\Repositories\Category_articleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCategory_articleTrait;
use Tests\ApiTestTrait;

class Category_articleRepositoryTest extends TestCase
{
    use MakeCategory_articleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Category_articleRepository
     */
    protected $categoryArticleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryArticleRepo = \App::make(Category_articleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_category_article()
    {
        $categoryArticle = $this->fakeCategory_articleData();
        $createdCategory_article = $this->categoryArticleRepo->create($categoryArticle);
        $createdCategory_article = $createdCategory_article->toArray();
        $this->assertArrayHasKey('id', $createdCategory_article);
        $this->assertNotNull($createdCategory_article['id'], 'Created Category_article must have id specified');
        $this->assertNotNull(Category_article::find($createdCategory_article['id']), 'Category_article with given id must be in DB');
        $this->assertModelData($categoryArticle, $createdCategory_article);
    }

    /**
     * @test read
     */
    public function test_read_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $dbCategory_article = $this->categoryArticleRepo->find($categoryArticle->id);
        $dbCategory_article = $dbCategory_article->toArray();
        $this->assertModelData($categoryArticle->toArray(), $dbCategory_article);
    }

    /**
     * @test update
     */
    public function test_update_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $fakeCategory_article = $this->fakeCategory_articleData();
        $updatedCategory_article = $this->categoryArticleRepo->update($fakeCategory_article, $categoryArticle->id);
        $this->assertModelData($fakeCategory_article, $updatedCategory_article->toArray());
        $dbCategory_article = $this->categoryArticleRepo->find($categoryArticle->id);
        $this->assertModelData($fakeCategory_article, $dbCategory_article->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_category_article()
    {
        $categoryArticle = $this->makeCategory_article();
        $resp = $this->categoryArticleRepo->delete($categoryArticle->id);
        $this->assertTrue($resp);
        $this->assertNull(Category_article::find($categoryArticle->id), 'Category_article should not exist in DB');
    }
}
