<?php
session_start();
$username = NULL;
$profile_url = NULL;
$fullpath = "../upload/";
$property_picture_path = "../upload/";
if(isset($_SESSION['requestorAuthorization']) && !empty($_SESSION['requestorAuthorization'])){
    $username = $_SESSION['currentUser'];
  }else{
  header('location: ../login.php?errorCode=Authentication required, you must login first to access this page!');
}
if(file_exists("../lib/library.class.php")){
  include_once("../lib/library.class.php");
}else{
  //die("<script> alert('File not found');</script>");
}
$result_set = requestor::getUserID($username,$conn->conn);
$userid = $result_set['id'];
$display_flag = false;
$requestor_id = NULL;
$total_request = 0;
$profile_picture_result_set = requestor::get_profile_url($userid,$conn->conn);
if(is_array($profile_picture_result_set)){
	$display_flag =true;
	$profile_url = $profile_picture_result_set['profilePicture'];
	$fullpath .= $profile_url;
	$requestor_id_resultset =  requestor::get_requestor_id($userid,$conn->conn);
	$requestor_id = $requestor_id_resultset['id'];
	$total_request = (requestor::get_total_request($requestor_id,$conn->conn)>0)?requestor::get_total_request($requestor_id,$conn->conn):0;
}else{
	$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
	header("Location profile?w_code=0X004F&hash_code=$hash_code");
}
$sanitizer =  new sanitizer();
$property_display_flag = false;
$railtor_id=NULL;
$p_id = NULL;
if( (isset($_REQUEST['r_id'])&&!empty($_REQUEST['r_id'])) && (isset($_REQUEST['p_id'])&&!empty($_REQUEST['p_id']))){
  $p_id = $sanitizer->sanitize($_REQUEST['p_id']);
  $railtor_id = $sanitizer->sanitize($_REQUEST['r_id']);
  $property_resultset = estate_property::retrieve_property_display($p_id,$railtor_id,$conn->conn);
  if(count($property_resultset)!=0){
    //print_r($property_resultset);
    $property_display_flag = true;
   $property_picture_path .= $property_resultset['propertyPhoto'];
   $date_output = strtotime($property_resultset['post_date']);
    $date_output = date('l jS \of F Y h:i:s A',$date_output);
  }

}else{
  header("Location:request");
}
// ?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Customer Profile</title>
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
					<div class="head-top customer-top">
						<div class="indicate">
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">University of Makeni.</a>
						</div>
						<div class="deatils">
							<ul>
								<li> <?php echo ($display_flag==true)?"<img src='".$fullpath."'class='img img-responsive img-circle'/>":'<img src="../images/avatar.png"  class="img img-responsive img-circle"/>'; ?></li>
								<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href='#' data-href='logout' data-toggle='modal' data-target='#logoutmodal'>Logout <?php echo $username; ?></a></li>
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
                  					<li class="menu__item"><a href="property" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-search"></span> Property Search</span></a></li>
                  					<li class="menu__item menu__item--current"><a href="request" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-briefcase"></span>  Requests <span class="badge badge-primary"><?php echo $total_request; ?></span></a></li>
                  					<!-- <li class="menu__item"><a href="setting" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-wrench"></span> Settings</span></a></li> -->
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Property Preview</span></h3>
		</div>
	</div>
	<!--banner-->
	<!--Template body-->
  <!-- Start of single property view -->
	<div class="container">
    <div class="popular-grids single">

					<div class="col-md-12 popular-grid">
						<h4>Posted By: <?php echo ($property_display_flag==true)?$property_resultset['fullname']:"N/A"; ?></h4>
						<?php echo ($property_display_flag==true)?"<img src='".$property_picture_path."'class='img-responsive pull-right'/>":'<img src="../images/a1.jpg"  class="img-responsive pull-right"/>'; ?>

						<div class="popular-text pull-left">
							<a href="#" class="button">Le<?php echo ($property_display_flag==true)?$property_resultset['cost']:"N/A"; ?> </a>
							<div class="detail-bottom">
								<p><?php echo ($property_display_flag==true)?$property_resultset['description']:"N/A"; ?></p>
								<ul>
									<li class="text-info">Property Type :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['propertytype']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Property Status :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['propertystatus']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Email :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['email']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Sq Ft</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['area']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Baths</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['bath']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Beds</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['bed']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Parking</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['parking']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<!-- <ul>
									<li class="text-info">Cost :</li>
									<li class="text-info1">$30.00</li>
									<div class="clearfix"></div>
								</ul> -->
								<ul>
									<li class="text-info">City / Town</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['city']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">District :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['district']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Region :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['region']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Owner Contact Information :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$property_resultset['tel']:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Date Posted :</li>
									<li class="text-info1"><?php echo ($property_display_flag==true)?$date_output:"N/A"; ?></li>
									<div class="clearfix"></div>
								</ul>
								<button class="button btn-primary" data-toggle='modal' data-target='#property_request' id="send-request">Request</button>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
				</div>
		</div>
 <!-- End of single property -->
<!--copy-->
	<!--End of template-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("../lib/_footer_inner.php");
	include_once("bin/property_request_modal.php");
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
		$('#logoutmodal').on('show.bs.modal', function(e) {
	     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	     });
		$('#send-request').click(function(){
                    //$('#feedback').append('a');
                    $.post('process_request.php', {requestor_id: "<?php echo $requestor_id; ?>",railtor_id: "<?php echo $railtor_id; ?>",property_id: "<?php echo $p_id; ?>"},
                        function(result){
                            $('#result').html(result).show();
                        });
              });
		});
	</script>
</html>
