<?php
// database/factories/ArtikelFactory.php
// database/factories/ArtikelFactory.php

namespace Database\Factories;

use App\Models\Artikel;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ArtikelFactory extends Factory
{
    protected $model = Artikel::class;

    public function definition(): array
    {
        // Buat nama file unik
        $filename = Str::random(10) . '.jpg';
        $path = 'artikel/' . $filename;

        // Coba ambil gambar dari picsum
        try {
            $image = Http::timeout(5)->get('https://picsum.photos/640/480');
            if ($image->successful()) {
                Storage::disk('public')->put($path, $image->body());
            }
        } catch (\Exception $e) {
            $path = 'artikel/default.jpg';
        }

        return [
            'judul' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence()),
            'body' => $this->faker->paragraph(20),
            'kategori_id' => Kategori::inRandomOrder()->value('id') ?? 1,
            'user_id' => User::inRandomOrder()->value('id') ?? 1,
            'gambar_artikel' => 'storage/' . $path,
            'is_actived' => $this->faker->boolean(90),
            'views' => $this->faker->numberBetween(0, 500),
        ];
    }
}
