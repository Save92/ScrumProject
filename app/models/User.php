<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = array('prenom', 'nom', 'mail', 'telephone');

	protected $guarded = array('id', 'id_role');

	/**
	 * Retourne le nom de l'utilisateur
	 *
	 */
	public function getName()
	{
		$name = $this->prenom . ' ' . $this->nom;

		return '<a href="' . URL::to('users') . '/' . $this->id . '">' . $name . '</a>';
	}

	/**
	 * Retourn le nom du rôle de l'utilisateur
	 *
	 */
	public function getRole()
	{
		$role = Role::find($this->id_role)->libelle;

		return $role;
	}

	public function getMail()
	{
		return $this->mail;
	}

	public function getPhone()
	{
		return $this->telephone;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Retourne les utilisateurs par roles
	 *
	 * @return array
	 */
	public function getByRole($id_role)
	{
		$users = User::where('id_role', '=', $id_role)->get();
		return $users;
	}

}