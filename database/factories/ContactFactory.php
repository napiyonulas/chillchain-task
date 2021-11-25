<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name(),
            'phone_country' => 'GB',
            'phone'         => $this->faker->e164PhoneNumber(),
            'company_id'    => Company::factory()->create(),
            'is_primary'    => $this->faker->boolean(100),
        ];
    }
}
