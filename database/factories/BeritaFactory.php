<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6, true);
        
        return [
            'slug' => Str::slug($title),
            'image' => 'images/gambar' . $this->faker->numberBetween(1, 6) . '.png',
            'title' => $title,
            'description' => $this->faker->paragraph(2),
            'isi' => $this->faker->paragraphs(8, true),
            'author' => $this->faker->name(),
            'views' => $this->faker->numberBetween(100, 1000),
            'date' => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
        ];
    }
}
