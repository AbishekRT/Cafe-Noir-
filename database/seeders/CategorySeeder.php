<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Single Origin',
                'slug' => 'single-origin',
                'description' => 'Discover the unique flavors of coffee beans from a single region, farm, or country. Each cup tells a story of its origin.',
                'is_active' => true,
            ],
            [
                'name' => 'Blends',
                'slug' => 'blends',
                'description' => 'Expertly crafted coffee blends that combine beans from different origins for a balanced and complex flavor profile.',
                'is_active' => true,
            ],
            [
                'name' => 'Espresso',
                'slug' => 'espresso',
                'description' => 'Dark and bold roasts perfect for espresso lovers. Rich crema and intense flavors in every shot.',
                'is_active' => true,
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Essential coffee brewing accessories and merchandise. From grinders to mugs, everything you need for the perfect brew.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
