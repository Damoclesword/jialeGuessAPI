<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "jialemilk";
        $user->password = \Illuminate\Support\Facades\Hash::make('jialeguess');
        $user->email = "jiale@admin.com";
        $user->remember_token = str_random(10);
        $user->save();
    }
}
