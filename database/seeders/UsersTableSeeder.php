<?php

namespace Database\Seeders;

use App\Models\User;

use DB;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate a specific Username

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'email_verified_at' => NULL,
        //     'password' => Hash::make('password'),
        //     'is_admin' => 0,
        //     'remember_token' => NULL,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        \App\Models\User::factory()->count(2)->create(); 
    }
}
