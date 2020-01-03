<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePushTrait;
use Tests\ApiTestTrait;

class PushApiTest extends TestCase
{
    use MakePushTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_push()
    {
        $push = $this->fakePushData();
        $this->response = $this->json('POST', '/api/pushes', $push);

        $this->assertApiResponse($push);
    }

    /**
     * @test
     */
    public function test_read_push()
    {
        $push = $this->makePush();
        $this->response = $this->json('GET', '/api/pushes/'.$push->id);

        $this->assertApiResponse($push->toArray());
    }

    /**
     * @test
     */
    public function test_update_push()
    {
        $push = $this->makePush();
        $editedPush = $this->fakePushData();

        $this->response = $this->json('PUT', '/api/pushes/'.$push->id, $editedPush);

        $this->assertApiResponse($editedPush);
    }

    /**
     * @test
     */
    public function test_delete_push()
    {
        $push = $this->makePush();
        $this->response = $this->json('DELETE', '/api/pushes/'.$push->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/pushes/'.$push->id);

        $this->response->assertStatus(404);
    }
}
