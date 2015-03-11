<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating

		$now = date('Y-m-d H:i:s');

		$pass= Hash::make("123456789");

		$usuario1 = array(
			'email'=> "frank.ingsistema@gmail.com",
			'password'=>$pass,
			'created_at' => $now,
			'updated_at' => $now,);
		
		
		// Uncomment the below to run the seeder
		
	 DB::table('users')->insert($usuario1);


	}

}
