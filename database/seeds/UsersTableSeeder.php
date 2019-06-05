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
    	$u = new User();
    	$u->name = "admin";
    	$u->email = "admin@test.com";
    	$u->password = Hash::make("123456");
    	$u->save();
    	$u->assignRole("admin");

    	$u = new User();
    	$u->name = "super1";
    	$u->email = "super1@test.com";
    	$u->password = Hash::make("123456");
    	$u->save();
    	$u->assignRole("superuser");

    	$u = new User();
    	$u->name = "super2";
    	$u->email = "super2@test.com";
    	$u->password = Hash::make("123456");
    	$u->save();
    	$u->assignRole("superuser");
    }
}
