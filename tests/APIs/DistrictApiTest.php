<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDistrictTrait;
use Tests\ApiTestTrait;

class DistrictApiTest extends TestCase
{
    use MakeDistrictTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_district()
    {
        $district = $this->fakeDistrictData();
        $this->response = $this->json('POST', '/api/districts', $district);

        $this->assertApiResponse($district);
    }

    /**
     * @test
     */
    public function test_read_district()
    {
        $district = $this->makeDistrict();
        $this->response = $this->json('GET', '/api/districts/'.$district->id);

        $this->assertApiResponse($district->toArray());
    }

    /**
     * @test
     */
    public function test_update_district()
    {
        $district = $this->makeDistrict();
        $editedDistrict = $this->fakeDistrictData();

        $this->response = $this->json('PUT', '/api/districts/'.$district->id, $editedDistrict);

        $this->assertApiResponse($editedDistrict);
    }

    /**
     * @test
     */
    public function test_delete_district()
    {
        $district = $this->makeDistrict();
        $this->response = $this->json('DELETE', '/api/districts/'.$district->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/districts/'.$district->id);

        $this->response->assertStatus(404);
    }
}
