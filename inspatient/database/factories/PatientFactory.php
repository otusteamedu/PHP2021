<?php

namespace Database\Factories;

use App\Models\Filial;
use App\Models\Polis;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birthday' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'work' => $this->faker->company(),
            'filial_id' => Filial::pluck('id')->random(),
            'aboutAdding' => $this->faker->realTextBetween(50,100),
            'aboutRemove' => $this->faker->realTextBetween(30,100),
            'description' => $this->faker->realTextBetween(40,100)

        ];
    }
}
