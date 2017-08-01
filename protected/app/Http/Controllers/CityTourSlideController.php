<?php

namespace App\Http\Controllers;
use App\slide;
use Auth;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Request;
use DB;
use App\Quotation;
use Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CityTourSlideController extends Controller
{
    public function __construct(Request $request){
        $this->request = $request;
		if (empty(Auth::check())) {
			// The user is logged in...
			 return Redirect::to('cms/login');
		}		
     }
	 
	
	 public function index()
	 {	
	  $input = Request::get('cari');
	 $slide = DB::table('slide')
	 ->orderBy('slide.id', 'desc')
	 ->paginate(10);		 
	 }
	 
	 public function listslide()
	 {
	 $input = Request::get('cari');
	 $slide = DB::table('slide')
	 ->orderBy('slide.id', 'desc')
	 ->paginate(10);
	$pages="city-tour";
	 return view('admin.listarticle', compact('slide','pages'));		 
	 }
	 
	 
	 public function addimage()
	 {
	 if(empty(Auth::user()->name)){
		return Redirect::to('login');
	 }
	 $article = DB::table('article')->where('id_category','=','3')->get();
	  $pages="city-tour";
	  $select="image";
	  return view('admin.addslidecity_tour', compact('article','pages','select'));
	 }
	 
	 public function addvideo()
	 {
	 if(empty(Auth::user()->name)){
		return Redirect::to('login');
	 }
	 $article = DB::table('article')->where('id_category','=','3')->get();
	  $pages="city-tour";
	  $select="video";
	  return view('admin.addslidecity_tour', compact('article','pages','select'));
	 }
	 
	 public function store()
	 {
	  $input = Request::all();
     
	  
		 #Upload image
		  // getting all of the post data
		  $file = array('image' => Input::file('image'));
		  // setting up rules
		  $rules = array('image' => 'required','image' => 'image|max:1024|mimes:jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($file, $rules);
		  if ($validator->fails()) {
			  echo "failed";die;
			// send back to the page with the input data and errors
			return Redirect::to('upload')->withInput()->withErrors($validator);
		  }
		  else {
			// checking file is valid.
			if (Input::file('image')->isValid()) {	
			  $name = Input::file('image')->getClientOriginalName();		  
			  $destinationPath = 'upload/slide'; // upload path : /public/upload/slide
			  $extension = Input::file('image')->guessExtension(); // getting image extension
			  $fileName = rand(11111,99999).'.'.$extension; // rename image		  
			  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path 
			  $path = Input::file('image')->getRealPath();
			  //Resize image @upload/slide/ to height 980, width654			  
			  $image2 = Image::make(sprintf('upload/slide/%s', $fileName))->resize(980, 654)->save();
			 
			  // sending back with message
			  Session::flash('success', 'Upload successfully'); 
			  //return Redirect::to('cms/slide');
			}
			else {
			  // sending back with error message.
			  echo "failed";die;
			  Session::flash('error', 'uploaded file is not valid');
			  return Redirect::to('cms/city-tour-article');
			}
		  }
		  
		   $input['slide']=$fileName;
		   
	  if ($input['type']=='video'){
		  $url=$input['video'];
		  preg_match(
			'/[\\?\\&]v=([^\\?\\&]+)/',
			$url,
			$matches
			);
		$input['video'] = $matches[1];		
	  }
	 
	  slide::create($input);
	  //return redirect ('admin');
	  return Redirect::to('cms/city-tour')->withPesan('slide baru berhasil ditambahkan.');
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function show($id)
	 {
		$admin = slide::findOrFail($id);    
		return view('admin.show', compact('admin'));
	 }
	 
	 /**
	  * Show the form for editing the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function edit($id)
	 {
		$slide = slide::findOrFail($id);
				
		$article = DB::table('article')->where('id_category','=','3')->get();
				
		$pages="city-tour";	
		return view('admin.editslidecity_tour', compact('article','slide','pages'));  			
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function update(Request $request, $id)
	 {
	  
	  $admin = slide::findOrFail($id);
	  
	  $input = Request::all();
	  
	  if($_FILES['image']['name']!=''){
		 #Upload image
		  // getting all of the post data
		  $file = array('image' => Input::file('image'));
		  // setting up rules
		  $rules = array('image' => 'required','image' => 'image|max:1024|mimes:jpeg,bmp,png',); //mimes:jpeg,bmp,png and for max size max:10000
		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($file, $rules);
		  if ($validator->fails()) {
			  echo "failed";die;
			// send back to the page with the input data and errors
			return Redirect::to('upload')->withInput()->withErrors($validator);
		  }
		  else {
			// checking file is valid.
			if (Input::file('image')->isValid()) {	
			  $name = Input::file('image')->getClientOriginalName();		  
			  $destinationPath = 'upload/slide'; // upload path : /public/upload/slide
			  $extension = Input::file('image')->guessExtension(); // getting image extension
			  $fileName = rand(11111,99999).'.'.$extension; // rename image		  
			  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path 
			  $path = Input::file('image')->getRealPath();
			  //Resize image @upload/slide/ to height 980, width654			  
			  $image2 = Image::make(sprintf('upload/slide/%s', $fileName))->resize(980, 654)->save();
			  // sending back with message
			  Session::flash('success', 'Upload successfully'); 
			  $input['slide']=$fileName;
			}
			else {
			  // sending back with error message.
			  echo "failed";die;
			  Session::flash('error', 'uploaded file is not valid');
			  return Redirect::to('cms/city-tour-article');
			}
		  }
		}
	  if ($input['type']=='video'){
		  $url=$input['video'];
		  preg_match(
			'/[\\?\\&]v=([^\\?\\&]+)/',
			$url,
			$matches
			);
		$input['video'] = $matches[1];		
	  }
		//echo $input['video'];die;
		$admin->update($input);  		
		return redirect('cms/city-tour');    
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function checkit(Request $request, $id)
	 {
		$admin = slide::findOrFail($id);    
		$admin->update($request::all());  		
		print json_encode(array('status'=>true));    
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function incheckitall(Request $request, $id)
	 {
		$input= $request::all();
		$disable = DB::table('slide')
		->where('type', 'video')
		->where('id_category', '3')
		->update(['n_status' => 0]);  		
		
		$admin = slide::findOrFail($id);    
		$admin->update($input);
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
		$slide = slide::findOrFail($id);  
		$slide->delete();		
		
		return redirect('cms/city-tour-slide');  
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function showtitle()
	 {
		//$slide = slide::all();
		$article_content = DB::table('slide')->where('n_status', '1')
							->orderBy('id', 'desc')->get();		

		foreach ($article_content as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['content'] = substr($val->content, 0, 250);
		$result[$key]['slide'] = stripslashes($val->slide);
		$result[$key]['updated_at'] = date("l, F d, Y",strtotime($val->updated_at));		
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result;				
		$slide=$result;
		$pages='';
		$pesan='continue';
		return view('page', compact('article_content','slide','pesan','pages'));
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function showcontent($id)
	 {
		//$slide = slide::all(); 
		$article_content = DB::table('slide')->where('n_status', '1')
		->where('id', $id)->get();

		foreach ($article_content as $key => $val){
		$result1[$key]['id'] = stripslashes($val->id);
		$result1[$key]['title'] = stripslashes($val->title);
		$result1[$key]['content'] = stripslashes($val->content);
		$result1[$key]['slide'] = stripslashes($val->slide);
		$result1[$key]['updated_at'] = date("l, F d, Y",strtotime($val->updated_at));
		$result1[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result1;
		
		
		$slide = DB::table('slide')->where('n_status', '1')
		->orderBy('id', 'desc')->get();

		foreach ($slide as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$slide=$result;
		$pages=$result1[0]['id'];		
		$pesan=' ';
		return view('page', compact('article_content','slide','pesan','pages'));
	 }
}
