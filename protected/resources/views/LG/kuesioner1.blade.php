@extends('app') <!-- view/app.blade.php -->

@section('content')
<div id="content" role="main">
            <section id="welcome" class="section swatch-red-white">
                <div class="background-media" style="background-image: url('assets/images/games-bkg.png'); background-repeat:no-repeat ;background-attachment: ; background-position:center 60% ; background-size: cover;z-index:0;">
                </div>
                
                <header class="section-header no-underline" style="margin-bottom:0 !important">
                    <h1 class="headline hyper lg-bold">Which <span style="color:#9fa700">GFriend5</span> Am I</h1>
                    <h2  style="color:#6c6d6f">Mau LG Friends GRATIS?Cari tahu friend yang cocok dengan kamu sekarang!<span class="color:#404041">2 jawaban yang benar</span> dan menangkan hadiah spesialnya!</h2>
                    <p class="bold">01<span style="color:#9fa700">/04</span></p>
                </header>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <img src="assets/images/games/LG-rolling-bot.png" class="img-responsive center-block" style="padding-top:-120px">
                    </div>
                    <h1 class="headline bigger regular text-center" style="color:#9fa700;padding-top:250px">Choose Gender</h1>
                </div>

                <div class="row">
                    <div class="col-md-11 col-md-offset-2">
                        <div class="row text-center">
                            <div class="col-md-2 col-sm-3">
                                <a href="#" class="btn btn-game" onclick="Choose1();" id="choose1" alt="Yes/No">Cewek</a>
                            </div>
                            <div class="col-md-2 col-sm-3">
                                <!--a href="#" class="btn btn-game-selected">The robot-of-choice<br>at the moment</a-->
								<a href="#" class="btn btn-game" onclick="Choose2();" id="choose2" alt="Yes/No">Cowok</a>
                            </div>                           
                        </div>
                    </div>    
                </div>			
		

                <div class="row">
                    <div class="col-md-12 col-sm-12 text-right play-more">
					<label class="msg_error" style="color: red;"></label>
                        <img src="assets/images/design/lifegoodwhenplaymore.png">
                    </div>
                </div>
            </section>

        </div>
<script type="text/javascript">
var basedomain="{{url('/')}}/";
$('.msg_error').html('');
    function wrongChoose1 () {
		$("#choose1").attr("class", "btn btn-game-selected");
		$("#choose1").attr("alt", "No");
		$('.msg_error').html('');		
		rules();
    }
	
	function wrongChoose2 () {        
		$("#choose4").attr("class", "btn btn-game-selected");
		$("#choose4").attr("alt", "No");
		$('.msg_error').html('');		
		rules();
    }	
	
	
</script>
@stop
