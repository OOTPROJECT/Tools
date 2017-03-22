<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'firstname' => 'KingMath',
            'lastname' => 'Admin',
            'email' => 'admin@kingmath.com',
            'password' => bcrypt('12345678'),
            'image' => '/img/avatar.png',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'remember_token' => str_random(10),
        ]);
    }
}
