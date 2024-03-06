<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activity()->disableLogging();

        $admin = User::create([
            'name' => 'Admin',
            'phone' => '000000000001',
            'phonecode' => '62',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => null,
        ]);
        $approval1 = User::create([
            'name' => 'Kantor Cabang',
            'phone' => '000000000002',
            'phonecode' => '62',
            'email' => 'approval1@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => null,
        ]);
        $approval2 = User::create([
            'name' => 'Kantor Pusat',
            'phone' => '000000000003',
            'phonecode' => '62',
            'email' => 'approval2@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => null,
        ]);


        $admin->assignRole('admin');
        $approval1->assignRole('approval1');
        $approval2->assignRole('approval2');
    }
}