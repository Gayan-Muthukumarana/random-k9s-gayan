<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->sentence . ' ' . ((rand(0, 1) === 0) ? 10 : 'ten');
        $isContainNumbers = preg_match('/\d/', $description) ? 1 : 0;

        return [
            'uuid' => substr(str_replace('-', '', Str::uuid()), 0, 10),
            'description' => $description,
            'is_contain_numbers' => $isContainNumbers
        ];
    }
}
