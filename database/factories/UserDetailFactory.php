<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'address1' => $this->faker->streetAddress,
            'address2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'postal_code' => $this->faker->numerify('#####'),
            'country' => 'US',
            'phone' => $this->faker->numerify('##########'),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'dob' => $this->faker->dateTimeBetween('1990-01-01', '2008-12-31')->format('Y-m-d')
        ];
    }
}
