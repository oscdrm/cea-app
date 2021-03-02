<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Oscar',
            'email' => 'gotiel.orm@gmail.com',
            'password' => bcrypt('qwerty123456'),
            'lastName' => 'Rangel',
            'username' => 'admin',
            'telephone' => '5522735280',
            'user_photo' => 'aws',
            'role_id' => 1
        ]);
    }
}
