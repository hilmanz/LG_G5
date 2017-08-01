<?php

namespace App\Http\Controllers;

use App\contact;
use App\email_blast;
use Auth;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Request;
use DB;
use App\Quotation;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BMWController extends Controller
{
	public function __construct(Request $request){
        $this->request = $request;
     }
	 
     public function index()
	 {
		$pages='index';		 
		return view('BMW.index', compact('pages')); 
	 }
	 
     public function about()
	 {  	
		 $pages='about';
		 return view('BMW.about', compact('pages')); 
	 }
	 
     public function why()
	 {
		 $pages='why';
		 return view('BMW.why', compact('pages')); 
	 }
	 
	
	 
	 public function issue()
	 {			
		 $pages='coverage';
		 return view('BMW.issue', compact('pages'));
	 }
	 
	 public function photography()
	 {			
		 $pages='photography';
		 return view('BMW.photography', compact('pages'));
	 }

	 public function graphicdesign()
	 {			
		 $pages='graphicdesign';
		 return view('BMW.graphicdesign', compact('pages'));
	 }
	
		
	public function city_tour()
	 {			
		$pages='';
		$pesan='';
		$slide_data = DB::table('slide')
		->where('id_category', '3')
		->where('n_status', '1')
		->orderBy('slide.type', 'desc')
		->orderBy('slide.id', 'desc')		
		->paginate(10);
		
		$article_content = DB::table('article')
							->where('id_category', '3')
							->where('n_status', '1')
							->orderBy('id', 'desc')->get();		

		foreach ($article_content as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['banner'] = stripslashes($val->banner);
		$result[$key]['content'] = $val->content;		
		$result[$key]['position'] = stripslashes($val->position);
		$result[$key]['event_date'] = date("l,  d/m/y",strtotime($val->event_date));		
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result;	
		return view('BMW.city_tour', compact('article_content','slide_data','pesan','pages'));
	 }
	
	 public function article()
	 {			
		  $slide_data = DB::table('slide')
		 ->orderBy('slide.id', 'desc')
		 ->paginate(10);		 
		 $pages='article';
		 return view('BMW.article', compact('pages','slide_data'));
	 }
	 
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function list_article()
	 {
		$slide_data = DB::table('slide')
		->where('n_status', '1')
		->where('id_category', '1')
		->orderBy('slide.type', 'desc')
		->orderBy('slide.id', 'desc')
		->paginate(10);
				
		 $result="";
		$article_content = DB::table('article')
							->where('id_category', '2')
							->where('n_status', '1')
							->orderBy('id', 'desc')->get();		

		foreach ($article_content as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['banner'] = stripslashes($val->banner);
		$result[$key]['content'] = substr($val->content, 0, 250);		
		$result[$key]['position'] = stripslashes($val->position);		
		$result[$key]['event_date'] = date("l,  d/m/y",strtotime($val->event_date));		
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result;				
		$pages='';
		$pesan='continue';
		return view('BMW.list_articles', compact('article_content','slide_data','pesan','pages'));
	 }
	 
	 /**
	  * Display the specified resource.
	  *
	  * @param  int  $id
	  * @return Response
	 **/ 
	 public function detail_article($id)
	 {	
		$pages='';
		$pesan='';
		$slide_data = DB::table('slide')
		->where('id_category', '2')
		->where('n_status', '1')
		->where('id_article', $id)
		->orderBy('slide.type', 'desc')
		->orderBy('slide.id', 'desc')		
		->paginate(10);
		
		$hitung = DB::table('slide')
		->where('id_category', '2')
		->where('n_status', '1')
		->where('id_article', $id)
		->orderBy('slide.type', 'desc')
		->orderBy('slide.id', 'desc')		
		->count();
		
		$article_content = DB::table('article')
							->where('id_category', '2')
							->where('n_status', '1')
							->where('id', $id)
							->orderBy('id', 'desc')->get();		

		foreach ($article_content as $key => $val){
		$result[$key]['id'] = stripslashes($val->id);
		$result[$key]['title'] = stripslashes($val->title);
		$result[$key]['banner'] = stripslashes($val->banner);
		$result[$key]['content'] = $val->content;		
		$result[$key]['position'] = stripslashes($val->position);
		$result[$key]['event_date'] = date("l,  d/m/y",strtotime($val->event_date));		
		$result[$key]['titleurl'] = str_replace(' ','-',stripslashes($val->title));	
		}
		$article_content=$result;	
		return view('BMW.detail_article', compact('article_content','hitung','slide_data','pesan','pages'));
	 }
	 
	 
	  /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function updatecontact()
	 {
		
		//$admin = artikel::findOrFail($id);    
		//$admin->update($request::all());  
		$input = Request::all();
		contact::create($input);
		print json_encode(array('status'=>true));
	    $dataArray = array(
				'nama'=>$input['nama'],
				'email'=>$input['email'],
			);
		$this->send_addmember($dataArray);
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
	
		
	function template_email(){
		$template='
				   <html lang="en">
					<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


					<!-- =========================
						  BASIC PAGE INFORMATION
					============================== -->

						<title>Manual X BMW</title>




					<!-- =========================
						 FONTS
					============================== -->
						<!-- EB Garamond GOOGLE -->
						<link href="http://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet" type="text/css" />



					<!-- =========================
						 THANK YOU PAGE 
					============================== -->
					<style>
					body {
					  background: #e8e8e8;
					  color: #221f1f;
					  font-family: "EB Garamond", serif;
					  font-weight: 300;
					  font-size: 20px;
					  line-height: 35px;
					  overflow-x: hidden;
					  margin: 0;
					  padding: 0;
					}
					.container {
					  padding-right: 15px;
					  padding-left: 15px;
					  margin-right: auto;
					  margin-left: auto;
					}
					a {
					  outline: 0 !important;
					  color: #da4a3a;
					  text-decoration: none !important;
					}
					a:visited {
					  color: #b82818;
					}
					a:hover {
					  color: #3d3d3d;
					}
					h2 {
					  text-align: center;
					  color: #333333;
					  font-weight: 900;
					  text-transform: uppercase;
					  font-size: 3em;
					  line-height: .8em;
					}
					h2 span {
					  color: #da4a3a;
					  font-weight: 400 !important;
					  text-transform: none !important;
					  font-size: .625em;
					}
					h3 {
					  color: #333333;
					  font-size: 2.5em;
					}
					h3:after {
					  width: 100%;
					  max-width: 485px;
					  border-top: 2px solid #da4a3a;
					  height: 1px;
					  display: block;
					  margin: 20px 0 30px;
					}
					h4 {
					  font-size: 1.5em;
					  font-weight: 700;
					}
					h5 {
					  color: #da4a3a;
					  font-size: 1.25em;
					  font-weight: 600;
					}
					h6 {
					  color: #333333;
					  font-size: 1.125em;
					  font-weight: 700;
					}
					.img-responsive {width:100%;}
					table {
					  border-spacing: 0;
					  border-collapse: collapse;
					}
					td,
					th {
					  padding: 0;
					}

					.row {
					  margin-right: -15px;
					  margin-left: -15px;
					}

					#thankyou .thanks {
					  margin-bottom: 60px;
					}
					#thankyou h2 {
					  letter-spacing: 5px;
					}
					#thankyou h2 span{
					  font-family: "Georgia", serif;
					  font-size: 1em;
					  color: #333;
					}

					/*** THANK YOU ***/

					.thanks {
					  margin-top:50px;
					}
					.thanks p {
					  margin-top: 30px;
					  text-align: justify;
					  font-size: 1.15em;
					  line-height: 2em;
					  letter-spacing: 2px;
					}
					.thanks_scribe {
					  width: 80%;
					  position: relative;
					  margin: 0 auto;
					  height: 100px;
					  background: url("'.url('/').'/images/blue-highlight.png") no-repeat center 40px;
					}
					h2.thanks_scribe {
					  padding-top: 30px;
					}
					.thanks_car {
					  margin-top:200px;
					}
					.thanks_car img {
					  width: 100%;
					}
					.thanks_regards {
					  /*float: right;
					  margin-top:100px;*/
					  margin-right:50px;
					  text-align: right;
					}
					.thanks-desc {
					  padding: 0px 20px 0px 20px;
					  line-height: 2em;
					  letter-spacing: 2px;
					}

					.main-menu-thankyou {
					  background-color: #393939;
					  height: auto;
					  padding: 13px 0 15px 0;
					}


					#footer {
					  /*position: absolute;
					  bottom: 0;
					  width: 100%;*/
					  padding: 25px 25px 25px 25px;
					  background: #3d3d3d;
					  color: #ffffff;
					  font-size: .875em;
					  overflow: hidden;
					}

					/*footer .footer-logo img {
						width:100%;
					  }*/
					#footer .weblink a {
					  color: #ffffff;
					  text-decoration: underline !important;
					}
					#footer .sm {
					  color: #ffffff;
					  width: 50px;
					  height: 50px;
					  border-radius: 50%;
					  background: #3d3d3d;
					  position: relative;
					  display: inline-block;
					  margin-right: 10px;
					}
					#footer .sm:hover {
					  background: #000000;
					  color: #cccccc;
					}
					#footer .sm span {
					  top: 0;
					  bottom: 0;
					  left: 0;
					  right: 0;
					  display: inline-table;
					  margin: auto;
					  width: 100%;
					  text-align: center;
					  line-height: 1em;
					}
					.copyright {
					  font-style: italic;
					}

					</style>


					</head>


					<body id="body">



					<!-- =========================
						 HEADER LOGO
					============================== -->

						<div id="mainmenu" class="navbar  main-menu-thankyou" >
							<div class="container" style="background:#393939; color:#fff; width:100%; margin:0 auto;">
								<!-- LOGO CONTAINER -->
								<div class="logo-cont">
									<a class="navbar-brand" href="#">
										<img src="'.url('/').'/images/logo_manualXbmw.png" alt="Manual X BMW">    
									</a> 
								</div>
							</div>
						</div>

					<!-- =========================
						 THANKS
					============================== -->
						<table border="0" cellpadding="30" cellspacing="0" width="100%" id="thankyou" style="background:#e8e8e8;width:100%; margin:0 auto;">
						  <tr>
							<td  align="center">
							<div style=" font-family:EB Garamond; background: url(".url('/')."/images/blue-highlight.png) no-repeat center 40px;">
							<p style = "letter-spacing: 2px; color: 221f1f;font-family: EB Garamond;font-weight: 300;font-size: 35px; ">
								EXPERIENCE<br>THE ALL-NEW<br>BMW X1 
							</p>				
							</div>
							</td>
						  </tr>
						  <tr>
							<td align="center" class="thanks_car"><br><br><img src="'.url('/').'/images/thanks_car.jpg" alt="BMW X1" class="img-responsive"></td>
						  </tr>
						  <tr>
							<td>
							  <p style = "padding: 5px 20px 5px 5px; line-height: 1.5em; letter-spacing: 2px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Dear !#NAME,</p>
							  <p style = "padding: 7px 20px 5px 5px; line-height: 1.5em; letter-spacing: 1px; color: 221f1f;font-family: EB Garamond, serif;font-weight: 300;font-size: 17px; ">Thank you for your interest in experiencing the all-new BMW X1.</p>
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
									<td><div class="footer-logo"><img src="'.url('/').'/images/logo_manualXbmw.png" alt="Manual X BMW"><div></td>
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
								   <td cellpadding="30" >
									<!-- FACEBOOK -->
									<a href="#">
										<div class="sm">
											<span><img src="'.url('/').'/images/icon-fb.png" alt="facebook"></span>
										</div>
									</a>
								  </td>
								  <td cellpadding="30" >
									<!-- TWITTER -->
									<a href="#">
										<div class="sm">
											<span><img src="'.url('/').'/images/icon-twitter.png" alt="twitter"></span>
										</div>
									</a>
								  </td>
								  <td cellpadding="30" >
									<!-- INSTAGRAM -->
									<a href="#">
										<div class="sm">
											<span><img src="'.url('/').'/images/icon-instagram.png" alt="instagram"></span>
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
		$template=$this->template_email();
		//$template = str_replace('!#NAME', $dataArray['namemember'], $template);
		$template = str_replace('!#NAME', $dataArray['nama'], $template);
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
			//'to' => 'fauzi.rahman@kana.co.id',
			'to' => $dataArray['email'],
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
		$this->insert_emailblast($dataArray['email']);
		return $results;
	}
	
	function insert_emailblast($email) {		
		DB::table('tbl_email_blast')->insertGetId(
			['email' => 'fauzi.rahman@kana.co.id', 'n_status' => 1]
		);		
	}
///----------------Closed Email---------------------------------------------------------------//	

	
}
