<?php

namespace Database\Factories;

use App\Models\Novels;
use Illuminate\Database\Eloquent\Factories\Factory;

class NovelsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Novels::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'cover_image' => 'default.jpg', // Contoh: Anda dapat menentukan nilai default untuk cover_image
            'genre' => $this->faker->word,
            'status' => 'Completed', // Contoh: Anda dapat menentukan nilai default untuk status
        ];
    }
}
