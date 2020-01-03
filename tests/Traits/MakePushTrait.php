<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Push;
use App\Repositories\PushRepository;

trait MakePushTrait
{
    /**
     * Create fake instance of Push and save it in database
     *
     * @param array $pushFields
     * @return Push
     */
    public function makePush($pushFields = [])
    {
        /** @var PushRepository $pushRepo */
        $pushRepo = \App::make(PushRepository::class);
        $theme = $this->fakePushData($pushFields);
        return $pushRepo->create($theme);
    }

    /**
     * Get fake instance of Push
     *
     * @param array $pushFields
     * @return Push
     */
    public function fakePush($pushFields = [])
    {
        return new Push($this->fakePushData($pushFields));
    }

    /**
     * Get fake data of Push
     *
     * @param array $pushFields
     * @return array
     */
    public function fakePushData($pushFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'body' => $fake->word,
            'json' => $fake->word,
            'ttl' => $fake->randomDigitNotNull,
            'image' => $fake->word,
            'channel' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $pushFields);
    }
}
