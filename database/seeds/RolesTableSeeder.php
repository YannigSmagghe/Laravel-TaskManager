<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->delete();

        DB::table('roles')->insert(array(
			array('name'=>'Admin'),						
            array('name'=>'User'),
            array('name'=>'Moderator')
		));
    }
}
