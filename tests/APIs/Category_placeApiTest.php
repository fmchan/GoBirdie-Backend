<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCategory_placeTrait;
use Tests\ApiTestTrait;

class Category_placeApiTest extends TestCase
{
    use MakeCategory_placeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category_place()
    {
        $categoryPlace = $this->fakeCategory_placeData();
        $this->response = $this->json('POST', '/api/categoryPlaces', $categoryPlace);

        $this->assertApiResponse($categoryPlace);
    }

    /**
     * @test
     */
    public function test_read_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $this->response = $this->json('GET', '/api/categoryPlaces/'.$categoryPlace->id);

        $this->assertApiResponse($categoryPlace->toArray());
    }

    /**
     * @test
     */
    public function test_update_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $editedCategory_place = $this->fakeCategory_placeData();

        $this->response = $this->json('PUT', '/api/categoryPlaces/'.$categoryPlace->id, $editedCategory_place);

        $this->assertApiResponse($editedCategory_place);
    }

    /**
     * @test
     */
    public function test_delete_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $this->response = $this->json('DELETE', '/api/categoryPlaces/'.$categoryPlace->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/categoryPlaces/'.$categoryPlace->id);

        $this->response->assertStatus(404);
    }
}
