<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Romantis', 'Horor', 'Fantasi', 'Komedi', 'Drama'];

        foreach ($categories as $cat) {
            Category::create([
                'name'=> $cat,
                'slug'=> Str::slug($cat)
            ]);
        }
    }
}
