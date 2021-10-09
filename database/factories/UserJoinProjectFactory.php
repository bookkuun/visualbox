<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\UserJoinProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserJoinProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserJoinProject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'project_id' => Project::factory(),
            'user_authority_id' => 1, //1は閲覧
        ];
    }
}
