<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskKind;
use App\Models\TaskResolution;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'name' => $this->faker->realText(10),
            'task_kind_id' => TaskKind::factory(),
            'detail' => $this->faker->realText(100),
            'task_status_id' => TaskStatus::factory(),
            'created_user_id' => User::factory(),
            'updated_user_id' => User::factory(),
            'assigner_id' => User::factory(),
            'task_category_id' => TaskCategory::factory(),
        ];
    }
}
