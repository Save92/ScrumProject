<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	* Crée un message d'erreur pour sur la prochaine vue si besoin
	*
	* @return void
	*/
	protected function sendErrors($validator)
	{
		$errors = $validator->errors()->all();
		$message = '';
		foreach ($errors as $k => $e) {
			if($k > 0) $message.='<br/>';
			$message.= $e;
		}
		Session::flash('message', $message);
		Session::flash('alert', 'danger');
	}

	/**
	* Permissions insuffisantes
	*
	* @return void
	*/
	protected function deny() {
		Session::flash('message', 'Permissions insuffisantes');
		Session::flash('alert', 'warning');
		return Redirect::to('/');
	}

}