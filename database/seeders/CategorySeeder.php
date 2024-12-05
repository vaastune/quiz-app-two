<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Add the categories you want to seed here
        Category::create(['name' => 'Math']);
        Category::create(['name' => 'Science']);
        Category::create(['name' => 'History']);
    }
}
