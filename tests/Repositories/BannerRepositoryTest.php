<?php namespace Tests\Repositories;

use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBannerTrait;
use Tests\ApiTestTrait;

class BannerRepositoryTest extends TestCase
{
    use MakeBannerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BannerRepository
     */
    protected $bannerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bannerRepo = \App::make(BannerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_banner()
    {
        $banner = $this->fakeBannerData();
        $createdBanner = $this->bannerRepo->create($banner);
        $createdBanner = $createdBanner->toArray();
        $this->assertArrayHasKey('id', $createdBanner);
        $this->assertNotNull($createdBanner['id'], 'Created Banner must have id specified');
        $this->assertNotNull(Banner::find($createdBanner['id']), 'Banner with given id must be in DB');
        $this->assertModelData($banner, $createdBanner);
    }

    /**
     * @test read
     */
    public function test_read_banner()
    {
        $banner = $this->makeBanner();
        $dbBanner = $this->bannerRepo->find($banner->id);
        $dbBanner = $dbBanner->toArray();
        $this->assertModelData($banner->toArray(), $dbBanner);
    }

    /**
     * @test update
     */
    public function test_update_banner()
    {
        $banner = $this->makeBanner();
        $fakeBanner = $this->fakeBannerData();
        $updatedBanner = $this->bannerRepo->update($fakeBanner, $banner->id);
        $this->assertModelData($fakeBanner, $updatedBanner->toArray());
        $dbBanner = $this->bannerRepo->find($banner->id);
        $this->assertModelData($fakeBanner, $dbBanner->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_banner()
    {
        $banner = $this->makeBanner();
        $resp = $this->bannerRepo->delete($banner->id);
        $this->assertTrue($resp);
        $this->assertNull(Banner::find($banner->id), 'Banner should not exist in DB');
    }
}
