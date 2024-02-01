<?php

namespace Tests\Feature;

use App\Enums\RandomFactUserTypesEnum;
use App\Enums\StatusEnum;
use App\Models\Fact;
use App\Services\GetUserRelatedFactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetUserRelatedFactServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the successful retrieval of a random fact for a Numberphile user.
     *
     * @return void
     */
    public function testGetRandomFactForANumberphileUser()
    {
        Fact::factory()->create(['is_contain_numbers' => StatusEnum::TRUE->value]);
        $userType = RandomFactUserTypesEnum::NUMBERPHILE->value;

        $service = new GetUserRelatedFactService();
        $randomFact = $service->getRandomFactByUserType($userType);

        $this->assertNotNull($randomFact);
    }

    /**
     * Test that no matching random fact is found for a Numberphile user.
     *
     * @return void
     */
    public function testGetRandomFactNotFoundForANumberphileUser()
    {
        Fact::factory()->create(['is_contain_numbers' => StatusEnum::FALSE->value]);
        $userType = RandomFactUserTypesEnum::NUMBERPHILE->value;

        $service = new GetUserRelatedFactService();
        $randomFact = $service->getRandomFactByUserType($userType);

        $this->assertNull($randomFact);
    }

    /**
     * Test the successful retrieval of a random fact for a Non-Numberphile user.
     *
     * @return void
     */
    public function testGetRandomFactForANonNumberphileUser()
    {
        Fact::factory()->create(['is_contain_numbers' => StatusEnum::FALSE->value]);
        $userType = RandomFactUserTypesEnum::NON_NUMBERPHILE->value;

        $service = new GetUserRelatedFactService();
        $randomFact = $service->getRandomFactByUserType($userType);

        $this->assertNotNull($randomFact);
    }

    /**
     * Test that no matching random fact is found for a Non-Numberphile user.
     *
     * @return void
     */
    public function testGetRandomFactNotFoundForANonNumberphileUser()
    {
        Fact::factory()->create(['is_contain_numbers' => StatusEnum::TRUE->value]);
        $userType = RandomFactUserTypesEnum::NON_NUMBERPHILE->value;

        $service = new GetUserRelatedFactService();
        $randomFact = $service->getRandomFactByUserType($userType);

        $this->assertNull($randomFact);
    }
}
