<?php

namespace Database\Factories;

use App\Models\Chapters;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Novels;

class ChaptersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chapters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $novel = Novels::factory()->create();

        return [
            'novel_id' => $novel->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(rand(3, 5), true),
            'chapter_number' => $this->faker->numberBetween(1, 20),
        ];
    }
}
