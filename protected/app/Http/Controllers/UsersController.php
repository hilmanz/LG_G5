<?php

namespace App\Http\Controllers;

use App\Users;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Hash;
use Request;
use Session;
use Validator;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
		
	 public function __construct(Request $request){
        $this->request = $request;
		if (!Auth::check()) {
			// The user is logged in...
			 return Redirect::to('cms/login');
		}
     }
	 /*
    public function index()
	 {  
	 return View('auth.register');
	 }
	 public function store()
	 {
		$user = new users();
		
		$user->name     		= Input::get('name');
		$user->remember_token  	= Input::get('password');
		$user->password  		= Hash::make(Input::get('password'));

		$user->save();
		return Redirect::to('auth')->with('pesan', 'Registrasi berhasil!');
	 }
	 */
	public function login(){		 
		 return View('admin.login');
	}

	public function authenticate(){
	
	 $input = Request::all();
	
	
	
	  # create validation
	  $aturan = array(
			'name'    => 'required',
			//'email'    => 'required|email', // make sure the email is an actual email
			//'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
			'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
		);
		# Buat pesan error validasi manual
		$pesan = array(
			'name.required' => 'Inputan username wajib diisi.',				
			'password.required' => 'Inputan alamat wajib diisi.',
			'password.min' => 'Inputan Nama minimal 3 karakter.',		
		);
			// run the validation rules on the inputs from the form
		$validasi = Validator::make($input, $aturan, $pesan);
		if($validasi->fails()) {
			# Kembali kehalaman login dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		} 
		
		if (Auth::attempt(array('name' => Input::get('name'), 'password' => Input::get('password'))))
		{
			# jika ada leveling user
			$user = new users();
			$text = \DB::table('users')->where('name', '=', Input::get('name'))->get();
			foreach ($text as $data) {
				//echo $data->email;
				//echo $data->password;
			}
			Session::put('name', Input::get('name'));
			
		   return Redirect::to('cms/user');
		}
		else{
		  return Redirect::to('cms/login')->with('pesan_error', 'Login gagal, email atau password salah!');
		}
	}
	
	public function logout(){
	   Auth::logout();
	   return Redirect::to('cms/login')->with('pesan', 'berhasil logout');
	}
	 
	public function listuser(){		
		$usersnya = \DB::table('users')->orderBy('id', 'desc')->paginate(5);	
		return view('admin.listuser', compact('usersnya'));		 
	}
	
	
	 public function add()
	 {
	 if(empty(Auth::user()->name)){
		return Redirect::to('login');
	 }
	  return view('admin.adduser');
	 }
	 
	 public function store()
	 {
	  $input = Request::all();
	  $user = new users();
		
		$user->name     		= Input::get('name');
		$user->email     		= Input::get('email');
		$user->remember_token  	= Input::get('password');
		$user->password  		= Hash::make(Input::get('password'));

		$user->save();	  
	  return Redirect::to('cms/user')->withPesan('User baru berhasil ditambahkan.');
	 }
	
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function show($id)
	 {
		$admin = users::findOrFail($id);    
		return view('admin.showuser', compact('admin'));
	 }
	 
	 /**
	  * Show the form for editing the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function edit($id)
	 {
		$usernya = users::findOrFail($id); 
		return view('admin.edituser', compact('usernya'));  
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function update(Request $request, $id)
	 {	  
		$admin = users::findOrFail($id);	  
		$input = Request::all();
		
		$admin->name     		= Input::get('name');
		$admin->email     		= Input::get('email');
		$admin->remember_token  = Input::get('password');
		$admin->password  		= Hash::make(Input::get('password'));
	
		$admin->update();  		
		return redirect('cms/user');    
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function checkit(Request $request, $id)
	 {
		$admin = user::findOrFail($id);    
		$admin->update($request::all());  		
		print json_encode(array('status'=>true));    
	 }
	 
	 /**
	  * Remove the specified resource from storage.
	  *
	  * @param  int  $id
	  * @return Response
	  */
	 public function destroy($id)
	 {
		$user = users::findOrFail($id);  
		$user->delete();  
		return redirect('cms/user');  
	 }

	
}
