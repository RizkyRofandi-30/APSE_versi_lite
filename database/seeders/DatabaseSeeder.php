<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'password' => Hash::make('adminptsp'),
            'nik' => 909090,
            'nama' => 'adminptsp',
            'email' => 'adminptsp@gmail.com',
            'no_telp' => '90909090',
            'role' => 'admin_ptsp'
        ]);

        User::factory()->create([
            'password' => Hash::make('admindinkes'),
            'nik' => 909090,
            'nama' => 'admindinkes',
            'email' => 'admindinkes@gmail.com',
            'no_telp' => '90909090',
            'role' => 'admin_dinkes'
        ]);

        User::factory()->create([
            'password' => Hash::make('kepalaptsp'),
            'nik' => 909090,
            'nama' => 'kepalaptsp',
            'email' => 'kepalaptsp@gmail.com',
            'no_telp' => '90909090',
            'role' => 'kepala_ptsp'
        ]);
    }

}
