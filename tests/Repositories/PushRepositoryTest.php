<?php namespace Tests\Repositories;

use App\Models\Push;
use App\Repositories\PushRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePushTrait;
use Tests\ApiTestTrait;

class PushRepositoryTest extends TestCase
{
    use MakePushTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PushRepository
     */
    protected $pushRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pushRepo = \App::make(PushRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_push()
    {
        $push = $this->fakePushData();
        $createdPush = $this->pushRepo->create($push);
        $createdPush = $createdPush->toArray();
        $this->assertArrayHasKey('id', $createdPush);
        $this->assertNotNull($createdPush['id'], 'Created Push must have id specified');
        $this->assertNotNull(Push::find($createdPush['id']), 'Push with given id must be in DB');
        $this->assertModelData($push, $createdPush);
    }

    /**
     * @test read
     */
    public function test_read_push()
    {
        $push = $this->makePush();
        $dbPush = $this->pushRepo->find($push->id);
        $dbPush = $dbPush->toArray();
        $this->assertModelData($push->toArray(), $dbPush);
    }

    /**
     * @test update
     */
    public function test_update_push()
    {
        $push = $this->makePush();
        $fakePush = $this->fakePushData();
        $updatedPush = $this->pushRepo->update($fakePush, $push->id);
        $this->assertModelData($fakePush, $updatedPush->toArray());
        $dbPush = $this->pushRepo->find($push->id);
        $this->assertModelData($fakePush, $dbPush->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_push()
    {
        $push = $this->makePush();
        $resp = $this->pushRepo->delete($push->id);
        $this->assertTrue($resp);
        $this->assertNull(Push::find($push->id), 'Push should not exist in DB');
    }
}
