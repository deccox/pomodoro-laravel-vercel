<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TimerRegister;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimersRegister>
 */
class TimerRegisterFactory extends Factory
{


    protected $model = TimerRegister::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(2),
            'timer_quantity' => $this->faker->time("H:i"),
            'timer_day' => $this->faker->dateTimeThisYear()
        ];
    }
}
