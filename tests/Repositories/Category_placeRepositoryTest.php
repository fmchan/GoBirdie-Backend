<?php namespace Tests\Repositories;

use App\Models\Category_place;
use App\Repositories\Category_placeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCategory_placeTrait;
use Tests\ApiTestTrait;

class Category_placeRepositoryTest extends TestCase
{
    use MakeCategory_placeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Category_placeRepository
     */
    protected $categoryPlaceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categoryPlaceRepo = \App::make(Category_placeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_category_place()
    {
        $categoryPlace = $this->fakeCategory_placeData();
        $createdCategory_place = $this->categoryPlaceRepo->create($categoryPlace);
        $createdCategory_place = $createdCategory_place->toArray();
        $this->assertArrayHasKey('id', $createdCategory_place);
        $this->assertNotNull($createdCategory_place['id'], 'Created Category_place must have id specified');
        $this->assertNotNull(Category_place::find($createdCategory_place['id']), 'Category_place with given id must be in DB');
        $this->assertModelData($categoryPlace, $createdCategory_place);
    }

    /**
     * @test read
     */
    public function test_read_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $dbCategory_place = $this->categoryPlaceRepo->find($categoryPlace->id);
        $dbCategory_place = $dbCategory_place->toArray();
        $this->assertModelData($categoryPlace->toArray(), $dbCategory_place);
    }

    /**
     * @test update
     */
    public function test_update_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $fakeCategory_place = $this->fakeCategory_placeData();
        $updatedCategory_place = $this->categoryPlaceRepo->update($fakeCategory_place, $categoryPlace->id);
        $this->assertModelData($fakeCategory_place, $updatedCategory_place->toArray());
        $dbCategory_place = $this->categoryPlaceRepo->find($categoryPlace->id);
        $this->assertModelData($fakeCategory_place, $dbCategory_place->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_category_place()
    {
        $categoryPlace = $this->makeCategory_place();
        $resp = $this->categoryPlaceRepo->delete($categoryPlace->id);
        $this->assertTrue($resp);
        $this->assertNull(Category_place::find($categoryPlace->id), 'Category_place should not exist in DB');
    }
}
