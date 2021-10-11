<?php

namespace Database\Factories;

use App\Models\UserAuthority;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAuthorityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAuthority::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => '閲覧',
            'display_order' => 1,
        ];
    }
}
