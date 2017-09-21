<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $now = date('Y-m-d H:i:s');

        DB::table('users')->insert(array(
			array(
				'name'		=>	'Admin',
				'username'	=>	'admin',
				'email'		=>	'admin@taskmanager.com',
				'role_id' 	=>	'1',
				'password'	=>	Hash::make('admin'),
                'is_active' =>  1,
				'created_at'=>	$now,
				'updated_at'=>	$now
			)
		));
    }
}
