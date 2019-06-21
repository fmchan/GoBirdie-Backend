<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlaceTrait;
use Tests\ApiTestTrait;

class PlaceApiTest extends TestCase
{
    use MakePlaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_place()
    {
        $place = $this->fakePlaceData();
        $this->response = $this->json('POST', '/api/places', $place);

        $this->assertApiResponse($place);
    }

    /**
     * @test
     */
    public function test_read_place()
    {
        $place = $this->makePlace();
        $this->response = $this->json('GET', '/api/places/'.$place->id);

        $this->assertApiResponse($place->toArray());
    }

    /**
     * @test
     */
    public function test_update_place()
    {
        $place = $this->makePlace();
        $editedPlace = $this->fakePlaceData();

        $this->response = $this->json('PUT', '/api/places/'.$place->id, $editedPlace);

        $this->assertApiResponse($editedPlace);
    }

    /**
     * @test
     */
    public function test_delete_place()
    {
        $place = $this->makePlace();
        $this->response = $this->json('DELETE', '/api/places/'.$place->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/places/'.$place->id);

        $this->response->assertStatus(404);
    }
}
