<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('unit_kerjas')->insert(
            [
                 'nama_unit_kerja' => 'Super User',
            ],
        );

        DB::table('users')->insert(
            [
                'name' => 'Super Admin',
                'role' => 'superadmin',
                'password' => bcrypt('12341234'),
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Tasikmalaya',
                'username' => 'superadmin',
                'id_unit_kerja' => '1',
                'telp' => '098876532456',
            ],
        );



        DB::table('lembagas')->insert(
            [
                'nama_lembaga' => 'SMK YPC Tasikmalaya',
                'kabupaten' => 'Kab. Tasikmalaya',
                'telp' => '0811 2224 563',
                'email' => 'smkypctasikmalaya@gmail.com',
                'alamat' => 'Jl. Garut - Tasikmalaya, Cikunten, Kec. Singaparna, Kabupaten Tasikmalaya, Jawa Barat 46414',
                'nama_ketua' => 'Drs. Ujang Sanusi, MM.',
            ],
        );

    }
}
