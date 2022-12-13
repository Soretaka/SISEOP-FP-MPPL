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
        \App\Models\jenisPertanyaan::factory()->create([
            'NamaJenisPertanyaan' => 'V',
        ]);
        \App\Models\jenisPertanyaan::factory()->create([
            'NamaJenisPertanyaan' => 'I',
        ]);
        \App\Models\jenisPertanyaan::factory()->create([
            'NamaJenisPertanyaan' => 'P',
        ]);
        \App\Models\jenisPertanyaan::factory()->create([
            'NamaJenisPertanyaan' => 'S',
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
            'name' => 'responden',
            'email' => 'responden@gmail.com',
            'isAdmin' => '0',
            'tl' => 'Bandung',
            'alamat' => 'Bandung',
            'noTelp' => '081234567890',
            'NIP' => '1234567890',
            'JK' => 'Laki-laki',
            'jabatan_id' => '3',
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
        \App\Models\survey::factory()->create([
            'NamaSurvey' => 'Survey 1',
            'Deskripsi' => 'Deskripsi Survey 1',
            'user_id' => '2',
        ]);
        \App\Models\survey::factory()->create([
            'NamaSurvey' => 'Survey 2',
            'Deskripsi' => 'Deskripsi Survey 2',
            'user_id' => '2',
        ]);
        \App\Models\survey_user::factory()->create([
            'user_id' => '3',
            'survey_id' => '1',
        ]);
    }
}
