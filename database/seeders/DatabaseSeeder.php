<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        \App\Models\Profile::create([
            'name' => 'Albertus Reno Aditama',
            'age' => 19,
            'birth_date' => '2006-11-15',
            'school' => 'SMAK Frateran',
            'class' => '12 E',
            'description' => 'Seorang siswa SMAK Frateran kelas 12 E yang memiliki minat di bidang informatika dan gaming.',
            'profile_image' => null,
        ]);
    }
}
