<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        		"name" => "Rikard Olsson",
        		"email" => "rikard@datia.nu",
        		"password" => Hash::make("4Punkter"),
        		"group_id" => "{administrator: 1}"
        	]);
    }
}
