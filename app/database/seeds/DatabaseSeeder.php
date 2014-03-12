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
		$this->call('DiplomeTableSeeder');
		$this->call('FormationTableSeeder');
		$this->call('ThematiqueTableSeeder');
		$this->call('MatiereTableSeeder');
		//$this->call('SalleTableSeeder');
		$this->call('ClasseTableSeeder');
		/*$this->call('MaterielTableSeeder');
		$this->call('CoursTableSeeder');
		$this->call('NoteTableSeeder');
		$this->call('ReservationTableSeeder');
		$this->call('UtilisationTableSeeder');*/
	}

}

class RoleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->delete();
		Role::create(array(
			'id' => 5,
			'libelle' => 'Admin'
		));
		Role::create(array(
			'id' => 4,
			'libelle' => 'Secretaire'
		));
		Role::create(array(
			'id' => 3,
			'libelle' => 'Professeur'
		));
		Role::create(array(
			'id' => 2,
			'libelle' => 'Etudiant'
		));
		Role::create(array(
			'id' => 1,
			'libelle' => 'Candidat'
		));
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'prenom' => 'Foo',
			'nom' => 'Bar',
			'mail' => 'foo@bar.com',
			'password' => Hash::make('com'),
			'id_role' => 1,
			'telephone' => '0123456789'
		));
		User::create(array(
			'prenom' => 'Ad',
			'nom' => 'Min',
			'mail' => 'a@a.a',
			'password' => Hash::make('a'),
			'id_role' => 5,
			'telephone' => '0123456789'
		));
	}

}

class DiplomeTableSeeder extends Seeder {

	public function run()
	{
		DB::table('diplomes')->delete();
		Diplome::create(array(
			'libelle' => 'Licence math infos'
		));
		Diplome::create(array(
			'libelle' => 'Licence Biologie'
		));
	}

}

class FormationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('formations')->delete();
		Formation::create(array(
			'libelle' => 'A',
			'conditions' => 'aa',
			'id_user' => 1,
			'id_diplome' => 1
		));
		Formation::create(array(
			'libelle' => 'B',
			'conditions' => 'bb',
			'id_user' => 1,
			'id_diplome' => 2
		));
	}

}

class ClasseTableSeeder extends Seeder {

	public function run()
	{
		DB::table('classes')->delete();
		Classe::create(array(
			'libelle' => 'classe 1',
			'id_user' => 1,
			'annee' => '2013/2014',
			'id_formation' => 1
		));
		Classe::create(array(
			'libelle' => 'classe 2',
			'id_user' => 2,
			'annee' => '2013/2014',
			'id_formation' => 2
		));
		Classe::create(array(
			'libelle' => 'classe 3',
			'id_user' => 2,
			'annee' => '2013/2014',
			'id_formation' => 2
		));
	}

}

class ThematiqueTableSeeder extends Seeder {

	public function run()
	{
		DB::table('thematiques')->delete();
		Thematique::create(array(
			'libelle' => 'Culture générale'
		));		
		Thematique::create(array(
			'libelle' => 'Technologie appliqué'
		));
		Thematique::create(array(
			'libelle' => 'Science exacte'
		));
		Thematique::create(array(
			'libelle' => 'Science de la vie'
		));
	}

}

class MatiereTableSeeder extends Seeder {

	public function run()
	{
		DB::table('matieres')->delete();
		Matiere::create(array(
			'libelle' => 'Anglais',
			'id_thematique' => 1
		));
		Matiere::create(array(
			'libelle' => 'Vie en entreprise',
			'id_thematique' => 1
		));
		Matiere::create(array(
			'libelle' => 'Français',
			'id_thematique' => 1
		));
		Matiere::create(array(
			'libelle' => 'Informatique',
			'id_thematique' => 2
		));
		Matiere::create(array(
			'libelle' => 'Electronique',
			'id_thematique' => 2
		));
		Matiere::create(array(
			'libelle' => 'Mathématiques',
			'id_thematique' => 3
		));
		Matiere::create(array(
			'libelle' => 'Physique',
			'id_thematique' => 3
		));
		Matiere::create(array(
			'libelle' => 'Astronomie',
			'id_thematique' => 3
		));
		Matiere::create(array(
			'libelle' => 'Géologie',
			'id_thematique' => 3
		));
		Matiere::create(array(
			'libelle' => 'Biologie',
			'id_thematique' => 4
		));
		Matiere::create(array(
			'libelle' => 'Physiologie',
			'id_thematique' => 4
		));
		Matiere::create(array(
			'libelle' => 'Génétique',
			'id_thematique' => 4
		));
		Matiere::create(array(
			'libelle' => 'Bio-Informatique',
			'id_thematique' => 4
		));
		Matiere::create(array(
			'libelle' => 'Chimie',
			'id_thematique' => 4
		));
		Matiere::create(array(
			'libelle' => 'BioChimie',
			'id_thematique' => 2
		));

	}

}

class SalleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('salles')->delete();
		Salle::create(array(
			'libelle' => 'promotion 1'
		));
	}

}



class CoursTableSeeder extends Seeder {

	public function run()
	{
		DB::table('cours')->delete();
		Cours::create(array(
			'start' => '2014-03-16 10-00',
			'end' => '2014-03-16 12-00',
			'id_user' => 1,
			'id_salle' => 1,
			'id_matiere' => 1
		));
	}

}

class MaterielTableSeeder extends Seeder {

	public function run()
	{
		DB::table('materiels')->delete();
		Materiel::create(array(
			'description' => 'materiel 1'
		));
	}

}

class ReservationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('reservations')->delete();
		Reservation::create(array(
			'start' => '2014-03-16 10-00',
			'end' =>'2014-03-16 12-00',
			'id_user' => 1,
			'id_materiel' => 1
		));
	}

}

class UtilisationTableSeeder extends Seeder {

	public function run()
	{
		DB::table('utilisations')->delete();
		Utilisation::create(array(
			'id_salle' => 1,
			'id_matiere' => 1
		));
	}

}

class CompositionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('compositions')->delete();
		Composition::create(array(
			'coef' => 1 ,
			'id_matiere' => 1 ,
			'id_formation' => 1
		));
	}

}

class NoteTableSeeder extends Seeder {

	public function run()
	{
		DB::table('notes')->delete();
		Note::create(array(
			'valeur' => 12 ,
			'id_user' => 1 ,
			'id_formation' => 1,
			'id_matiere' => 1
		));
	}

}
