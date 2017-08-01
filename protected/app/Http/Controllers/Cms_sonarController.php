<?php

namespace App\Http\Controllers;
use Request;
use DB;
use App\Quotation;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Cms_sonarController extends Controller
{
     public function __construct(Request $request){
        $this->request = $request;
     }
	
	 public function index()
	 {
	 return view('admin.login');		 
	 }
	 
	  public function listartikel()
	 {
	 $input = Request::get('cari');
	 //$article = \App\artikel::where('content', 'LIKE', '%'.$input.'%')
	$article = DB::table('article_sonar')
	 ->join('category', 'article_sonar.id_category', '=', 'category.id')
	 ->select('category.category','article_sonar.id','article_sonar.title', 'article_sonar.content', 'article_sonar.created_at', 'article_sonar.n_status')
	 ->paginate(5);
	
	 return view('admin.listartikel', compact('article'));		 
	 }
	 
	 /*
	 public function create()
	 {
	  return view('admin.create');
	 }
	 public function store()
	 {
	  $input = Request::all();
	  //echo var_dump($input);die;
	  # create validation
	  $aturan = array(
			'nama' => 'required|min:3', 
			'alamat' => 'required', 
			'pesan' => 'required'
		);
		# Buat pesan error validasi manual
		$pesan = array(
			'nama.required' => 'Inputan Nama wajib diisi.',
			'nama.min' => 'Inputan Nama minimal 3 karakter.',
			'alamat.required' => 'Inputan alamat wajib diisi.',
			'pesan.required' => 'Inputan Pesan wajib diisi.'			
		);
	  
	  # validasi
	  $validasi = Validator::make($input, $aturan, $pesan);
	  if($validasi->fails()) {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		# Bila validasi sukses
		} 
		
	  Bukutamu::create($input);
	  //return redirect ('admin');
	  return Redirect::route('buku')->withPesan('Biodata baru berhasil ditambahkan.');
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	  
	 public function show($id)
	 {
		$admin = Bukutamu::findOrFail($id);    
		return view('admin.show', compact('admin'));
	 }
	 
	 /**
	  * Show the form for editing the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	  
	 public function edit($id)
	 {
		$admin = artikel::findOrFail($id);    
		return view('admin.edit', compact('admin'));  
	 }
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Response
	  
	 public function update(Request $request, $id)
	 {
		$admin = artikel::findOrFail($id);    
		$admin->update($request::all());  		
		return redirect('admin');    
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
		return redirect('admin');  
	 }
}
