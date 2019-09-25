<?php namespace Tests\Repositories;

use App\Models\HotKeywordPlace;
use App\Repositories\HotKeywordPlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHotKeywordPlaceTrait;
use Tests\ApiTestTrait;

class HotKeywordPlaceRepositoryTest extends TestCase
{
    use MakeHotKeywordPlaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HotKeywordPlaceRepository
     */
    protected $hotKeywordPlaceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hotKeywordPlaceRepo = \App::make(HotKeywordPlaceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hot_keyword_place()
    {
        $hotKeywordPlace = $this->fakeHotKeywordPlaceData();
        $createdHotKeywordPlace = $this->hotKeywordPlaceRepo->create($hotKeywordPlace);
        $createdHotKeywordPlace = $createdHotKeywordPlace->toArray();
        $this->assertArrayHasKey('id', $createdHotKeywordPlace);
        $this->assertNotNull($createdHotKeywordPlace['id'], 'Created HotKeywordPlace must have id specified');
        $this->assertNotNull(HotKeywordPlace::find($createdHotKeywordPlace['id']), 'HotKeywordPlace with given id must be in DB');
        $this->assertModelData($hotKeywordPlace, $createdHotKeywordPlace);
    }

    /**
     * @test read
     */
    public function test_read_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $dbHotKeywordPlace = $this->hotKeywordPlaceRepo->find($hotKeywordPlace->id);
        $dbHotKeywordPlace = $dbHotKeywordPlace->toArray();
        $this->assertModelData($hotKeywordPlace->toArray(), $dbHotKeywordPlace);
    }

    /**
     * @test update
     */
    public function test_update_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $fakeHotKeywordPlace = $this->fakeHotKeywordPlaceData();
        $updatedHotKeywordPlace = $this->hotKeywordPlaceRepo->update($fakeHotKeywordPlace, $hotKeywordPlace->id);
        $this->assertModelData($fakeHotKeywordPlace, $updatedHotKeywordPlace->toArray());
        $dbHotKeywordPlace = $this->hotKeywordPlaceRepo->find($hotKeywordPlace->id);
        $this->assertModelData($fakeHotKeywordPlace, $dbHotKeywordPlace->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $resp = $this->hotKeywordPlaceRepo->delete($hotKeywordPlace->id);
        $this->assertTrue($resp);
        $this->assertNull(HotKeywordPlace::find($hotKeywordPlace->id), 'HotKeywordPlace should not exist in DB');
    }
}
