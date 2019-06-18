<?php
if(file_exists("lib/library.class.php")){
  include_once("lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Register with us today for free!</title>
<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fallback.css" rel="stylesheet" type="text/css" media="all" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript">
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
 function hideURLbar(){ window.scrollTo(0,1); }
</script>
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
									<li class="menu__item menu__item--current"><a href="register" class="menu__link"><span class="menu__helper">Register</span></a></li>
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Register</span></h3>
		</div>
	</div>
	<!--banner-->
	<div class="login-grids">
		<div class="login">
			<div class="login-right">
				<form action="bin/register" method="post" id="register">
					<h3>Register </h3>
					<div class="errorMessage">
						<?php
								if(isset($_REQUEST['errorCode']) && $_REQUEST['errorCode']<>""){
									$displayError = htmlentities($_REQUEST['errorCode']);
									$error = "<div class='alert alert-danger noprint'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
                  $error .= "<strong>Error Message<br /></strong>{$displayError}</div>";
                  echo $error;
								}
						 ?>
					</div>
					<input type="text" name="Name" placeholder="Username" autocomplete="on" autofocus="true">
					<select name="UserType" id="userType" class="sel">
					<option value="">Select Account Type</option>
						<option value="1">Requestor</option>
						<option value="2">Railtor</option>
					</select>
					<input type="text" name="valPhone" placeholder="Mobile number" autocomplete="on">
					<input type="text" name="Email" placeholder="Email id" autocomplete="on">
					<input type="password" name="valPassword" placeholder="Password" id="valPassword">
					<input type="password" name="rePassword" placeholder=" Retype Password">
					<select class="sel" name="question">
						<option value="">--Select your security question--</option>
						<?php
						$query =  "select * from security order by question";
						if($conn->checkQuery($query)){
							$result = $conn->executeQuery($query);
							$count =  $conn->showAffectedRows();
							for($i=0;$i<$count;$i++){
								$row = mysqli_fetch_array($result);
								$id = $row['id'];
								$name =$row['question'];
								echo  "<option value='{$id}'>{$name}</option><br />";
							}
						}
						?>
					</select>
					<input type="text" name="response" placeholder="Answere here" autocomplete="on">
					<h4><a href="login">Already have an account login?</a></h4>
					<input type="submit" value="Register Now"name="submit" >
				</form>
			</div>
		<div class="clearfix"></div>
	  </div>
		<p>By Registering, you agree to our <a href="#">Terms</a> and <a href="#">Conditions</a> and <a href="#">Privacy Policy</a></p>
</div>
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
