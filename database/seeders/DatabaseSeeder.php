<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\jabatan::factory()->create([
            'NamaJabatan' => 'Guest',
        ]);
        \App\Models\jabatan::factory()->create([
            'NamaJabatan' => 'Surveyor',
        ]);
        \App\Models\jabatan::factory()->create([
            'NamaJabatan' => 'Responden',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'surveyor',
            'email' => 'surveyor@gmail.com',
            'isAdmin' => '0',
            'tl' => 'Bandung',
            'alamat' => 'Bandung',
            'noTelp' => '081234567890',
            'NIP' => '1234567890',
            'JK' => 'Laki-laki',
            'jabatan_id' => '2',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => '1',
            'tl' => 'Bandung',
            'alamat' => 'Bandung',
            'noTelp' => '081234567890',
            'NIP' => '1234567890',
            'JK' => 'Laki-laki',
            'jabatan_id' => '2',
        ]);
    }
}
