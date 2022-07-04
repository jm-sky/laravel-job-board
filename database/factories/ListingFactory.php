<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5, 7));
        $datetime = $this->faker->dateTimeBetween('-;1 month', 'now');

        $content = '';
        for ($i = 0; $i < 5; $i++) {
            $content .= '<p class="mb-4">' . $this->faker->sentences(rand(5, 10), true). '</p>';
        }

        // $file = basename($this->faker->image(storage_path('app/public/images'), 200, 200, null, true));
        $file = $file ?? 'RBhrmgJSeFuPO1HhRmco3tXUYvSjWnNeP5KZCbFd.png';

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(1111, 9999),
            'company' => $this->faker->company(),
            'location' => $this->faker->country(),
            'logo' => $file,
            'is_highlighted' => rand(0, 100) > 75,
            'is_active' => true,
            'content' => $content,
            'apply_link' => $this->faker->url(),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
