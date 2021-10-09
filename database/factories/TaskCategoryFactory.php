<?php

namespace Database\Factories;

use App\Models\TaskCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => '教科指導',
            'display_order' => 1,
        ];
    }
}
