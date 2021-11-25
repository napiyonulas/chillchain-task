<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => Company::factory()->create(),
            'is_primary' => $this->faker->boolean(100),
            'address_line_1' => $this->faker->streetAddress(),
            'address_line_2' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'state_province_county' => $this->faker->state(),
            'country' => $this->faker->country(),
            'other_address_details' => $this->faker->sentence()
        ];
    }
}
