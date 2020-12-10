<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::now();
        $created_at = $now->subMinutes(40);
        $now = Carbon::now();
        $updated_at = $now->subMinutes(20);
        return [
            'title' => $this->faker->sentence(4),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['NEW', 'DONE', 'UNDONE']),
            'created_at' => $created_at,
            'updated_at' => $this->faker->dateTimeBetween($created_at, $updated_at)
        ];
    }
}
