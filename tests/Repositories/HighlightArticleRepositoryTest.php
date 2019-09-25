<?php namespace Tests\Repositories;

use App\Models\HighlightArticle;
use App\Repositories\HighlightArticleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHighlightArticleTrait;
use Tests\ApiTestTrait;

class HighlightArticleRepositoryTest extends TestCase
{
    use MakeHighlightArticleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HighlightArticleRepository
     */
    protected $highlightArticleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->highlightArticleRepo = \App::make(HighlightArticleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_highlight_article()
    {
        $highlightArticle = $this->fakeHighlightArticleData();
        $createdHighlightArticle = $this->highlightArticleRepo->create($highlightArticle);
        $createdHighlightArticle = $createdHighlightArticle->toArray();
        $this->assertArrayHasKey('id', $createdHighlightArticle);
        $this->assertNotNull($createdHighlightArticle['id'], 'Created HighlightArticle must have id specified');
        $this->assertNotNull(HighlightArticle::find($createdHighlightArticle['id']), 'HighlightArticle with given id must be in DB');
        $this->assertModelData($highlightArticle, $createdHighlightArticle);
    }

    /**
     * @test read
     */
    public function test_read_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $dbHighlightArticle = $this->highlightArticleRepo->find($highlightArticle->id);
        $dbHighlightArticle = $dbHighlightArticle->toArray();
        $this->assertModelData($highlightArticle->toArray(), $dbHighlightArticle);
    }

    /**
     * @test update
     */
    public function test_update_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $fakeHighlightArticle = $this->fakeHighlightArticleData();
        $updatedHighlightArticle = $this->highlightArticleRepo->update($fakeHighlightArticle, $highlightArticle->id);
        $this->assertModelData($fakeHighlightArticle, $updatedHighlightArticle->toArray());
        $dbHighlightArticle = $this->highlightArticleRepo->find($highlightArticle->id);
        $this->assertModelData($fakeHighlightArticle, $dbHighlightArticle->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_highlight_article()
    {
        $highlightArticle = $this->makeHighlightArticle();
        $resp = $this->highlightArticleRepo->delete($highlightArticle->id);
        $this->assertTrue($resp);
        $this->assertNull(HighlightArticle::find($highlightArticle->id), 'HighlightArticle should not exist in DB');
    }
}
