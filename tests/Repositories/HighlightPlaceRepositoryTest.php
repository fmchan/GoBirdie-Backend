<?php namespace Tests\Repositories;

use App\Models\HighlightPlace;
use App\Repositories\HighlightPlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHighlightPlaceTrait;
use Tests\ApiTestTrait;

class HighlightPlaceRepositoryTest extends TestCase
{
    use MakeHighlightPlaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HighlightPlaceRepository
     */
    protected $highlightPlaceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->highlightPlaceRepo = \App::make(HighlightPlaceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_highlight_place()
    {
        $highlightPlace = $this->fakeHighlightPlaceData();
        $createdHighlightPlace = $this->highlightPlaceRepo->create($highlightPlace);
        $createdHighlightPlace = $createdHighlightPlace->toArray();
        $this->assertArrayHasKey('id', $createdHighlightPlace);
        $this->assertNotNull($createdHighlightPlace['id'], 'Created HighlightPlace must have id specified');
        $this->assertNotNull(HighlightPlace::find($createdHighlightPlace['id']), 'HighlightPlace with given id must be in DB');
        $this->assertModelData($highlightPlace, $createdHighlightPlace);
    }

    /**
     * @test read
     */
    public function test_read_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $dbHighlightPlace = $this->highlightPlaceRepo->find($highlightPlace->id);
        $dbHighlightPlace = $dbHighlightPlace->toArray();
        $this->assertModelData($highlightPlace->toArray(), $dbHighlightPlace);
    }

    /**
     * @test update
     */
    public function test_update_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $fakeHighlightPlace = $this->fakeHighlightPlaceData();
        $updatedHighlightPlace = $this->highlightPlaceRepo->update($fakeHighlightPlace, $highlightPlace->id);
        $this->assertModelData($fakeHighlightPlace, $updatedHighlightPlace->toArray());
        $dbHighlightPlace = $this->highlightPlaceRepo->find($highlightPlace->id);
        $this->assertModelData($fakeHighlightPlace, $dbHighlightPlace->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $resp = $this->highlightPlaceRepo->delete($highlightPlace->id);
        $this->assertTrue($resp);
        $this->assertNull(HighlightPlace::find($highlightPlace->id), 'HighlightPlace should not exist in DB');
    }
}
