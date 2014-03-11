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

		$this->call('RoleTableSeeder');
		$this->call('UserTableSeeder');

		//$this->call('FormationTableSeeder');
		//$this->call('PromotionTableSeeder');
	}

}

class RoleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->delete();
		Role::create(array(
			'id' => 1,
			'libelle' => 'Admin'
		));
		Role::create(array(
			'id' => 2,
			'libelle' => 'Secretaire'
		));
		Role::create(array(
			'id' => 3,
			'libelle' => 'Professeur'
		));
		Role::create(array(
			'id' => 4,
			'libelle' => 'Etudiant'
		));
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'prenom' => 'foo',
			'nom' => 'bar',
			'mail' => 'foo@bar.com',
			'password' => Hash::make('com'),
			'id_role' => 1,
			'telephone' => '0123456789'
		));
		User::create(array(
			'prenom' => 'faa',
			'nom' => 'bor',
			'mail' => 'faa@bor.com',
			'password' => Hash::make('moc'),
			'id_role' => 1,
			'telephone' => '0123456789'
		));
		User::create(array(
			'prenom' => 'Ad',
			'nom' => 'Min',
			'mail' => 'a@a.a',
			'password' => Hash::make('a'),
			'id_role' => 1,
			'telephone' => '0123456789'
		));
	}

}

class FormationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('formations')->delete();
		Formation::create(array(
			'libelle' => 'A',
			'annee' => 2012,
			'conditions' => 'aa',
			'id_user' => 1
		));
	}

}

class PromotionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('promotions')->delete();
		Promotion::create(array(
			'libelle' => 'promo 1',
			'id_diplome' => 1
		));
	}

}