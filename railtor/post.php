<?php
session_start();
$username = NULL;
$profile_url = NULL;
$fullpath = "../upload/";
/*if(!isset($_SESSION['currentUser']) && empty($_SESSION['currentUser'])){*/
  if(isset($_SESSION['railtorAuthorization']) && !empty($_SESSION['railtorAuthorization'])){
    $username = $_SESSION['currentUser'];
  }else{
	header('location: ../login.php?errorCode=Authentication required, you must login first to access this page!');
}
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  die("<script> alert('File not found');</script>");
}
$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
$result_set = railtor::getUserID($username,$conn->conn);
$userid = $result_set['id'];
$railtor_id = NULL;
$display_flag = false;
$total_request = 0;
$total_post  = 0;
$sanitizer =  new sanitizer();
$profile_picture_result_set = railtor::get_profile_url($userid,$conn->conn);
if(is_array($profile_picture_result_set)){
	$display_flag =true;
	$profile_url = $profile_picture_result_set['profilePicture'];
	$fullpath .= $profile_url;
	$result_set_id =  railtor::get_railtor_id($userid,$conn->conn);
	$railtor_id = $result_set_id['id'];
	$total_post = (railtor::get_total_post($railtor_id,$conn->conn)>0)?railtor::get_total_post($railtor_id,$conn->conn):0;
	$total_request = (railtor::get_total_request($railtor_id,$conn->conn)>0)?railtor::get_total_request($railtor_id,$conn->conn):0;
	//print_r($result_set_id);
}else{
	header("Location profile?w_code=0X004F&hash_code=$hash_code");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Posts</title>
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
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">Bai Bureh Road, Freetown, Sierra Leone.</a>
						</div>
						<div class="deatils">
							<ul>
								<li> <?php echo ($display_flag==true)?"<img src='".$fullpath."'class='img img-responsive img-circle'/>":'<img src="../images/avatar.png"  class="img img-responsive img-circle"/>'; ?></li>
								<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href='#' data-href='logout' data-toggle='modal' data-target='#logoutmodal'>Logout <span> <?php echo $username; ?></span></a></li>
								<!-- <li><i class="glyphicon glyphicon-user" aria-hidden="true"></i><a href="register">User profile</a></li> -->
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="logo">
						<h1><a href="index">Online Real <span>Estate Application</span></a></h1>
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
									<li class="menu__item"><a href="index" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-tasks"></span> Dashboard</span></a></li>
									<li class="menu__item"><a href="profile" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-user"></span> Profile</span></a></li>
									<li class="menu__item"><a href="request" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-briefcase"></span> Requests <span class="badge badge-primary"><?php echo $total_request; ?></span></a></li>
									<li class="menu__item menu__item--current"><a href="post" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-envelope"></span> Posts <span class="badge badge-primary"><?php echo $total_post; ?></span></span></a></li>
									<!-- <li class="menu__item"><a href="setting" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li> -->
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Railtor Posts</span></h3>
		</div>
	</div>
	<!--banner-->
	<!--Template body-->
  <div class="login-grids">
    <div class="login">
    	<?php 
    		if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
				if($_REQUEST['e_code']=="0X00E70"){
				$Success = "<div class='alert alert-error noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				$Success .= "<strong>Transaction Report<br /></strong>Record insertion failed</div>";
				echo $Success;
				}
			}
			if(isset($_REQUEST['s_code'])AND !empty($_REQUEST['s_code'])){
				if($_REQUEST['s_code']=="0X00A2"){
				  $Success = "<div class='alert alert-success noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				  $Success .= "<strong>Transaction Report<br /></strong>Property posted successfully</div>";
				  echo $Success;
				}
			}
		  if(isset($_REQUEST['s_code'])AND !empty($_REQUEST['s_code'])){
				if($_REQUEST['s_code']=="0X00A24"){
				  $Success = "<div class='alert alert-success noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				  $Success .= "<strong>Transaction Report<br /></strong>Property updated successfully</div>";
				  echo $Success;
				}
			}
		   if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
				if($_REQUEST['e_code']=="0X00E71"){
				$Success = "<div class='alert alert-error noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				$Success .= "<strong>Transaction Report<br /></strong>Record update failed</div>";
				echo $Success;
				}
			}
			if(isset($_REQUEST['s_code'])AND !empty($_REQUEST['s_code'])){
				if($_REQUEST['s_code']=="0X00A35"){
				  $Success = "<div class='alert alert-success noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				  $Success .= "<strong>Transaction Report<br /></strong>Property removed successfully</div>";
				  echo $Success;
				}
			}
		   if(isset($_REQUEST['e_code'])AND !empty($_REQUEST['e_code'])){
				if($_REQUEST['e_code']=="0X00D43"){
				$Success = "<div class='alert alert-error noprint' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
				$Success .= "<strong>Transaction Report<br /></strong>Record delete failed</div>";
				echo $Success;
				}
			}
    	?>
    	<!-- <form>
             <input type="search" name="postSearch" id="postSearch" value="" placeholder="Search by Posts..." class="form-control">
        </form> -->
      <table class="table table-striped">
         <caption><h1>Posted Items</h1></caption>
         <tbody>
	         <tr><th>ID</th><th>Property Type</th><th>Property Status</th><th>Post Date</th></tr>
	         <?php
				   $query =  "SELECT p.id AS propertyid,r.id AS railtorid,p.post_date,ps.name AS propertystatus,pt.name AS propertytype FROM property AS p LEFT JOIN railtor AS r ON p.railtorID=r.id LEFT JOIN propertystatus AS ps ON p.propertyStatus = ps.id LEFT JOIN propertyType AS pt ON p.propertyType=pt.id WHERE p.railtorID='$railtor_id'; ";
						if($conn->checkQuery($query)){
							$result = $conn->executeQuery($query);
							$count =  $conn->showAffectedRows();
							for($i=0;$i<$count;$i++){
								$row = mysqli_fetch_array($result);
								//print_r($row);	
							    $date_output = strtotime($row['post_date']);
      							$date_output = date('l jS \of F Y h:i:s A',$date_output);
      							$p_id = $row['propertyid'];
      							$railtor_id = $row['railtorid'];
      							$propertytype = $row['propertytype'];
      							$propertystatus  = $row['propertystatus'];
      							echo "<tr><td>$p_id</td><td>$propertytype</td><td>$propertystatus</td><td>$date_output <a href='update_post?p_id=$p_id&r_id=$railtor_id&token=$hash_code'><span class='glyphicon glyphicon-pencil'><!-- Edit -->  </span></a>  <a href='property_view?p_id=$p_id&r_id=$railtor_id&token=$hash_code'><span class='glyphicon glyphicon-eye-open'><!-- View -->  </span></a>  <a href='#' data-href='post?p_id=$p_id&r_id=$railtor_id&token=$hash_code' data-toggle='modal' data-target='#postdelete'><span class='glyphicon glyphicon-trash'></span></a><!-- Delete --></span></a></td></tr>";
      						}
						}
				  ?>
       </tbody>
       <a href='#' data-href='post?q=hello' data-toggle='modal' data-target='#newItemPost'><button class="btn btn-success pull-right">New Post</button></a>
      </table>
    <div class="clearfix"></div>
    </div>
</div>
	<!--End of template-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("../lib/_footer_inner.php");
	include_once("bin/delete_post_modal.php");
	include_once("bin/new_post_modal.php");
	include_once("bin/logout_modal.php");
?>
</body>
<!--js-->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<?php
   require_once("js_script.php");
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
		 $('#postdelete').on('show.bs.modal', function(e) {
	     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	     });
	      $('#logoutmodal').on('show.bs.modal', function(e) {
	     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	     });
		});
	</script>
</html>