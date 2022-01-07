<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' =>$this->faker->realTextBetween(50,150)
        ];
    }
}
