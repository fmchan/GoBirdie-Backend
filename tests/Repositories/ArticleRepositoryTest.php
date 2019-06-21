<?php namespace Tests\Repositories;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeArticleTrait;
use Tests\ApiTestTrait;

class ArticleRepositoryTest extends TestCase
{
    use MakeArticleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ArticleRepository
     */
    protected $articleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->articleRepo = \App::make(ArticleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_article()
    {
        $article = $this->fakeArticleData();
        $createdArticle = $this->articleRepo->create($article);
        $createdArticle = $createdArticle->toArray();
        $this->assertArrayHasKey('id', $createdArticle);
        $this->assertNotNull($createdArticle['id'], 'Created Article must have id specified');
        $this->assertNotNull(Article::find($createdArticle['id']), 'Article with given id must be in DB');
        $this->assertModelData($article, $createdArticle);
    }

    /**
     * @test read
     */
    public function test_read_article()
    {
        $article = $this->makeArticle();
        $dbArticle = $this->articleRepo->find($article->id);
        $dbArticle = $dbArticle->toArray();
        $this->assertModelData($article->toArray(), $dbArticle);
    }

    /**
     * @test update
     */
    public function test_update_article()
    {
        $article = $this->makeArticle();
        $fakeArticle = $this->fakeArticleData();
        $updatedArticle = $this->articleRepo->update($fakeArticle, $article->id);
        $this->assertModelData($fakeArticle, $updatedArticle->toArray());
        $dbArticle = $this->articleRepo->find($article->id);
        $this->assertModelData($fakeArticle, $dbArticle->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_article()
    {
        $article = $this->makeArticle();
        $resp = $this->articleRepo->delete($article->id);
        $this->assertTrue($resp);
        $this->assertNull(Article::find($article->id), 'Article should not exist in DB');
    }
}
