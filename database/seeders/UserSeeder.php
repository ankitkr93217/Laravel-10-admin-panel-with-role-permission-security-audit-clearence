<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user= User::create(
            [
            'name'=>'Public User',
            'email'=>'publicuser@gmail.com',
            'username'=>'publicuser@gmail.com',
            'password'=>Hash::make('Public@12345'),
            'status'=>1,
            ]
        );
        
        // $user= User::create(
        //     [
        //     'name'=>'Admin User',
        //     'email'=>'admin@gmail.com',
        //     'username'=>'admin@gmail.com',
        //     'password'=>Hash::make('Admin@12345'),
        //     'status'=>1,
        //     ]
        // );
        // $user= User::create(
        //     [
        //     'name'=>'Super Admin',
        //     'email'=>'superadmin@gmail.com',
        //     'username'=>'superadmin@gmail.com',
        //     'password'=>Hash::make('Superadmin@12345'),
        //     'status'=>1,
        //     ]
        // );
        $user->assignRole('USER');
    }
}
