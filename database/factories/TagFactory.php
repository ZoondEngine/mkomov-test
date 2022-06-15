<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(15),
            'tagable_id' => Article::query()->find(
                rand(Article::query()->min('id'), Article::query()->max('id'))
            ),
            'tagable_type' => Article::class
        ];
    }
}