<?php

class PeopleTableSeeder extends Seeder{

	public function run(){
		
		People::create(array(
			'name' => "Lester",
			'age' => "19",
			'address' => "7 Digos"
			));

	}

}

?>