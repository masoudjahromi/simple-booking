<?php

namespace App\tests;

use PHPUnit\Framework\TestCase;
use App\Models\ReferralProviderId;

/**
 * Class ReferralProviderTest
 *
 * @package App\tests
 */
class ReferralProviderTest extends TestCase
{
    public function test_it_should_be_create_referral_provider_id()
    {
        $referralProvider = new ReferralProviderId(\App\Constants::TRIVAGO);

        $this->assertEquals(\App\Constants::TRIVAGO, $referralProvider);
    }
}