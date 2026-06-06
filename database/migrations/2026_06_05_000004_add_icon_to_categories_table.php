<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('name');
        });

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
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']],
                ['icon' => $category['icon']]
            );
        }

        $englishToFrench = [
            'Road Safety' => ['name' => 'Incendie', 'icon' => '🔥'],
            'Waste Collection' => ['name' => 'Déchets', 'icon' => '🗑️'],
            'Public Lighting' => ['name' => 'Éclairage public', 'icon' => '💡'],
            'Water Issue' => ['name' => 'Fuite d’eau', 'icon' => '💧'],
        ];

        foreach ($englishToFrench as $englishName => $newData) {
            DB::table('categories')->where('name', $englishName)->update($newData);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
