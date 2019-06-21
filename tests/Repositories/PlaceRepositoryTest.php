<?php namespace Tests\Repositories;

use App\Models\Place;
use App\Repositories\PlaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlaceTrait;
use Tests\ApiTestTrait;

class PlaceRepositoryTest extends TestCase
{
    use MakePlaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlaceRepository
     */
    protected $placeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->placeRepo = \App::make(PlaceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_place()
    {
        $place = $this->fakePlaceData();
        $createdPlace = $this->placeRepo->create($place);
        $createdPlace = $createdPlace->toArray();
        $this->assertArrayHasKey('id', $createdPlace);
        $this->assertNotNull($createdPlace['id'], 'Created Place must have id specified');
        $this->assertNotNull(Place::find($createdPlace['id']), 'Place with given id must be in DB');
        $this->assertModelData($place, $createdPlace);
    }

    /**
     * @test read
     */
    public function test_read_place()
    {
        $place = $this->makePlace();
        $dbPlace = $this->placeRepo->find($place->id);
        $dbPlace = $dbPlace->toArray();
        $this->assertModelData($place->toArray(), $dbPlace);
    }

    /**
     * @test update
     */
    public function test_update_place()
    {
        $place = $this->makePlace();
        $fakePlace = $this->fakePlaceData();
        $updatedPlace = $this->placeRepo->update($fakePlace, $place->id);
        $this->assertModelData($fakePlace, $updatedPlace->toArray());
        $dbPlace = $this->placeRepo->find($place->id);
        $this->assertModelData($fakePlace, $dbPlace->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_place()
    {
        $place = $this->makePlace();
        $resp = $this->placeRepo->delete($place->id);
        $this->assertTrue($resp);
        $this->assertNull(Place::find($place->id), 'Place should not exist in DB');
    }
}
