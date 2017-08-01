@extends('app') <!-- view/app.blade.php -->

@section('content')
<div id="content" role="main">
            <section id="welcome" class="section swatch-red-white">
                <div class="background-media" style="background-image: url('assets/images/background-submit.png'); background-repeat:no-repeat ;background-attachment: ; background-position:center 60% ; background-size: cover;z-index:0;">
                </div>
                
                

                <div class="container">
                    <header class="section-header no-underline" style="margin-bottom:0 !important">
                        <h1 class="headline hyper lg-bold">Congratulation, <span style="color:#9fa700">Friends!</span></h1>
                        <h2  style="color:#6c6d6f">Kamu telah berhasil mencocokkan LG G5 &amp; Friends! <br>Silakan isi data di bawah ini dan dapatkan kode unik yang bisa kamu tukarkan dengan hadiah menarik!</h2>
                        
                    </header>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            
                            <form id="contactForm" class="contact-form" method="" action="">
                                <div class="form-wrapper">                                
                                    <p class="text-center">Nama Lengkap</p>
                                    <div class="form-group form-icon-group">
                                        <input class="form-control name" id="name" name="name" placeholder="" type="text" required/>
                                        <label class="name_erorr" style="color: red;"></label>
                                    </div>
                                    <p class="text-center">No. Telp</p>
                                    <div class="form-group form-icon-group">
                                        <input class="form-control" id="telp" name="telp" placeholder="" type="text" required>
                                        <label class="telp_erorr" style="color: red;"></label>
                                    </div>
                                    <p class="text-center">Email</p>
                                    <div class="form-group form-icon-group">
                                        <input class="form-control telp" id="email" name="email" placeholder="" type="email" required>
                                    </div>
									<label class="email_erorr" style="color: red;"></label>
                                </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary simpan" type="submit">
                                            SUBMIT
                                        </button>
                                    </div>
                            </form>
                            <div id="messages"></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right play-more">
                        <img src="assets/images/design/lifegoodwhenplaymore.png">
                    </div>
                </div>
            </section>

<script src="{{url('/')}}/assets/js/jquery.js"></script>

<script type="text/javascript">
var basedomain="{{url('/')}}/";

$('#telp').keyup(function () {  	
		if(this.value){
			this.value = this.value.replace(/[^0-9]/g,''); 
		}
	});	
	
$(".simpan").click(function(){
	var namenya=$("#name").val();
	var email=$("#email").val();
	emailsplit = $('#email').val().split(',');
	emailformat='';
	var telp=$("#telp").val();
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,15})+$/; 
	var ix=0;
	var valid='';
	var emailSame='';
	var telpSame='';
	$('.email_erorr').html('');
	$('.telp_erorr').html('');
	if($('#name').val()==''){		
		valid='ada';
		$('.name_erorr').html('kolom ini harus diisi');
	}
	if($('#email').val()==''){		
		valid='ada';
	$('.email_erorr').html('kolom ini harus diisi');		
	}else if(!$('#email').val().match(mailformat))
				{
					valid='ada';
					$('.email_erorr').html('salah format Email');
				}
	if($('#telp').val()==''){		
		valid='ada';
		$('.telp_erorr').html('kolom ini harus diisi');
	}
	
if(valid){	
		return false;		
	}else{
		$.ajax ({ 
				'type': 'POST',
				'url': basedomain+'home/checkEmail',
				'data':{email:email,telp:telp},
				'dataType':'json',				
				'success'	: function (result) {
					
					if(result.status==1){
						
						if(emailSame=='')
						{
							console.log("emailnya");							
							emailSame +=result.email;
							
						}
						else
						{
							console.log("emailnya");
							emailSame +=','+result.email;
						}
						telpSame +=result.telp;
						if(telpSame)
						{							
							$('.telp_erorr').html('No. Telp '+telpSame+' sudah terdaftar');							
							var error = true;
							valid='ada';
						}
						
						if(emailSame)
						{
							console.log("sama emailnya");
							$('.email_erorr').html('email <span class="emailsame" > '+emailSame+'</span> sudah terdaftar');
							
							var error = true;
							valid='ada';
						}
						else{
							
						}
					}
					else{
						
						console.log("email kosong");           
						var namenya=$("#name").val();
						var email=$("#email").val();
						var telp=$("#telp").val();
														
								$.ajax ({ 
									type	: 'POST',  
									url	 	:  basedomain+'home/updatecontact' , 
									data	:{nama:namenya,email:email,telp:telp},
									dataType:'json',
									success	: function (result) 
									{
										window.location = basedomain+"notif";
										//alert("sukses");
									}
								});
								
					}
					//console.log(valid);
					
						if(valid){							
							return false;							
						}
						return false;
				}
			});

			



		return false;	
	}
							
});

function validtelp(valid){
	var namenya=$("#name").val();
	var email=$("#email").val();	
	var telp=$("#telp").val();	
	var ix=0;
	var valid='ada';	
	var telpSame='';
	$.ajax ({ 
				'type': 'POST',
				'url': basedomain+'home/checkTelp',
				'data':{telp:telp},
				'dataType':'json',				
				'success'	: function (result) {
					
					if(result.status==1){
						
						telpSame +=result.telp;
						if(telpSame)
						{							
							$('.telp_erorr').html('No. Telp '+telpSame+' sudah terdaftar');							
							var error = true;
							valid='ada';
						}
						else{
							
						}
					}
					else{
						console.log("email kosong"); 
						/*
						var namenya=$("#name").val();
						var email=$("#email").val();
						var telp=$("#telp").val();
														
								$.ajax ({ 
									type	: 'POST',  
									url	 	:  basedomain+'home/register' , 
									data	:{nama:namenya,email:email,telp:telp},
									dataType:'json',
									success	: function (result) 
									{
										alert("sukses");
									}
								});
						*/
					}
					//console.log(valid);
					
						if(valid){							
							return false;							
						}
						return false;
				}
			});
}


</script>
<script>


</script>
@stop
