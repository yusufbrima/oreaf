<?php
session_start();
$username = NULL;
$profile_url = NULL;
$fullpath = "../upload/";
/*if(!isset($_SESSION['currentUser']) && empty($_SESSION['currentUser'])){*/
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
$result_set = railtor::getUserID($username,$conn->conn);
$userid = $result_set['id'];
$display_flag = false;
$total_request = 0;
$total_post  = 0;
$profile_picture_result_set = railtor::get_profile_url($userid,$conn->conn);
if(is_array($profile_picture_result_set)){
  $display_flag =true;
  $profile_url = $profile_picture_result_set['profilePicture'];
  $fullpath .= $profile_url;
  $railtor_id_resultset = railtor::get_railtor_id($userid,$conn->conn);
  $railtor_id = $railtor_id_resultset['id'];
  $total_post = (railtor::get_total_post($railtor_id,$conn->conn)>0)?railtor::get_total_post($railtor_id,$conn->conn):0;
  $total_request = (railtor::get_total_request($railtor_id,$conn->conn)>0)?railtor::get_total_request($railtor_id,$conn->conn):0;
}else{
  $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
  header("Location profile?w_code=0X004F&hash_code=$hash_code");
}
$property_resultset = NULL;
$display_edit_flag = false;
$p_id = NULL;
$railtor_id = NULL;
$sanitizer =  new sanitizer();
if( (isset($_REQUEST['r_id'])&&!empty($_REQUEST['r_id'])) && (isset($_REQUEST['p_id'])&&!empty($_REQUEST['p_id']))){
  $p_id = $sanitizer->sanitize($_REQUEST['p_id']);
  $railtor_id = $sanitizer->sanitize($_REQUEST['r_id']);
  $property_resultset = estate_property::retrieve_property($p_id,$railtor_id,$conn->conn);
  if(is_array($property_resultset)){
    //print_r($property_resultset);
    $display_edit_flag = true;
    $_SESSION['p_id'] =$p_id ;
    $_SESSION['railtor_id'] = $railtor_id;
  }

}else{
  header("Location:post");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Post New Item</title>
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
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">University of Makeni.</a>
						</div>
						<div class="deatils">
							<ul>
								<li> <?php echo ($display_flag==true)?"<img src='".$fullpath."'class='img img-responsive img-circle'/>":'<img src="../images/avatar.png"  class="img img-responsive img-circle"/>'; ?></li>
								<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href='#' data-href='logout' data-toggle='modal' data-target='#logoutmodal'>ogout <span> <?php echo $username; ?></span></a></li>
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Item Post Update</span></h3>
		</div>
	</div>
	<!--banner-->
	<!--Template body-->
  <div class="login-grids">
    <div class="login">
      <div class="login-right">
        <form action="u_process" method="post" id="property_post">
          <h3>Update Record</h3>
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
          <input type="text" name="description" placeholder="Add property description" value="<?php echo ($display_edit_flag)?$property_resultset['description']:""; ?>" autocomplete="on" autofocus="true">
          <input type="number" name="area" placeholder="Square area of property" value="<?php echo ($display_edit_flag)?$property_resultset['area']:""; ?>" min="0" autocomplete="on" />
          <input type="number" name="bath" placeholder="Total bathrooms" value="<?php echo ($display_edit_flag)?$property_resultset['bath']:""; ?>" min="0" autocomplete="on" />
          <input type="number" name="room" placeholder="Number of rooms" value="<?php echo ($display_edit_flag)?$property_resultset['room']:""; ?>" min="0" autocomplete="on" />
          <input type="number" name="bed" placeholder="Number of bedrooms" value="<?php echo ($display_edit_flag)?$property_resultset['bed']:""; ?>" min="0" autocomplete="on" />
          <input type="number" name="parking" placeholder="Parking slot area" value="<?php echo ($display_edit_flag)?$property_resultset['parking']:""; ?>" min="0" autocomplete="on" />
          <input type="number" name="cost" placeholder="Price of property" value="<?php echo ($display_edit_flag)?$property_resultset['cost']:""; ?>" min="0" autocomplete="on" />
          <select class="sel" name = "propertystatus">
              <option value="">--Select property status--</option>
              <?php
              $query =  "select * from propertystatus order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  $selected = isset($property_resultset['propertyStatus'])?$property_resultset['propertyStatus']:"";
                  if($display_edit_flag==true AND $selected== $id){
                     echo  "<option value='{$selected}' selected>{$name}</option><br />";
                  }else{
                     echo  "<option value='{$id}'>{$name}</option><br />";
                  }
                }
              }
              ?>
            </select>
            <select class="sel" name="propertytype">
              <option value="">--Select property type--</option>
              <?php
              $query =  "select * from propertytype order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  $selected = isset($property_resultset['propertyType'])?$property_resultset['propertyType']:"";
                  if($display_edit_flag==true AND $selected== $id){
                     echo  "<option value='{$selected}' selected>{$name}</option><br />";
                  }else{
                     echo  "<option value='{$id}'>{$name}</option><br />";
                  }
                }
              }
              ?>
            </select>
            <select class="sel" name="region">
              <option value="">--Select Region--</option>
              <?php
              $query =  "select * from region order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  $selected = isset($property_resultset['regionID'])?$property_resultset['regionID']:"";
                  if($display_edit_flag==true AND $selected== $id){
                     echo  "<option value='{$selected}' selected>{$name}</option><br />";
                  }else{
                     echo  "<option value='{$id}'>{$name}</option><br />";
                  }
                }
              }
              ?>
            </select>
            <select class="sel" name="district">
              <option value="">--Select District--</option>
              <?php
              $query =  "select * from district order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  $selected = isset($property_resultset['districtID'])?$property_resultset['districtID']:"";
                  if($display_edit_flag==true AND $selected== $id){
                     echo  "<option value='{$selected}' selected>{$name}</option><br />";
                  }else{
                     echo  "<option value='{$id}'>{$name}</option><br />";
                  }
                }
              }
              ?>
            </select>
            <select class="sel" name="city">
              <option value="">--Select City--</option>
              <?php
              $query =  "select * from city order by name";
              if($conn->checkQuery($query)){
                $result = $conn->executeQuery($query);
                $count =  $conn->showAffectedRows();
                for($i=0;$i<$count;$i++){
                  $row = mysqli_fetch_array($result);
                  $id = $row['id'];
                  $name =$row['name'];
                  $selected = isset($property_resultset['cityID'])?$property_resultset['cityID']:"";
                  if($display_edit_flag==true AND $selected== $id){
                     echo  "<option value='{$selected}' selected>{$name}</option><br />";
                  }else{
                     echo  "<option value='{$id}'>{$name}</option><br />";
                  }
                }
              }
              ?>
            </select>
          <div><input type="submit" value="Save"name="submit" ></div>
        </form>
         <?php
             /* if(isset($_REQUEST['submit'])){
                if($displayflag==false){
                  $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
                  header("Location profile?w_code=0X004F&hash_code=$hash_code");
                }
              $validate =  new sanitizer();
              $displayError_Code = "";
               $hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
               if($validate->validate($_REQUEST['description'])){
                  if($validate->validate($_FILES['profile'])){
                   if($validate->validate($_REQUEST['propertystatus'])){
                    if($validate->validate($_REQUEST['propertytype'])){
                        if($validate->validate($_REQUEST['region'])){
                            if($validate->validate($_REQUEST['region'])){
                                if($validate->validate($_REQUEST['district'])){
                                  if($validate->validate($_REQUEST['city'])){
                                      $city = $validate->sanitize(trim($_REQUEST['city']));
                                      $district = $validate->sanitize(trim($_REQUEST['district']));
                                      $region = $validate->sanitize(trim($_REQUEST['region']));
                                      $description = $validate->sanitize(trim($_REQUEST['description']));
                                      $propertystatus = $validate->sanitize(trim($_REQUEST['propertystatus']));
                                      $propertytype = $validate->sanitize(trim($_REQUEST['propertytype']));
                                      $area = isset($_REQUEST['area'])?$validate->sanitize(trim($_REQUEST['area'])):NULL;
                                      $bath = isset($_REQUEST['bath'])?$validate->sanitize(trim($_REQUEST['bath'])):NULL;
                                      $room = isset($_REQUEST['room'])?$validate->sanitize(trim($_REQUEST['room'])):NULL;
                                      $bed = isset($_REQUEST['bed'])?$validate->sanitize(trim($_REQUEST['bed'])):NULL;
                                      $parking = isset($_REQUEST['parking'])?$validate->sanitize(trim($_REQUEST['parking'])):NULL;
                                      $cost = isset($_REQUEST['cost'])?$validate->sanitize(trim($_REQUEST['cost'])):NULL;
                                      if(estate_property::update_property($description,$railtor_id,$area,$bath,$room,$bed,$parking,$cost,$propertystatus,$propertytype,$region,$district,$city,$p_id,$conn->conn)){
                                          $displaySuccess_Code = "0X00A24";
                                          //sanitizer::location("post?s_code=$displaySuccess_Code&t_token=$hash_code");
                                            estate_property::dance();
                                        }else{
                                          $displayError_Code = "0X00E71";
                                          sanitizer::location("post?e_code=$displayError_Code&t_token=$hash_code");
                                        }
                                    }
                              }
                          }
                        }
                    }
                  }
                 }
               }
             }*/
        ?>
      </div>
    <div class="clearfix"></div>
    </div>
</div>
	<!--End of template-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("../lib/_footer_inner.php");
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
    $('#logoutmodal').on('show.bs.modal', function(e) {
       $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
       });
		});
	</script>
</html>
