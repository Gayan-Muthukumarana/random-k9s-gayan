<?php

namespace Tests\Feature;

use App\Enums\RandomFactUserTypesEnum;
use App\Models\Fact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FactControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the successful retrieval of a random fact based on user type.
     *
     * @return void
     */
    public function testRandomFactSuccess()
    {
        $fact = Fact::factory()->create();

        $userType = $fact->is_contain_numbers ? RandomFactUserTypesEnum::NUMBERPHILE->value : RandomFactUserTypesEnum::NON_NUMBERPHILE->value;

        $response = $this->getJson(route('fact.get-random-fact', ['user_type' => $userType]));
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'Success',
                'message' => 'Successfully retrieved data',
                'data' => $fact->description
            ]);

    }

    /**
     * Test that a random fact request with no matching records results in a 404 response.
     *
     * @return void
     */
    public function testRandomFactNotFound()
    {
        $fact = Fact::factory()->create();

        $userType = $fact->is_contain_numbers ? RandomFactUserTypesEnum::NON_NUMBERPHILE->value : RandomFactUserTypesEnum::NUMBERPHILE->value;

        $response = $this->get(route('fact.get-random-fact', ['user_type' => $userType]));
        $response->assertStatus(404)
            ->assertJson([
                'status' => 'Error',
                'message' => 'No matching record found!',
                'data' => null,
            ]);
    }
}
