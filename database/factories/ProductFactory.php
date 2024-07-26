<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(5, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(600, 600),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'compare_price' => $this->faker->randomFloat(2, 5, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'options' => json_encode(['color' => $this->faker->colorName, 'size' => $this->faker->word]), // Manually creating JSON
            'featured' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
