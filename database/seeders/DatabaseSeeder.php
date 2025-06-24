<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Category::factory(5)
            ->has(\App\Models\Product::factory()->count(3))
            ->create();
    }
}
