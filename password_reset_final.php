<?php
session_start();
if(!isset($_SESSION['securityUsername'])){
	header("Location: login");
}
if(file_exists("lib/library.class.php")){
	include_once("lib/library.class.php");
}else{
	die("<script> alert('File not found');</script>");
}
$displayError = "";
$question = NULL;
$username = $_SESSION['securityUsername'];
$newUser = new user(); //User management class with custom built functions
$validate =  new sanitizer(); //Sanitization class for security checking
if($newUser->checkuser($username,$conn->conn)==false){
		if(isset($_REQUEST['submit'])){
				if($validate->validate($_REQUEST['valPassword'])){
					if($validate->validate($_REQUEST['rePassword'])){
							if($validate->transform($_REQUEST['valPassword'])==$validate->transform($_REQUEST['rePassword'])){
									$valPassword =trim($_REQUEST['rePassword']);
									if($newUser->resetPassword($username,$valPassword,$conn->conn)){
										$_SESSION['password_reset'] ="Account password reset successfully";
										header("Location: login");
									}else{
										$displayError = "Password could not be reset please try again";
									}
							}else{
								$displayError = "Please Check confirmation password";
							}
					}else{
						$displayError = "Invalid Password";
					}
				}else{
					$displayError = "Invalid Password";
				}
		}
		/*Display of error message to user*/
		if($displayError<>""){
			header("Location: password_reset_final?errorCode={$displayError}");
		}
}else{
	header("Location: register");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Reset your password</title>
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
									<li class="menu__item menu__item--current"><a href="login" class="menu__link"><span class="menu__helper">Login</span></a></li>
									<li class="menu__item"><a href="register" class="menu__link"><span class="menu__helper">Register</span></a></li>
									<li class="menu__item"><a href="contact" class="menu__link"><span class="menu__helper">Contact</span></a></li>
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
	<!--banner-->
		<div class="banner1">
		<div class="container">
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Password Reset</span></h3>
		</div>
	</div>
	<!--banner-->
<!--signin-->
			<div class="login-grids">
						<div class="login">
							<div class="login-right">
							    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="register">
									<h3>Reset your account password</h3>
									<?php
										 if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']<>""){
											 $displayError = htmlentities($_REQUEST['errorCode']);
											 $error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
												$error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
												echo $error;
										 }
									?>
									<input type="password" name="valPassword" placeholder="new password" id="valPassword" autofocus />
									<input type="password" name="rePassword" placeholder="retype password" />
									<div class="single-bottom">
								   	   <input type="submit" value="Change Password" name="submit">
									</div>
							   </form>
						</div>
					</div>
				<!-- <p>By logging in you agree to our <a href="#">Terms</a> and <a href="#">Conditions</a> and <a href="#">Privacy Policy</a></p> -->
			</div>
		<!--signin-->
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
