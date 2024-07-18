<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::factory()->count(10)->create(); // Create 10 categories

        // Attach websites to categories
        Website::all()->each(function ($website) use ($categories) {
            $website->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray() // Attach 1-3 random categories to each website
            );
        });
    }
}
