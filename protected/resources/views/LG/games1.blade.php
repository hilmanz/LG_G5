@extends('app') <!-- view/app.blade.php -->

@section('content')
<div id="content" role="main">
            <section id="welcome" class="section swatch-red-white">
                <div class="background-media" style="background-image: url('assets/images/games-bkg.png'); background-repeat:no-repeat ;background-attachment: ; background-position:center 60% ; background-size: cover;z-index:0;">
                </div>
                
                <header class="section-header no-underline" style="margin-bottom:0 !important">
                    <h1 class="headline hyper lg-bold">Match <span style="color:#9fa700">GFriend5</span></h1>
                    <h2  style="color:#6c6d6f">Tahukah kamu tentang manfaat dari G5 Friends? Pilih <span class="color:#404041">2 jawaban yang benar</span> dan menangkan hadiah spesialnya!</h2>
                    <p class="bold">01<span style="color:#9fa700">/04</span></p>
                </header>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <img src="assets/images/games/LG-rolling-bot.png" class="img-responsive center-block" style="padding-top:-120px">
                    </div>
                    <h1 class="headline bigger regular text-center" style="color:#9fa700;padding-top:250px">LG ROLLING BOT</h1>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="row text-center">
                            <div class="col-md-3 col-sm-3">
                                <a href="#" class="btn btn-game" onclick="wrongChoose1();" id="choose1" alt="Yes/No">One-touch<br>360 photo &amp; video</a>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <!--a href="#" class="btn btn-game-selected">The robot-of-choice<br>at the moment</a-->
								<a href="#" class="btn btn-game" onclick="rightChoose1();" id="choose2" alt="Yes/No">The robot-of-choice<br>at the moment</a>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <!--a href="#" class="btn btn-game-selected">Pet care -<br>Laser pointer, spinning</a-->
								<a href="#" class="btn btn-game" onclick="rightChoose2();" id="choose3" alt="Yes/No">Pet care -<br>Laser pointer, spinning</a>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <a href="#" class="btn btn-game" onclick="wrongChoose2();" id="choose4" alt="Yes/No">Easy to access<br>shutter &amp; zoom button</a>
                            </div>
                        </div>
                    </div>    
                </div>			
		
                <div class="row">
                	<div class="col-md-12 col-sm12 text-center center-block">
                		<label class="msg_error"></label>
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-right play-more">
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
	
	function rightChoose1 () {
        $("#choose2").attr("class", "btn btn-game-selected");
		$("#choose2").attr("alt", "Yes");
		$('.msg_error').html('');
		var answr1= $("#choose2").attr('alt');
		var answr2= $("#choose3").attr('alt');
		if((answr1=="Yes") && (answr2=="Yes")){			
			window.location = basedomain+"games-2";
		}
		rules();
    }
	
	function rightChoose2 () {
        $("#choose3").attr("class", "btn btn-game-selected");
		$("#choose3").attr("alt", "Yes");
		$('.msg_error').html('');
		var answr1= $("#choose2").attr('alt');
		var answr2= $("#choose3").attr('alt');
		if((answr1=="Yes") && (answr2=="Yes")){
			window.location = basedomain+"games-2";
		}
		rules();
    }
	
	function rules (){
		var answr1= $("#choose1").attr('alt');
		var answr2= $("#choose4").attr('alt');
		var answr3= $("#choose2").attr('alt');//yes
		var answr4= $("#choose3").attr('alt');//yes
		if((answr1=="No") && (answr2=="No")){			
			$('.msg_error').html('Sorry Friend jawabanmu kurang tepat! Yuk cari jawaban yang paling bener untuk lanjut ke pertanyaan berikutnya!');
			$("#choose1").attr("class", "btn btn-game");
			$("#choose2").attr("class", "btn btn-game");
			$("#choose3").attr("class", "btn btn-game");
			$("#choose4").attr("class", "btn btn-game");
			$("#choose1").attr("alt", "Yes/No");
			$("#choose2").attr("alt", "Yes/No");
			$("#choose3").attr("alt", "Yes/No");
			$("#choose4").attr("alt", "Yes/No");
		}else if((answr3=="Yes") && (answr2=="No")){
			$('.msg_error').html('Sorry Friend jawabanmu kurang tepat! Yuk cari jawaban yang paling bener untuk lanjut ke pertanyaan berikutnya!');
			$("#choose1").attr("class", "btn btn-game");
			$("#choose2").attr("class", "btn btn-game");
			$("#choose3").attr("class", "btn btn-game");
			$("#choose4").attr("class", "btn btn-game");
			$("#choose1").attr("alt", "Yes/No");
			$("#choose2").attr("alt", "Yes/No");
			$("#choose3").attr("alt", "Yes/No");
			$("#choose4").attr("alt", "Yes/No");
		}else if((answr4=="Yes") && (answr2=="No")){
			$('.msg_error').html('Sorry Friend jawabanmu kurang tepat! Yuk cari jawaban yang paling bener untuk lanjut ke pertanyaan berikutnya!');
			$("#choose1").attr("class", "btn btn-game");
			$("#choose2").attr("class", "btn btn-game");
			$("#choose3").attr("class", "btn btn-game");
			$("#choose4").attr("class", "btn btn-game");
			$("#choose1").attr("alt", "Yes/No");
			$("#choose2").attr("alt", "Yes/No");
			$("#choose3").attr("alt", "Yes/No");
			$("#choose4").attr("alt", "Yes/No");
		}else if((answr3=="Yes") && (answr1=="No")){
			$('.msg_error').html('Sorry Friend jawabanmu kurang tepat! Yuk cari jawaban yang paling bener untuk lanjut ke pertanyaan berikutnya!');
			$("#choose1").attr("class", "btn btn-game");
			$("#choose2").attr("class", "btn btn-game");
			$("#choose3").attr("class", "btn btn-game");
			$("#choose4").attr("class", "btn btn-game");
			$("#choose1").attr("alt", "Yes/No");
			$("#choose2").attr("alt", "Yes/No");
			$("#choose3").attr("alt", "Yes/No");
			$("#choose4").attr("alt", "Yes/No");
		}else if((answr4=="Yes") && (answr1=="No")){
			$('.msg_error').html('Sorry Friend jawabanmu kurang tepat! Yuk cari jawaban yang paling bener untuk lanjut ke pertanyaan berikutnya!');
			$("#choose1").attr("class", "btn btn-game");
			$("#choose2").attr("class", "btn btn-game");
			$("#choose3").attr("class", "btn btn-game");
			$("#choose4").attr("class", "btn btn-game");
			$("#choose1").attr("alt", "Yes/No");
			$("#choose2").attr("alt", "Yes/No");
			$("#choose3").attr("alt", "Yes/No");
			$("#choose4").attr("alt", "Yes/No");
		}
	}
</script>
@stop
