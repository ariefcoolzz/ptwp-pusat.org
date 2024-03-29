<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script|Herr+Von+Muellerhoff' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Istok+Web|Roboto+Condensed:700' rel='stylesheet' type='text/css'>

  <title>Skema Pertandingan</title>
</head>
<body>
<?php /*
  <header class="hero">
    <div class="hero-wrap">
     <p class="intro" id="intro">flexbox</p>
     <h1 id="headline">Tournament</h1>
     <p class="year"><i class="fa fa-star"></i> 2015 <i class="fa fa-star"></i></p>
     <p>Ballin' Outta Control</p>
   </div>
  </header>
*/ ?>

  <section id="bracket">
  <div class="container">
  <div class="split split-one">
    

    <div class="round round-two">
      <div class="round-details">Babak Per 16<br/><span class="date">4 Desember 2021</span></div>     
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('8'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] <= 4)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>               
    </div>  <!-- END ROUND TWO -->
    
    <div class="round round-three">
		<div class="round-details">Babak Per 8<br/><span class="date">4 Desember 2021</span></div>     
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('4'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] <= 2)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>                  
    </div>  <!-- END ROUND THREE -->    
  </div> 

<div class="champion">
    <div class="semis-l">
		<div class="round-details">Semi Final<br/><span class="date">5 Desember 2021</span></div>   
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('2'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] == 1)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>       
    </div>
    <div class="final">
      <i class="fa fa-trophy"></i>
      <div class="round-details">Final <br/><span class="date">5 Desember 2021</span></div>    
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('1'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] == 1)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-success text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-success text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>   
    </div>
    <div class="semis-r">   
		<div class="round-details">Semi Final <br/><span class="date">5 Desember 2021</span></div>   
			<?php 
			$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('2'));
			IF(COUNT($data->result_array())) {
				FOREACH ($data->result_array() as $R) {
					IF($R['urutan'] == 2)
						{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
				}
			}
			?>   
    </div>  
  </div>


  <div class="split split-two">


    <div class="round round-three">
		<div class="round-details">Babak Per 8<br/><span class="date">4 Desember 2021</span></div>           
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('4'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] >= 3)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>               
    </div>  <!-- END ROUND THREE -->  

    <div class="round round-two">
		<div class="round-details">Babak Per 16<br/><span class="date">4 Desember 2021</span></div>           
		<?php 
		$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],MD7('8'));
		IF(COUNT($data->result_array())) {
			FOREACH ($data->result_array() as $R) {
				IF($R['urutan'] >= 5)
					{
						$tunggal_ganda = $this->Model_main->model_cek_tunggal_ganda($_POST['id_kategori']);
						$txt_A = ''; $txt_A_point = '';
						$txt_B = ''; $txt_B_point = '';
						if($R['set1_tim_A'] > $R['set1_tim_B']){
							$txt_A = ' bg-primary text-white'; 
							$txt_A_point = ' text-white';
						}
						if($R['set1_tim_B'] > $R['set1_tim_A']){
							$txt_B = ' bg-primary text-white'; 
							$txt_B_point = ' text-white';
						}
						?>
						<ul class="matchup">
							<li class="team team-top <?php echo $txt_A; ?>">		<span class='nama'><?php echo $R['nama_tim_A']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_A_point; ?>"><?php echo $R['set1_tim_A'];?></span></li>
							<li class="team team-bottom <?php echo $txt_B; ?>">	<span class='nama'><?php echo $R['nama_tim_B']; ?></span><span class="score1"></span><span class="score2"></span><span class="score3 <?php echo $txt_B_point; ?>"><?php echo $R['set1_tim_B'];?></span></li>
						</ul>
						<?php
					}
			}
		}
		?>                
    </div>  <!-- END ROUND TWO -->
                   
  </div>
  </div>
  </section>
  <section class="share">
      <div class="share-wrap">
        <a class="share-icon" href="https://twitter.com/_joebeason"><i class="fa fa-twitter"></i></a>
        <a class="share-icon" href="#"><i class="fa fa-facebook"></i></a>
        <a class="share-icon" href="#"><i class="fa fa-envelope"></i></a>
      </div>
  </section>

