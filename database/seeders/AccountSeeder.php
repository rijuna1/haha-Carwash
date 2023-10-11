<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'role'=> 'Admin'
            ],
            [
                'name' => 'Pegawai',
                'username' => 'pegawai',
                'password' => bcrypt('password'),
                'role'=> 'Pegawai'
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
