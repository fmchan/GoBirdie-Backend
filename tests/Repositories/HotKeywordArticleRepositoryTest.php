<?php namespace Tests\Repositories;

use App\Models\HotKeywordArticle;
use App\Repositories\HotKeywordArticleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHotKeywordArticleTrait;
use Tests\ApiTestTrait;

class HotKeywordArticleRepositoryTest extends TestCase
{
    use MakeHotKeywordArticleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HotKeywordArticleRepository
     */
    protected $hotKeywordArticleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hotKeywordArticleRepo = \App::make(HotKeywordArticleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hot_keyword_article()
    {
        $hotKeywordArticle = $this->fakeHotKeywordArticleData();
        $createdHotKeywordArticle = $this->hotKeywordArticleRepo->create($hotKeywordArticle);
        $createdHotKeywordArticle = $createdHotKeywordArticle->toArray();
        $this->assertArrayHasKey('id', $createdHotKeywordArticle);
        $this->assertNotNull($createdHotKeywordArticle['id'], 'Created HotKeywordArticle must have id specified');
        $this->assertNotNull(HotKeywordArticle::find($createdHotKeywordArticle['id']), 'HotKeywordArticle with given id must be in DB');
        $this->assertModelData($hotKeywordArticle, $createdHotKeywordArticle);
    }

    /**
     * @test read
     */
    public function test_read_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $dbHotKeywordArticle = $this->hotKeywordArticleRepo->find($hotKeywordArticle->id);
        $dbHotKeywordArticle = $dbHotKeywordArticle->toArray();
        $this->assertModelData($hotKeywordArticle->toArray(), $dbHotKeywordArticle);
    }

    /**
     * @test update
     */
    public function test_update_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $fakeHotKeywordArticle = $this->fakeHotKeywordArticleData();
        $updatedHotKeywordArticle = $this->hotKeywordArticleRepo->update($fakeHotKeywordArticle, $hotKeywordArticle->id);
        $this->assertModelData($fakeHotKeywordArticle, $updatedHotKeywordArticle->toArray());
        $dbHotKeywordArticle = $this->hotKeywordArticleRepo->find($hotKeywordArticle->id);
        $this->assertModelData($fakeHotKeywordArticle, $dbHotKeywordArticle->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hot_keyword_article()
    {
        $hotKeywordArticle = $this->makeHotKeywordArticle();
        $resp = $this->hotKeywordArticleRepo->delete($hotKeywordArticle->id);
        $this->assertTrue($resp);
        $this->assertNull(HotKeywordArticle::find($hotKeywordArticle->id), 'HotKeywordArticle should not exist in DB');
    }
}
