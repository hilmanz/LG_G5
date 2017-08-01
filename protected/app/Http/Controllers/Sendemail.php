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

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Sendemail extends Controller
{
     ///----------------Emai---------------------------------------------------------------//
	 function send_email_notif() {		 
		$title='Shinkenjuku Business Opportunity';
		$message='Content';
		include "mailpostmark.php";
		$POSTMARK_API_KEY = 'd3e281a6-7695-4f13-95a9-7430caade63d';
		$EMAIL_SENDER = 'admin@BMW.com';
		$RECEIVER = 'fauzi.rahman@kana.co.id';

		$postmark = new mailpostmark($POSTMARK_API_KEY,$EMAIL_SENDER);
		$postmark->to($RECEIVER);
		//$postmark->addCC('cania.nasucha@kana.co.id');

		return ($postmark->subject($title)->messageHtml($message)->send());
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
  background: url("images/blue-highlight.png") no-repeat center 40px;
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
  background: #393939;
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
        <div class="container">
            <!-- LOGO CONTAINER -->
            <div class="logo-cont">
                <a class="navbar-brand" href="#">
                    <img src="images/logo_manualXbmw.png" alt="Manual X BMW">    
                </a> 
            </div>
        </div>
    </div>

<!-- =========================
     THANKS
============================== -->
    <table border="0" cellpadding="0" cellspacing="0" width="600" id="thankyou">
      <tr>
        <td><h2 class="thanks_scribe">
        EXPERIENCE<br>THE ALL-NEW BMW X<span>1</span>  
      </h2></td>
      </tr>
      <tr>
        <td align="center" class="thanks_car"><br><br><img src="images/thanks_car.jpg" alt="BMW X1" class="img-responsive"></td>
      </tr>
      <tr>
        <td>
          <p class="thanks-desc">Dear [NAME],</p>
          <p class="thanks-desc">Thank you for your interest in experiencing the all-new BMW X1.</p>
          <p class="thanks-desc">BMW is proud to be working together with the people of Manual Jakarta in breaking through limitations and exploring the unfamiliar with an adventurous mindset.</p>
          <p class="thanks-desc">Our team will contact you shortly to schedule the time and place of your driving experience. We hope that you will enjoy your experience in driving the all-new BMW X1.</p>
          <p class="thanks_regards">Regards,<br>BMW</p>
        </td>
      </tr>

    </table>

    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="footer">
      <tr>
        <td width="30%" align="left">
            
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div class="footer-logo"><img src="images/logo_manualXbmw.png" alt="Manual X BMW"><div></td>
                <td class="weblink">
                  <a href="#">www.mybmw.co.id</a><br>
                  <a href="#">www.manual.co.id</a>
                </td>
              </tr>
            </table>

        </td>
        <td  align="left">
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right">
                <a href="#">
                <div class="sm">
                    <span><img src="images/icon-fb.png" alt="facebook"></span>
                </div>
                </a>

                <!-- TWITTER -->
                <a href="#">
                    <div class="sm">
                        <span><img src="images/icon-twitter.png" alt="twitter"></span>
                    </div>
                </a>

                <!-- INSTAGRAM -->
                <a href="#">
                    <div class="sm">
                        <span><img src="images/icon-instagram.png" alt="instagram"></span>
                    </div>
                </a>
              </td>
            </tr>
            <tr>
              <td align="right"><p class="copyright">Copyright © 2016. All rights reserved.</p></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>';
		/*
		$template='
					<html>
						<head>
							<title>Registrasi Member</title>
							<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
						</head>
						<body bgcolor="#000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
							<!-- Save for Web Slices (email-template-invi.png) -->
							<table id="Table_01" width="750" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<center>
											<img src="http://www.supersoccer.co.id/campusleague/assets/images/logo.png" width="500" alt=""/>
										</center>
									</td>
								</tr>
								<tr>
									<td>
										<div style=" background:#730000; color:#fff; padding:40px 30px; font-family:sans-serif; line-height: 24px;">
											<p>Hi, !#username</p>
											<p>Ingin Tour ke INGGRIS / ITALIA dan Nonton pertandingan langsung!</p>
											<p>Mudah caranya: Download dan install SUPERSOCCER FOOTBALL MANAGER di smartphone mu (via Google Apps Store atau IOS) sekarang juga dan mulai kumpulkan poin! Poin-poin tertinggi berkesempatan untuk memenangkan HADIAH ini!</p>
											<p>Untuk download Supersoccer Football Manager versi terbaru, klik tombol di bawah ini:</p>
											<div style=" background:#730000; color:#fff; padding:0px 0px; font-family:sans-serif; line-height: 24px;">
												<a class="aDown" target="_blank" href="https://play.google.com/store/apps/details?id=air.com.arm_enterprises.supersoccer.england2014">
													<img src="http://www.supersoccer.co.id/sscrregion2/assets/images/android_download.png" width="200" alt=""/>
												</a>
												<a class="aDown" target="_blank" href="https://itunes.apple.com/us/app/supersoccer-2014/id902290991?ls=1&amp;mt=8">
													<img src="http://www.supersoccer.co.id/sscrregion2/assets/images/appstore_download.png" width="200" alt=""/>
												</a>
											</div>
											<p>Temukan beragam fitur baru di Supersoccer Football Manager dan rasakan pengalaman menjadi manager sepakbola sesungguhnya! Temukan infonya di <a style="color:#fdcb02; text-decoration:none;" target="blank" href="http://fm.supersoccer.co.id/">http://fm.supersoccer.co.id</a></p>
											<p>Inilah saatnya kamu buktikan dan menjadi manager terbaik musim ini di Supersoccer Campus League!</p>
											<p>Terima Kasih dan Selamat Berkompetisi!</p>
											<p>Supersoccer</p>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<img src="http://gte.supersoccer.co.id/assets/images/email-template-invi_03.jpg" width="750" height="136" alt=""/>
									</td>
								</tr>
							</table>
							<!-- End Save for Web Slices -->
						</body>
					</html>
					';
		*/		
		return $template;
	}
	
	function send_addmember($dataArray = null){		
		$results['msg'] = '';
		$results['status'] = '';
		$template=$this->template_email();
		//$template = str_replace('!#username', $dataArray['namemember'], $template);
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
			'subject' => "Jadilah manager terbaik di BMW",
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
		return $results;
	}
	
	function insert_emailblast($userid, $email, $n_status) {		
		DB::table('tbl_email_blast')->insert(
			['email' => ".$email.", 'n_status' => 1]
		);
		print json_encode(array('status'=>true));    
	}
///----------------Closed Email---------------------------------------------------------------//	
}
