<?php

class UserController extends BaseController {

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

	public function update()
	{
		$user=Auth::user();
		$photo=$user->photo()->get();

		return View::make('user.update',
					array('name'=>$user->name,
						  'last_name'=>$user->last_name,
						  'phone'=>$user->phone,
						  'date_birth'=>$user->date_birth,
						  'pictures'=>$photo,
						));
	}

	public function updatePost(){

		$user=Auth::user();

		$rules=array('name'=>'',
					 'last_name'=>'',
					 'phone'=>'numeric',
					 'date_birth'=>'date',
					 'photo[]'=>'mimes:jpeg,bmp,png',
					 );

			$validator= Validator::make(Input::all(),$rules);
			if(! $validator->fails()){
				try{
					if(Input::file('photo')[0]!=null){
						foreach (Input::file('photo') as $value) {
							if( $value->getClientOriginalExtension() !== 'jpg' && $value->getClientOriginalExtension() !== 'bmp' && $value->getClientOriginalExtension() !== 'png'){
								return Redirect::to('/update')->with('messageEdit','The photo must be a file of type: jpeg, bmp, png.');
							}
						}
					}

					if(Input::file('photo')[0]!=null){
						foreach (Input::file('photo') as $value) {
							$photo = new Photo();
							$photo->user_id=$user->id;
							if($value!= "")
							{
								$photo->deletePhoto();
								$photo->subirFoto($value);
							}
							$photo->save();
						}	
					}				


					$user->name=Input::get('name');
					$user->last_name=Input::get('last_name');
					$user->phone=Input::get('phone');
					$user->date_birth=Input::get('date_birth');
					$user->save();

					$eml= $user->email;

					$data = array(
						'img' => 'images/LOGO.png',
					);
					Mail::send('emails.contra', $data, function($message)
					{
					    $message->to(Auth::user()->email, 'Sr')->subject('Buenas, Su Informacion fue actualizada.');
					});


					return Redirect::to('/update')->with('messagePersonal','Se modificaron los datos correctamente');
				}catch(Exception $e)
					{
						return Redirect::to('/update')->with('messageEdit','Se produjo un error')->withInput();

					}
			}else{

				return Redirect::to('/update')->withErrors($validator)->withInput();
			}


		
	}



	public function deleteImg()
	{
		$user=Auth::user();
		$photo=$user->photo()->get();

		return View::make('user.img',
					array(
						  'pictures'=>$photo,
						));
	}

	public function deleteImgPost()
	{
		$user=Auth::user();
		$photo=$user->photo()->get();
		
		$rules=array(
					 'photo'=>'required',
					 );
		$validator= Validator::make(Input::all(),$rules);
			if(! $validator->fails()){
				try{
					foreach (Input::get('photo') as $value) {
								$photo = Photo::find($value);
								if($photo!= "")
								{
									$photo->deletePhoto();
									$photo->delete();
								}
					}
					return Redirect::to('/deleteImage');
				}catch(Exception $e)
					{
						return Redirect::to('/update')->with('messageEdit','Se produjo un error')->withInput();

					}
			}else{
				return Redirect::to('/deleteImage')->withErrors($validator)->withInput();
			}

	}

}
