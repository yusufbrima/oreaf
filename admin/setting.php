<?php
session_start();
$username = NULL;
$profile_url = NULL;
$fullpath = "../upload/";
if(isset($_SESSION['admin_user']) && !empty($_SESSION['admin_user'])){
    $username = $_SESSION['admin_user'];
    $profile_url = $_SESSION['profile_url'];
    $fullpath .= $profile_url;
    $user_id = $_SESSION['user_id'];
  }else{
  header('location: index?e_code=0X00EE');
}
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  ///die("<script> alert('File not found');</script>");
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Admin Dashboard</title>
<!--css-->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" />
<link href="../css/fallback.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<!--header-->
	<div class="header" id="home">
		<div class="header-top">
				<div class="container">
					<div class="head-top">
						<div class="indicate">
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">University Of Makeni.</a>
						</div>
						<div class="deatils">
							<ul>
								<li> <?php echo isset($_SESSION['profile_url'])?"<img src='".$fullpath."'class='img img-responsive img-circle'/>":'<img src="../images/avatar.png"  class="img img-responsive img-circle"/>'; ?></li>
								<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href='#' data-href='logout' data-toggle='modal' data-target='#logoutmodal'>Logout <span> <?php echo isset($username)?$username:""; ?></span></a></li>
								<!-- <li><i class="glyphicon glyphicon-user" aria-hidden="true"></i><a href="register">User profile</a></li> -->
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="logo">
						<h1><a href="dashboard">Online Real <span>Estate Application</span></a></h1>
					</div>
				</div>
			</div><!--End of top menu-->
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
									<li class="menu__item"><a href="dashboard" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-tasks"></span> Dashboard</span></a></li>
									<li class="menu__item"><a href="profile" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-user"></span> Profile</span></a></li>
									<li class="menu__item"><a href="mg_user" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-user-group"></span> Manage Users</a></li>
									<li class="menu__item menu__item--current"><a href="setting" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-wrench"></span> Settings</span></a></li>
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="dashboard">Home</a> / <span>User Management</span></h3>
		</div>
	</div>
	<!--banner-->
	<!--Template body-->
	   <!-- Start of single profile view -->
	<div class="container">
		<table class="table table-striped" border="0">
			<caption class="h3">List of Admin Users <a href='#' data-href='post?q=hello' data-toggle='modal' data-target='#new_admin_modal'><button class="btn btn-success pull-right">Add User</button></a></caption>
			<tbody>
				<?php
				if(isset($_REQUEST['flag'])AND !empty($_REQUEST['flag'])){
					$Success = "<div class='alert alert-success noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
					$Success .= "<strong>Transaction Report<br /></strong>Account removed successfully</div>";
					echo $Success;
					}
				 if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
					 	if($_REQUEST['e_code']=="0X00E7"){
							$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
							$Success .= "<strong>Error Message<br /></strong>User account name already exists</div>";
							echo $Success;
					     }
					}
					if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
					 	if($_REQUEST['e_code']=="0X00EE"){
							$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
							$Success .= "<strong>Error Message<br /></strong>Problem creating account...Try again later</div>";
							echo $Success;
					     }
					}
					if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
					 	if($_REQUEST['e_code']=="0X00E0"){
							$Success = "<div class='alert alert-danger noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
							$Success .= "<strong>Error Message<br /></strong>Error uploading file</div>";
							echo $Success;
					     }
					}
				 if(isset($_REQUEST['s_code'])AND !empty($_REQUEST['s_code'])){
					  if($_REQUEST['s_code']=="0X00F1"){
					  	$Success = "<div class='alert alert-success noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
						$Success .= "<strong>Transaction Report<br /></strong>Account added successfully</div>";
						echo $Success;
					  }
					}
				?>
				<tr><th>Full Name</th><th>Username</th><th>Email</th><th>Join Date</th></tr>
				<!-- <tr><td>Justin Smith</td><td>Lordadam</td><td>lordadam@gmakflsd.com</td><td>Tuesday 29th of August 2017 08:18:05 AM <a href="#" data-href="mg_user?u_id=1233&c_f=HlNHLJs44" data-toggle="modal" data-target="#delete_admin_modal"><span class="glyphicon glyphicon-trash"></span></a></td></tr> -->
				<?php
						$query =  "SELECT id,username,concat(firstname,' ',lastname) AS f_name,join_date,email FROM superuser ORDER BY join_date";
						if($conn->checkQuery($query)){
							$result = $conn->executeQuery($query);
							$count =  $conn->showAffectedRows();
							for($i=0;$i<$count;$i++){
								$row = mysqli_fetch_array($result);
								//print_r($row);
							    $date_output = strtotime($row['join_date']);
      							$date_output = date('l jS \of F Y h:i:s A',$date_output);
      							$username = $row['username'];
      							$email = $row['email'];
      							$fullName =  $row['f_name'];
      							$userid = $row['id'];
      							echo "<tr><td>$fullName</td><td>$username</td><td>$email</td><td>$date_output <a href=\"#\" data-href=\"setting?u_id=$userid&c_f=HlNHLJs44\" data-toggle=\"modal\" data-target=\"#delete_admin_modal\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>";
      						}
						}
				  ?>
			</tbody>
		</table>
    </div>
 <!-- End of single profile -->
	<!--End of template-->
<!--Website Footer Information-->
<?php
	include_once("../lib/_footer_inner_admin.php");
	include_once("lib/delete_admin_modal.php");
	include_once("lib/new_admin_modal.php");
	include_once("lib/logout_modal.php");
?>
</body>
<!--js-->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<?php
   require_once("script.php");
?>
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
		$('#delete_admin_modal').on('show.bs.modal', function(e) {
	     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	     });
		$('#logoutmodal').on('show.bs.modal', function(e) {
	     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	     });
		});
	</script>
</html>
