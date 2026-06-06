<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Utilisateur Test',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $categories = [
            ['name' => 'Incendie', 'icon' => '🔥'],
            ['name' => 'Fuite d’eau', 'icon' => '💧'],
            ['name' => 'Pollution', 'icon' => '🌫️'],
            ['name' => 'Trou sur la route', 'icon' => '🕳️'],
            ['name' => 'Éclairage public', 'icon' => '💡'],
            ['name' => 'Accident', 'icon' => '🚗'],
            ['name' => 'Embouteillage', 'icon' => '🚦'],
            ['name' => 'Déchets', 'icon' => '🗑️'],
            ['name' => 'Infrastructure endommagée', 'icon' => '🧱'],
            ['name' => 'Panne électrique', 'icon' => '⚡'],
            ['name' => 'Inondation', 'icon' => '🌊'],
            ['name' => 'Travaux publics', 'icon' => '🛠️'],
            ['name' => 'Transport public', 'icon' => '🚌'],
            ['name' => 'Danger public', 'icon' => '⚠️'],
            ['name' => 'Autre', 'icon' => '📌'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
