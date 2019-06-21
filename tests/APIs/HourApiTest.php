<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHourTrait;
use Tests\ApiTestTrait;

class HourApiTest extends TestCase
{
    use MakeHourTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hour()
    {
        $hour = $this->fakeHourData();
        $this->response = $this->json('POST', '/api/hours', $hour);

        $this->assertApiResponse($hour);
    }

    /**
     * @test
     */
    public function test_read_hour()
    {
        $hour = $this->makeHour();
        $this->response = $this->json('GET', '/api/hours/'.$hour->id);

        $this->assertApiResponse($hour->toArray());
    }

    /**
     * @test
     */
    public function test_update_hour()
    {
        $hour = $this->makeHour();
        $editedHour = $this->fakeHourData();

        $this->response = $this->json('PUT', '/api/hours/'.$hour->id, $editedHour);

        $this->assertApiResponse($editedHour);
    }

    /**
     * @test
     */
    public function test_delete_hour()
    {
        $hour = $this->makeHour();
        $this->response = $this->json('DELETE', '/api/hours/'.$hour->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/hours/'.$hour->id);

        $this->response->assertStatus(404);
    }
}
