<?php


namespace App\tests;


use App\Models\AdvertiserId;
use PHPUnit\Framework\TestCase;

class AdvertiserIdTest extends TestCase
{
    public function test_it_should_be_create_advertiser_id()
    {
        $advertiserId = new AdvertiserId(Constants::ADVERTISER_ID);

        $this->assertEquals(Constants::ADVERTISER_ID, $advertiserId);
    }
}