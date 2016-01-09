<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Group;

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
        		"name" => "administrator",
        		"email" => "rune@hemma.ws",
        		"password" => Hash::make("Krongatan4"),
        		"group_id" => "1"
        	]);

        Group::create([
                "name" => "Administrators",
                "permissions" => '{"administrator":true}'
            ]);
        Group::create([
                "name" => "Users",
                "permissions" => '{"administrator":false}'
            ]);
    }
}
