<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['name' => 'Fish', 'description' => 'Fresh fish and seafood products'],
            ['name' => 'Chicken', 'description' => 'Poultry and chicken products'],
            ['name' => 'Beef', 'description' => 'Beef and red meat products'],
            ['name' => 'Dairy-free', 'description' => 'Products without dairy ingredients'],
            ['name' => 'Gluten-free', 'description' => 'Products without gluten'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
