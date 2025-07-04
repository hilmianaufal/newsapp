<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artikel::factory()->count(20)->create();
    }
}
