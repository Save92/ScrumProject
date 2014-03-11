<?php

// $ php artisan db:seed

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('RoomTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'first_name' => 'foo',
			'last_name' => 'bar',
			'email' => 'foo@bar.com',
			'password' => Hash::make('com')
		));
		User::create(array(
			'first_name' => 'faa',
			'last_name' => 'bor',
			'email' => 'faa@bor.com',
			'password' => Hash::make('moc')
		));
		User::create(array(
			'first_name' => 'Ad',
			'last_name' => 'Min',
			'email' => 'admin',
			'password' => Hash::make('admin')
		));
	}

}

class RoomTableSeeder extends Seeder {

	public function run()
	{
		DB::table('rooms')->delete();
		Room::create(array(
			'name' => 'Salle infos',
			'seats' => 20
		));
		Room::create(array(
			'name' => 'Salle labo bio',
			'seats' => 20
		));
		Room::create(array(
			'name' => 'Atelier',
			'seats' => 20
		));
		Room::create(array(
			'name' => 'Salle classique',
			'seats' => 20
		));
		Room::create(array(
			'name' => 'Cantine',
			'seats' => 60
		));
	}

}