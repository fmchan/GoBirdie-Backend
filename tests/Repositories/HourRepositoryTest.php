<?php namespace Tests\Repositories;

use App\Models\Hour;
use App\Repositories\HourRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHourTrait;
use Tests\ApiTestTrait;

class HourRepositoryTest extends TestCase
{
    use MakeHourTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HourRepository
     */
    protected $hourRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hourRepo = \App::make(HourRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hour()
    {
        $hour = $this->fakeHourData();
        $createdHour = $this->hourRepo->create($hour);
        $createdHour = $createdHour->toArray();
        $this->assertArrayHasKey('id', $createdHour);
        $this->assertNotNull($createdHour['id'], 'Created Hour must have id specified');
        $this->assertNotNull(Hour::find($createdHour['id']), 'Hour with given id must be in DB');
        $this->assertModelData($hour, $createdHour);
    }

    /**
     * @test read
     */
    public function test_read_hour()
    {
        $hour = $this->makeHour();
        $dbHour = $this->hourRepo->find($hour->id);
        $dbHour = $dbHour->toArray();
        $this->assertModelData($hour->toArray(), $dbHour);
    }

    /**
     * @test update
     */
    public function test_update_hour()
    {
        $hour = $this->makeHour();
        $fakeHour = $this->fakeHourData();
        $updatedHour = $this->hourRepo->update($fakeHour, $hour->id);
        $this->assertModelData($fakeHour, $updatedHour->toArray());
        $dbHour = $this->hourRepo->find($hour->id);
        $this->assertModelData($fakeHour, $dbHour->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hour()
    {
        $hour = $this->makeHour();
        $resp = $this->hourRepo->delete($hour->id);
        $this->assertTrue($resp);
        $this->assertNull(Hour::find($hour->id), 'Hour should not exist in DB');
    }
}
