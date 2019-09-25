<?php namespace Tests\Repositories;

use App\Models\RecommendPlace;
use App\Repositories\RecommendPlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRecommendPlaceTrait;
use Tests\ApiTestTrait;

class RecommendPlaceRepositoryTest extends TestCase
{
    use MakeRecommendPlaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RecommendPlaceRepository
     */
    protected $recommendPlaceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->recommendPlaceRepo = \App::make(RecommendPlaceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_recommend_place()
    {
        $recommendPlace = $this->fakeRecommendPlaceData();
        $createdRecommendPlace = $this->recommendPlaceRepo->create($recommendPlace);
        $createdRecommendPlace = $createdRecommendPlace->toArray();
        $this->assertArrayHasKey('id', $createdRecommendPlace);
        $this->assertNotNull($createdRecommendPlace['id'], 'Created RecommendPlace must have id specified');
        $this->assertNotNull(RecommendPlace::find($createdRecommendPlace['id']), 'RecommendPlace with given id must be in DB');
        $this->assertModelData($recommendPlace, $createdRecommendPlace);
    }

    /**
     * @test read
     */
    public function test_read_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $dbRecommendPlace = $this->recommendPlaceRepo->find($recommendPlace->id);
        $dbRecommendPlace = $dbRecommendPlace->toArray();
        $this->assertModelData($recommendPlace->toArray(), $dbRecommendPlace);
    }

    /**
     * @test update
     */
    public function test_update_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $fakeRecommendPlace = $this->fakeRecommendPlaceData();
        $updatedRecommendPlace = $this->recommendPlaceRepo->update($fakeRecommendPlace, $recommendPlace->id);
        $this->assertModelData($fakeRecommendPlace, $updatedRecommendPlace->toArray());
        $dbRecommendPlace = $this->recommendPlaceRepo->find($recommendPlace->id);
        $this->assertModelData($fakeRecommendPlace, $dbRecommendPlace->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $resp = $this->recommendPlaceRepo->delete($recommendPlace->id);
        $this->assertTrue($resp);
        $this->assertNull(RecommendPlace::find($recommendPlace->id), 'RecommendPlace should not exist in DB');
    }
}
