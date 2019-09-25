<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHotKeywordPlaceTrait;
use Tests\ApiTestTrait;

class HotKeywordPlaceApiTest extends TestCase
{
    use MakeHotKeywordPlaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hot_keyword_place()
    {
        $hotKeywordPlace = $this->fakeHotKeywordPlaceData();
        $this->response = $this->json('POST', '/api/hotKeywordPlaces', $hotKeywordPlace);

        $this->assertApiResponse($hotKeywordPlace);
    }

    /**
     * @test
     */
    public function test_read_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $this->response = $this->json('GET', '/api/hotKeywordPlaces/'.$hotKeywordPlace->id);

        $this->assertApiResponse($hotKeywordPlace->toArray());
    }

    /**
     * @test
     */
    public function test_update_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $editedHotKeywordPlace = $this->fakeHotKeywordPlaceData();

        $this->response = $this->json('PUT', '/api/hotKeywordPlaces/'.$hotKeywordPlace->id, $editedHotKeywordPlace);

        $this->assertApiResponse($editedHotKeywordPlace);
    }

    /**
     * @test
     */
    public function test_delete_hot_keyword_place()
    {
        $hotKeywordPlace = $this->makeHotKeywordPlace();
        $this->response = $this->json('DELETE', '/api/hotKeywordPlaces/'.$hotKeywordPlace->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/hotKeywordPlaces/'.$hotKeywordPlace->id);

        $this->response->assertStatus(404);
    }
}
