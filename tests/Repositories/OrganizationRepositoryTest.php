<?php namespace Tests\Repositories;

use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeOrganizationTrait;
use Tests\ApiTestTrait;

class OrganizationRepositoryTest extends TestCase
{
    use MakeOrganizationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrganizationRepository
     */
    protected $organizationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->organizationRepo = \App::make(OrganizationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_organization()
    {
        $organization = $this->fakeOrganizationData();
        $createdOrganization = $this->organizationRepo->create($organization);
        $createdOrganization = $createdOrganization->toArray();
        $this->assertArrayHasKey('id', $createdOrganization);
        $this->assertNotNull($createdOrganization['id'], 'Created Organization must have id specified');
        $this->assertNotNull(Organization::find($createdOrganization['id']), 'Organization with given id must be in DB');
        $this->assertModelData($organization, $createdOrganization);
    }

    /**
     * @test read
     */
    public function test_read_organization()
    {
        $organization = $this->makeOrganization();
        $dbOrganization = $this->organizationRepo->find($organization->id);
        $dbOrganization = $dbOrganization->toArray();
        $this->assertModelData($organization->toArray(), $dbOrganization);
    }

    /**
     * @test update
     */
    public function test_update_organization()
    {
        $organization = $this->makeOrganization();
        $fakeOrganization = $this->fakeOrganizationData();
        $updatedOrganization = $this->organizationRepo->update($fakeOrganization, $organization->id);
        $this->assertModelData($fakeOrganization, $updatedOrganization->toArray());
        $dbOrganization = $this->organizationRepo->find($organization->id);
        $this->assertModelData($fakeOrganization, $dbOrganization->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_organization()
    {
        $organization = $this->makeOrganization();
        $resp = $this->organizationRepo->delete($organization->id);
        $this->assertTrue($resp);
        $this->assertNull(Organization::find($organization->id), 'Organization should not exist in DB');
    }
}
