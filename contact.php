<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Contact Us with just a button click!</title>
<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fallback.css" rel="stylesheet" type="text/css" media="all" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link href="css/fallback.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<!--header-->
	<div class="header" id="home">
		<?php include_once('lib/_header_top.php'); ?>
		<div class="container">
			<div class="header-bottom">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<nav class="menu menu--francisco">
								<ul class="nav navbar-nav menu__list">
									<li class="menu__item"><a href="index" class="menu__link"><span class="menu__helper">Home</span></a></li>
									<li class="menu__item"><a href="about" class="menu__link"><span class="menu__helper">About</span></a></li>
									<!-- <li class="menu__item"><a href="property" class="menu__link"><span class="menu__helper">Property Search</span></a></li> -->
									<li class="menu__item"><a href="login" class="menu__link"><span class="menu__helper">Login</span></a></li>
									<li class="menu__item"><a href="register" class="menu__link"><span class="menu__helper">Register</span></a></li>
									<li class="menu__item menu__item--current"><a href="contact" class="menu__link"><span class="menu__helper">Contact</span></a></li>
								</ul>
							</nav>
								<div class="social-icons">
									<a href="http://www.facebook.com" target="_blank"><i class="icon"></i></a>
									<a href="http://www.twitter.com" target="_blank"><i class="icon1"></i></a>
									<a href="http://www.gplus.com" target="_blank"><i class="icon2"></i></a>
									<a href="http://www.linkedin.com" target="_blank"><i class="icon3"></i></a>
								</div>
							<div class="clearfix"></div>
						</div><!-- /.navbar-collapse -->
							<!-- /.container-fluid -->
					</div>
				</nav>

			</div>
		</div>
	</div>
	<!--header-->
		<!--banner-->
	<div class="banner1">
		<div class="container">
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Contact</span></h3>
		</div>
	</div>
<!--banner-->
	<!--contact-->
		<div class="content">
			<div class="contact-w3l">
				<h2 class="tittle">Contact Us</h2>
				<div class="map">
				<iframe style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJzUh0I--pBg8RNMtx7S-eE5Q&key=AIzaSyBERbp7Ko_mY0n0EaZO_MD6dQR2BXiZ9-o" allowfullscreen></iframe>
				<!--<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d27357727.166763138!2d-112.5264373227105!3d33.17301095824987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sreal+estate+usa!5e0!3m2!1sen!2sin!4v1464762889606" style="border:0" allowfullscreen></iframe>-->
				</div>
				<div class="container">
					<div class="contact-grids">
						<div class="col-md-6 contact-left">
							<img src="images/agent.jpg" class="img-responsive" alt=""/>
						</div>
						<div class="col-md-6 contact-right">
							<h4>Top Railtors</h4>
							<ul>
								<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> Office : 33445522</li>
								<li><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> Mobile : +232-78-774-994</li>
								<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> <a href="#"><a href="mailto:info@example.com">toprailtors@orea.com</a></a></li>
								<li><i class="glyphicon glyphicon-print" aria-hidden="true"></i> Fax : 91-789-456100</li>
								<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>9 Lama Lane, Makeni city.</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<p>We are dedicated to the relentless development of Information Technology in Sierra Leone and our key motive is to promote online business transactions through E Commerce which is the world's leading market in the information age.</p>
						<p>TShe online real estate application has been very instrumental in prmoting E Commerce in the sector of estate business transactions such as houses,lands, villas and the likes. All the efforts applied in this application is geared towards solving the problem faced in the real estate business sector in our beloved nation Sierra Leone.</p>
					</div>
					<div class="contact-form">
						<h4>Contact Form</h4>
						<?php
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E49"){
									$displayError ="Please fill all input fields";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E53"){
									$displayError ="*Please fill Feedback input field";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E51"){
									$displayError ="*Please fill Email Subject input field";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E52"){
									$displayError ="Please fill Email input field";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E50"){
									$displayError ="Please fill Name input field";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']=="0X00E54"){
									$displayError ="Mail not sent";
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
						 ?>
						<form action="bin/sendmail" method="post" id="register">
							<?php
							if(isset($_REQUEST['successCode']) && $_REQUEST['successCode']=="0X00F50"){
								$displayFeedback = "Request submitted successfully,<br /> You will be contacted shortly.";
								$message = "<div class='alert alert-success noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
								$message .= "<strong><h1>Thank you</h1><br /></strong>{$displayFeedback}</div>";
								echo $message;
							}
 	 					 ?>
							<input type="text" Placeholder="Name" name="Name" autofocus />
							<input type="text" name="emailSubject" placeholder="Subject" autocomplete="on">
							<input type="text" name="Email" placeholder="Email id" autocomplete="on">
							<textarea name="feedback"></textarea>
							<input type="submit" value="Submit" name="submit" >
							<input type="reset" value="Clear" >
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--contact-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("lib/_footer.php");
?>
</body>
<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include_once('script.php');  ?>
<!--js-->
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,700italic,700,600italic,600,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--webfonts-->
<script src="js/responsiveslides.min.js"></script>
 <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
  <link href="css/owl.carousel.css" rel="stylesheet">
<script src="js/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
		$("#owl-demo").owlCarousel({
			items : 1,
			lazyLoad : true,
			autoPlay : true,
			navigation : false,
			navigationText :  false,
			pagination : true,
		});
		});
	</script>
</html>
