<?php
session_start();
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<!--css-->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/fallback.css" rel="stylesheet" type="text/css" media="all" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" />
</head>
<body>
	<!--header-->
	<div class="header" id="home">
		<div class="header-top">
				<div class="container">
					<div class="head-top">
						<div class="indicate">
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">University of Makeni.</a>
						</div>
						<div class="deatils">
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="logo">
						<h1><a href="../index">Online Real Estate System <span>Admin Control Panel</span></a></h1>
					</div>
				</div>
			</div>

		<div class="container">
			<div class="header-bottom">

			</div>
		</div>

	</div>
<!--signin-->
			<div class="login-grids" style="width:90%">
						<div class="login" style="margin:20px auto;width:45%;height:300px;">
							<div class="login-right">
							    <form action="index" method="post" id="login">
									<h3>Admin Login Panel</h3>
									<?php
										if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
										 	if($_REQUEST['e_code']=="0X00E0"){
												$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
												$Success .= "<strong>Error Message<br /></strong>*Username field is required</div>";
												echo $Success;
										     }
										}
										if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
										 	if($_REQUEST['e_code']=="0X00E1"){
												$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
												$Success .= "<strong>Error Message<br /></strong>*Password field is required</div>";
												echo $Success;
										     }
										}
										if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
										 	if($_REQUEST['e_code']=="0X01E0"){
												$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
												$Success .= "<strong>Error Message<br /></strong>Login failed, username or password did not match</div>";
												echo $Success;
										     }
										}
										 if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
											 	if($_REQUEST['e_code']=="0X00EE"){
													$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
													$Success .= "<strong>Error Message<br /></strong>Authentication required, you must login first to access this page!</div>";
													echo $Success;
											     }
											}
									?>
									<!-- Successful registration message  -->
									<div><input type="text" name="Username" placeholder="Enter your username" value=""></div>
									<div><input type="password" name="valPassword" placeholder="Password"></div>
									<div>
										<input type="submit" value="Sign In" name="submit" >
									</div>
							   </form>
							   <?php
							   		if(isset($_REQUEST['submit'])){
						              $validate =  new sanitizer();
						              $displayError_Code = "";
						               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
						               if($validate->validate($_REQUEST['Username'])){
						               	  if($validate->validate($_REQUEST['Username'])){
						               	      $username = $validate->transform($validate->sanitize(trim($_REQUEST['Username'])));
						               	      $password = $validate->sanitize(trim($_REQUEST['valPassword']));
						               	       if(admin::login($username,$password,$conn->conn)){
						               	       		if(is_array(admin::retrieve_record($username,$conn->conn))){
						               	       			$result_set = admin::retrieve_record($username,$conn->conn);
						               	       			$_SESSION['profile_url'] = $result_set['profilePicture'];
						               	       			$_SESSION['user_id'] = $result_set['id'];
						               	       			$_SESSION['admin_user'] = $_REQUEST['Username'];
							               	       		$_SESSION['token'] = $hash_code;
							               	       		sanitizer::location("dashboard");
						               	       		}

						               	       }else{
						               	       		$displayError_Code = "0X01E0";
	                                         		sanitizer::location("index?e_code=$displayError_Code&t_token=$hash_code");
						               	       }
							               }else{
							               	$displayError_Code = "0X00E1";
	                                         sanitizer::location("index?e_code=$displayError_Code&t_token=$hash_code");
							               }
						               }else{
						               	$displayError_Code = "0X00E0";
                                         sanitizer::location("index?e_code=$displayError_Code&t_token=$hash_code");
						               }
						             }
							   ?>
						</div>
					</div>
			</div>
		<!--signin-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("lib/_footer.php");
?>
</body>
<!--js-->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<?php include_once('script.php');  ?>
<!--js-->
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,700italic,700,600italic,600,400italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--webfonts-->
<script src="../js/responsiveslides.min.js"></script>
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
  <link href="../css/owl.carousel.css" rel="stylesheet">
<script src="../js/owl.carousel.js"></script>
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