<style>
body {font-family: 'Istok Web', sans-serif;background: url("http://picjumbo.com/wp-content/uploads/HNCK2189-1300x866.jpg") no-repeat;background-size: cover;min-height: 100%;margin: 0;}
.hero {position:relative; text-align: center; overflow: hidden; color: #fcfcfc; }
.hero h1 {font-family: 'Holtwood One SC', serif;font-weight: normal;font-size: 5.4em;margin:0 0 20px; text-shadow:0 0 12px rgba(0, 0, 0, 0.5);text-transform: uppercase;letter-spacing:-1px;}
.hero p {font-family: 'Abel', sans-serif;text-transform: uppercase; color: #5CCA87; letter-spacing: 6px;text-shadow:0 0 12px rgba(0, 0, 0, 0.5);font-size: 1.2em;}
.hero-wrap {padding: 3.5em 10px;}
.hero p.intro {font-family: 'Holtwood One SC', serif;text-transform: uppercase;letter-spacing: 1px;font-size: 3em;margin-bottom:-40px;}
.hero p.year {color: #fff; letter-spacing: 20px; font-size: 34px; margin: -25px 0 25px;}
.hero p.year i {font-size: 14px;vertical-align: middle;}
#bracket {overflow:hidden;background-color: #e1e1e1;background-color:rgba(225,225,225,0.9);padding-top: 20px;font-size: 12px;padding: 40px 0;}
.container {max-width: 1100px;margin: 0 auto;display:block;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: -webkit-flex;display: flex;-webkit-flex-direction:row;flex-direction: row;}
.split {display:block;float:left;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display:flex;width: 42%;-webkit-flex-direction:row;-moz-flex-direction:row;flex-direction:row;}
.champion {float:left;display:block;width: 16%;-webkit-flex-direction:row;flex-direction:row;-webkit-align-self:center;align-self:center;margin-top: -15px;text-align: center;padding: 230px 0\9;} 
.champion i {color: #a0a6a8; font-size: 45px;padding: 10px 0; }
.round {display:block;float:left;display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display:flex;-webkit-flex-direction:column;flex-direction:column;width:95%;width:30.8333%\9;}
.split-two {}
.split-one .round {margin: 0 2.5% 0 0;}
.split-two .round {margin: 0 0 0 2.5%;}
.matchup {margin:0;width: 100%;padding: 10px 0;height:60px;-webkit-transition: all 0.2s;transition: all 0.2s;}
.score1{font-size: 11px;text-transform: uppercase;float: right;color: #2C7399;font-weight: bold;font-family: 'Roboto Condensed', sans-serif;position: absolute;right: 35px;}
.score2{font-size: 11px;text-transform: uppercase;float: right;color: #2C7399;font-weight: bold;font-family: 'Roboto Condensed', sans-serif;position: absolute;right: 20px;}
.score3{font-size: 11px;text-transform: uppercase;float: right;color: #2C7399;font-weight: bold;font-family: 'Roboto Condensed', sans-serif;position: absolute;right: 5px;}
.team {padding: 0 5px;margin: 3px 0;white-space: nowrap; overflow: hidden;position: relative;}
.round-two .matchup {margin:0; height: 60px;padding: 50px 0;}
.round-three .matchup {margin:0; height: 60px; padding: 100px 0;}
.round-details {font-family: 'Roboto Condensed', sans-serif; font-size: 13px; color: #2C7399;text-transform: uppercase;text-align: center;height: 40px;}
.champion li, .round li {background-color: white;box-shadow: none;list-style-type: none; text-align: left;}
.current li {opacity: 1;}
.current li.team {background-color: #fff;box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);opacity: 1;}
.vote-options {display: block;height: 52px;}
.share .container {margin: 0 auto; text-align: center;}
.share-icon {font-size: 24px; color: #fff;padding: 25px;}
.share-wrap {max-width: 1100px; text-align: center; margin: 60px auto;}
.final {margin: 4.5em 0;}

@-webkit-keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}

@keyframes pulse {
  0% {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  50% {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
  }

  100% {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }
}

.share-icon {color: #fff; opacity: 0.35; }
.share-icon:hover { opacity:1;  -webkit-animation: pulse 0.5s; animation: pulse 0.5s;}
.date {font-size: 10px; letter-spacing: 2px;font-family: 'Istok Web', sans-serif;color:#3F915F;}



@media screen and (min-width: 981px) and (max-width: 1099px) {
  .container {margin: 0 1%;}
  .champion {width: 14%;}
  .split {width:43%; }
  .split-one .vote-box {margin-left: 138px;}
  .hero p.intro {font-size: 28px;}
  .hero p.year {margin: 5px 0 10px;}

}

@media screen and (max-width: 980px) {
  .container {-webkit-flex-direction:column;-moz-flex-direction:column;flex-direction:column;}
  .split, .champion {width: 90%;margin: 35px 5%;}
  .champion {-webkit-box-ordinal-group:3;-moz-box-ordinal-group:3;-ms-flex-order:3;-webkit-order:3;order:3;}
  .split {border-bottom: 1px solid #b6b6b6; padding-bottom: 20px;}
  .hero p.intro {font-size: 24px;}
  .hero h1 {font-size: 3em; margin: 15px 0;}
  .hero p {font-size: 1em;}
}


@media screen and (max-width: 400px) {

  .split {width: 95%;margin: 25px 2.5%;}
  .round {width:21%;}
  .current {-webkit-flex-grow:1;-moz-flex-grow:1;flex-grow:1;}
  .hero h1 {font-size: 2.15em; letter-spacing: 0;margin:0; }
  .hero p.intro {font-size: 1.15em;margin-bottom: -10px;}
  .round-details {font-size: 90%;}
  .hero-wrap {padding: 2.5em;}
  .hero p.year {margin: 5px 0 10px; font-size: 18px;}

}
</style>

