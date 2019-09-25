<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHighlightPlaceTrait;
use Tests\ApiTestTrait;

class HighlightPlaceApiTest extends TestCase
{
    use MakeHighlightPlaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_highlight_place()
    {
        $highlightPlace = $this->fakeHighlightPlaceData();
        $this->response = $this->json('POST', '/api/highlightPlaces', $highlightPlace);

        $this->assertApiResponse($highlightPlace);
    }

    /**
     * @test
     */
    public function test_read_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $this->response = $this->json('GET', '/api/highlightPlaces/'.$highlightPlace->id);

        $this->assertApiResponse($highlightPlace->toArray());
    }

    /**
     * @test
     */
    public function test_update_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $editedHighlightPlace = $this->fakeHighlightPlaceData();

        $this->response = $this->json('PUT', '/api/highlightPlaces/'.$highlightPlace->id, $editedHighlightPlace);

        $this->assertApiResponse($editedHighlightPlace);
    }

    /**
     * @test
     */
    public function test_delete_highlight_place()
    {
        $highlightPlace = $this->makeHighlightPlace();
        $this->response = $this->json('DELETE', '/api/highlightPlaces/'.$highlightPlace->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/highlightPlaces/'.$highlightPlace->id);

        $this->response->assertStatus(404);
    }
}
