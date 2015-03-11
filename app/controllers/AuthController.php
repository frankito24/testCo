<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


		public function login()
	{

		return View::make('auth.login');

	}


	public function logout(){

		Auth::logout();
		return Redirect::to('/');

	}
	public function authenticate(){

		//create validation rules
		$rules=array('email'=>'required|email','password'=>'required|min:8');
			$validator= Validator::make(Input::all(),$rules);
			if(! $validator->fails()){
				$usi=User::where('email', '=',Input::get('email'))->get()->first();
				if($usi==!null){
					if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password'))))
						{
							return Redirect::intended('/');
						}
					else
						{
						//Redirect to login form with error message
						return Redirect::to('/login')->with('message','Olvido su clave?')->withInput();
						}
				}
				else 
				{
					return Redirect::to('/login')->with('message','Correo no Existe')->withInput();
				}
			}
			else
				{
					//Redirect to login form with error message
					return Redirect::to('/login')->with('message','Llene los campos Por favor')->withInput()->withErrors($validator);

				}
	}



	public function register(){
		return View::make('auth.register');

	}

	public function registerPost(){

		$rules=array(
			'email' => 'required|email|unique:users,email',
			'password' =>'confirmed|min:8',
			'password_confirmation'=>'same:password'
		);	
		$validator=Validator::make(Input::all(),$rules);

		if(!$validator->fails())
		{
			$user = new User();
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			try {
				$user->save();
				Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password')));
				return Redirect::intended('/');
			} catch (Exception $e) {
				return Redirect::to('/register')->with('messageErrorRegis','Se produjo un error')->withInput();	
			}
		}else{
			return Redirect::to('/register')->withErrors($validator)->withInput();
		}
		

	}

	public function consultora()
	{
		$usuario=Auth::user();
		$nombre=$usuario->email;
		return $nombre	;
	}


}
