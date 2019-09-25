<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRecommendPlaceTrait;
use Tests\ApiTestTrait;

class RecommendPlaceApiTest extends TestCase
{
    use MakeRecommendPlaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_recommend_place()
    {
        $recommendPlace = $this->fakeRecommendPlaceData();
        $this->response = $this->json('POST', '/api/recommendPlaces', $recommendPlace);

        $this->assertApiResponse($recommendPlace);
    }

    /**
     * @test
     */
    public function test_read_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $this->response = $this->json('GET', '/api/recommendPlaces/'.$recommendPlace->id);

        $this->assertApiResponse($recommendPlace->toArray());
    }

    /**
     * @test
     */
    public function test_update_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $editedRecommendPlace = $this->fakeRecommendPlaceData();

        $this->response = $this->json('PUT', '/api/recommendPlaces/'.$recommendPlace->id, $editedRecommendPlace);

        $this->assertApiResponse($editedRecommendPlace);
    }

    /**
     * @test
     */
    public function test_delete_recommend_place()
    {
        $recommendPlace = $this->makeRecommendPlace();
        $this->response = $this->json('DELETE', '/api/recommendPlaces/'.$recommendPlace->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/recommendPlaces/'.$recommendPlace->id);

        $this->response->assertStatus(404);
    }
}
