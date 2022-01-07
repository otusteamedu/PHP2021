<?php

namespace Database\Factories;

use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::pluck('id')->random(),
            'insurance_id' => Insurance::pluck('id')->random(),
            'number' => $this->faker->randomNumber(),
            'startDate' => $this->faker->dateTimeThisYear,
            'endDate' => $this->faker->dateTimeBetween('-1 month','+1 years'),
            'avans' => $this->faker->boolean,
            'program_id' => Program::pluck('id')->random(),
            'description' => $this->faker->realTextBetween(30,100)
        ];
    }
}
