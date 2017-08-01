<?php

namespace App\Http\Controllers;
use App\artikel;
use Auth;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Request;
use DB;
use App\Quotation;
use Intervention\Image\Facades\Image as Image;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CityTourController extends Controller
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
	 //$article = \App\artikel::where('content', 'LIKE', '%'.$input.'%')
	$article = DB::table('article')
	 ->join('category', 'article.id_category', '=', 'category.id')
	 ->select('category.category','article.id','article.title', 'article.content', 'article.created_at', 'article.n_status')
	 ->paginate(5);
	
	 return view('admin.listcity_tour', compact('article'));		 
	 }
	 
	  public function listartikel()
	 {
	 
	 $article = DB::table('article')
	 ->join('category', 'article.id_category', '=', 'category.id')
	 ->select('category.category','article.id','article.title', 'article.content', 'article.created_at', 'article.n_status')
	 ->where('category.id', '3')
	 ->orderBy('article.id', 'desc')
	 ->paginate(5);
	
	 $slide = DB::table('slide')
	 ->join('article', 'article.id', '=', 'slide.id_article')
	 ->select('slide.id','slide.id_article','slide.slide','slide.video','slide.type','article.title', 'slide.created_at','slide.n_status')
	 ->where('slide.id_category', '3')
	 ->orderBy('slide.type', 'desc')
	 ->orderBy('slide.id', 'asc')
	 ->paginate(10);
	 
	 $pages="city-tour";
	
	 return view('admin.listcity_tour', compact('article','slide','pages'));		 
	 }
	 
	 
	 public function add()
	 {
	 if(empty(Auth::user()->name)){
		return Redirect::to('login');
	 }
	 $pages="city-tour";
	  return view('admin.addcity_tour', compact('pages'));
	 }
	 
	 public function store()
	 {
	  $input = Request::all();
	  //echo var_dump($input);die;
	  # create validation
	  $aturan = array(
			'title' => 'required|min:3', 
			'content' => 'required'
			
		);
		# Buat pesan error validasi manual
		$pesan = array(
			'title.required' => 'Inputan Nama wajib diisi.',
			'title.min' => 'Inputan Nama minimal 3 karakter.',
			'content.required' => 'Inputan description wajib diisi.'					
		);
	  
	  # validasi
	  $validasi = Validator::make($input, $aturan, $pesan);
	  if($validasi->fails()) {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		# Bila validasi sukses
		}
	 /*	
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
		  $destinationPath = 'upload/banner'; // upload path : /public/upload/banner
		  $extension = Input::file('image')->guessExtension(); // getting image extension
		  $fileName = rand(11111,99999).'.'.$extension; // rename image		  
		  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path 
		  $path = Input::file('image')->getRealPath();
		 
		 //Resize image @upload/slide/ to height 980, width654			  
		  $image2 = Image::make(sprintf('upload/banner/%s', $fileName))->resize(535, 458)->save();
		 
		  
		  // sending back with message
		  Session::flash('success', 'Upload successfully'); 
		  $input['banner']=$fileName;
		}
		else {
		  // sending back with error message.
		  echo "failed";die;
		  Session::flash('error', 'uploaded file is not valid');
		  return Redirect::to('cms/city_tour');
		}
	  }
	  */
	  $input['event_date']=date('Y-m-d',strtotime($input['event_date']));	  
	  artikel::create($input);
	  //return redirect ('admin');
	  return Redirect::to('cms/city-tour')->withPesan('Artikel baru berhasil ditambahkan.');
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function show($id)
	 {
		$admin = artikel::findOrFail($id);    
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
		$pages="city-tour";
		$article = artikel::findOrFail($id); 
		return view('admin.editcity_tour', compact('article','pages'));  
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function update(Request $request, $id)
	 {
	  
	  $admin = artikel::findOrFail($id);
	  
	  $input = Request::all();
	  /*
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
			  $destinationPath = 'upload/banner'; // upload path : /public/upload/banner
			  $extension = Input::file('image')->guessExtension(); // getting image extension
			  $fileName = rand(11111,99999).'.'.$extension; // rename image		  
			  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path 
			  $path = Input::file('image')->getRealPath();
			
			//Resize image @upload/slide/ to height 980, width654			  
			  $image2 = Image::make(sprintf('upload/banner/%s', $fileName))->resize(535, 458)->save();
			
			  // sending back with message
			  Session::flash('success', 'Upload successfully'); 
			  $input['banner']=$fileName;
			}
			else {
			  // sending back with error message.
			  echo "failed";die;
			  Session::flash('error', 'uploaded file is not valid');
			  return Redirect::to('cms/listcity_tour');
			}
		  }
		}
		*/
		$input['event_date']=date('Y-m-d',strtotime($input['event_date']));
		
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
		 $disable = DB::table('article')		
		->where('id_category', 3)
		->update(['n_status' => 0]);  
		$admin = artikel::findOrFail($id);    
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
		$article = artikel::findOrFail($id);  
		$article->delete();
		//$pages="detail";
		return redirect('cms/detail-article');  
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function showtitle()
	 {
		//$article = artikel::all();
		$article_content = DB::table('article')->where('n_status', '1')
							->orderBy('id', 'desc')->get();		

		foreach ($article_content as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['content'] = substr($val->content, 0, 250);
		$result[$key]['banner'] = stripslashes($val->banner);
		$result[$key]['updated_at'] = date("l, F d, Y",strtotime($val->updated_at));		
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result;				
		$article=$result;
		$pages='';
		$pesan='continue';
		return view('page', compact('article_content','article','pesan','pages'));
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function showcontent($id)
	 {
		//$article = artikel::all(); 
		$article_content = DB::table('article')->where('n_status', '1')
		->where('id', $id)->get();

		foreach ($article_content as $key => $val){
		$result1[$key]['id'] = stripslashes($val->id);
		$result1[$key]['title'] = stripslashes($val->title);
		$result1[$key]['content'] = stripslashes($val->content);
		$result1[$key]['banner'] = stripslashes($val->banner);
		$result1[$key]['updated_at'] = date("l, F d, Y",strtotime($val->updated_at));
		$result1[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result1;
		
		
		$article = DB::table('article')->where('n_status', '1')
		->orderBy('id', 'desc')->get();

		foreach ($article as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article=$result;
		$pages=$result1[0]['id'];		
		$pesan=' ';
		return view('page', compact('article_content','article','pesan','pages'));
	 }
}
