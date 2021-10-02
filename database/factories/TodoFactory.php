<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
