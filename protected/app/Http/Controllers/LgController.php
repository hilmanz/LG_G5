<?php

namespace App\Http\Controllers;
use App\contact;
use Auth;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Request;
use DB;
use App\Quotation;
//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LgController extends Controller
{	
	 public function __construct(Request $request){
        $this->request = $request;
     }
	 
     public function index()
	 {
		$pages='index';		 
		return view('LG.index', compact('pages')); 
	 }
	 
     public function games1()
	 {  	
		 $pages='games';
		 return view('LG.games1', compact('pages')); 
	 }
	 
	 public function games2()
	 {  	
		 $pages='games';
		 return view('LG.games2', compact('pages')); 
	 }
	 
	 public function games3()
	 {  	
		 $pages='games';
		 return view('LG.games3', compact('pages')); 
	 }
	 
	 public function games4()
	 {  	
		 $pages='games';
		 return view('LG.games4', compact('pages')); 
	 }
	 
	 
     public function kuesioner1()
	 {
		 $pages='kuesioner';
		 return view('LG.kuesioner1', compact('pages')); 
	 }
	 
	  public function notif()
	 {
		 $pages='notifikasi';
		 return view('LG.notif', compact('pages')); 
	 }
	 
	 public function form()
	 {
		 $pages='form';
		 return view('LG.form', compact('pages')); 
	 }
	 
	 public function store()
	 {
		 $pages='store';
		 return view('LG.store', compact('pages')); 
	 }

	 function register() {	
		$input = Request::all();
		contact::create($input);
		print json_encode(array('status'=>true));   
	 }
	 
	function checkEmail()
	{			
	$input = Request::all();
	$result['email']="";
	$result2['telp']="";
	$members = DB::table('registration')
		->where('email', '=', $input['email'])
		->get();
	foreach ($members as $key => $val){
		$result['email'] = stripslashes($val->email);
	}
	
		
		
	$members2 = DB::table('registration')
		->where('telp', '=', $input['telp'])
		->get();
	foreach ($members2 as $key => $val2){
		$result2['telp'] = stripslashes($val2->telp);
	}
	
		if(($result['email']) || ($result2['telp'])){		
			print_r(json_encode(array('status'=>1,'email'=>$result['email'],'telp'=>$result2['telp'])));	die;
		}else{					
			print_r(json_encode(array('status'=>0)));die;	
		}
	
	}
	
	function checkTelp()
	{			
	$input = Request::all();
	$result['telp']="";
	$members = DB::table('registration')
		->where('telp', '=', $input['telp'])
		->get();
	foreach ($members as $key => $val){
		$result['telp'] = stripslashes($val->telp);
	}
	
		if($result['telp']){		
			print_r(json_encode(array('status'=>1,'telp'=>$result['telp'])));	die;
		}else{					
			print_r(json_encode(array('status'=>0)));die;	
		}
	
	}
	 
	  function kuesioner() {	
		$input = Request::all();		
		kuesioner::create($input);
		print json_encode(array('status'=>true));   
	 }
	 
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function updatecontact()
	 {		
		$input = Request::all();
		$k=substr(md5($input['email']),1, 5);
		$rand=rand(1111,9999);
		$kode=$rand.$k;
		$input['kode']=$kode;
		contact::create($input);		
		
	    $dataArray = array(
				'nama'=>$input['nama'],
				'email'=>$input['email'],
				'kode_unik'=>$kode,
			);
		$this->send_addmember($dataArray);
		print json_encode(array('status'=>true,'nama'=>$input['nama'],'email'=>$input['email'],'kode'=>$input['kode']));
	 }
	 
	 function get_members($last_id, $num){
		$members = DB::table('contact')
		->where('id', '>', $last_id)
		->take($num)->get();
		return $members;
	}
	
	function send_email(){		
		$last_id = 0;
		$num = 2;
		$members = $this->get_members($last_id, $num);
		while ($members != null && !empty($members)) {
			foreach($members as $one_member) {			
				$last_id = $one_member->id;
				$username = trim($one_member->nama);
				$email = trim($one_member->email);
				echo "Sending to #{$last_id}: {$email}\n";
				$dataArray = array(
					'email' => $email,
					'namemember' => $username
				);
				$results = $this->send_addmember($dataArray);
				print_r($results); echo "\n\n";
				//$this->insert_emailblast($last_id, $email, $results['status']);
			}
			unset($members);
			$members = '';
		}
		unset($members);
	}
	
			
	function test_template_email(){
		$template='
				   <html lang="en">
					<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

						<title>Manual X BMW</title>
						<!-- EB Garamond GOOGLE -->
						<link href="http://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet" type="text/css" />
				
					</head>

					<body id="body">

						<div id="mainmenu" class="navbar  main-menu-thankyou" >
							<div class="container" style="background:#393939; color:#fff; width:100%; margin:0 auto;">
								<!-- LOGO CONTAINER -->
								
							</div>
						</div>

					<!-- =========================
						 THANKS
					============================== -->
						<table border="0" cellpadding="30" cellspacing="0" width="100%" id="thankyou" style="background:#e8e8e8;width:100%; margin:0 auto;">
						  <tr>
							<td  align="center">
							
							<p style = "letter-spacing: 2px; color: 221f1f;font-family: EB Garamond;font-weight: 300;font-size: 35px; ">
								EXPERIENCE<br>THE ALL-NEW<br>BMW X1 
							</p>				
							
							</td>
						  </tr>
						  
						  <tr>
							<td>
							  <p style = "padding: 5px 20px 5px 5px; line-height: 1.5em; letter-spacing: 2px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Dear !#NAME,</p>
							  <p style = "padding: 7px 20px 5px 5px; line-height: 1.5em; letter-spacing: 1px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Thank you for your interest in experiencing the all-new BMW X1.</p>
							  <p style = "padding: 5px 20px 5px 5px; line-height: 1.5em; letter-spacing: 2px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Kode !#KODE_UNIK,</p>
							  <p style = "padding: 5px 5px 20px 5px; line-height: 1.5em; letter-spacing: 1px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">BMW is proud to be working together with the people of Manual Jakarta in breaking through limitations and exploring the unfamiliar with an adventurous mindset.</p>
							  <p style = "padding: 5px 5px 20px 5px; line-height: 1.5em; letter-spacing: 1px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Our team will contact you shortly to schedule the time and place of your driving experience. We hope that you will enjoy your experience in driving the all-new BMW X1.</p>
							  <p style = "padding: 5px 20px 5px 5px; line-height: 1.5em; letter-spacing: 1px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Regards,<br>BMW</p>
							</td>
						  </tr>

						</table>

						<table border="0" cellpadding="0" cellspacing="0" width="100%" id="footer" style="background:#393939; width:100%; margin:0 auto;">
						  <tr>
							<td width="20%" align="left">
								
								<table border="0" cellpadding="0" cellspacing="0">
								  <tr>
									
									<td class="weblink">
									  <a href="#" style="color: white;">www.mybmw.co.id</a><br>
									  <a href="#" style="color: white;">www.manual.co.id</a>
									</td>
								  </tr>
								</table>

							</td>
							<td align="right">
							  <table border="0" cellpadding="0" cellspacing="0">
								<tr>
								  <td width="30" align="right" >
									<a href="#">
									<div class="sm">
										<span>&nbsp;</span>
									</div>
									</a>
								  </td>
								   
								</tr>
								<tr>								 
								  <td colspan="4" align="right"><p class="copyright" style="color: white;padding-right:5px">Copyright © 2016. All rights reserved.</p></td>								  
								</tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </body>
					</html>';
		
		return $template;
	}
	
	function send_addmember($dataArray = null){		
		$results['msg'] = '';
		$results['status'] = '';
		//$template=$this->template_email();
		$template=$this->test_template_email();		
		$template = str_replace('!#NAME', $dataArray['nama'], $template);
		$template = str_replace('!#KODE_UNIK', $dataArray['kode_unik'], $template);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);		
		curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');		
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/mybmw.co.id/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			'from' => 'BMW<admin@BMW.co.id>',
			'to' => 'fauzi.rahman@kana.co.id',
			//'to' => $dataArray['email'],
			'subject' => "EXPERIENCE THE ALL-NEW BMW X1",
			'html' => $template,
			'o:campaign' => 'fkdf5'
		));
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		$res = json_decode($result, TRUE);
		//$res['email'] = $dataArray['email'];
		if ($info['http_code'] != '200') {
			$results['msg'] = $res['message'];
			$results['status'] = '0';
		}
		else {
			$results['msg'] = $res['message'];
			$results['status'] = '1';
		}
		curl_close($ch);
		//echo $result;
		//$this->insert_emailblast($dataArray['email']);
		return $results;
	}
}
