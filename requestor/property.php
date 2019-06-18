<?php
session_start();
$username = NULL;
$profile_url = NULL;
$fullpath = "../upload/";
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
$total_request = 0;
$profile_picture_result_set = requestor::get_profile_url($userid,$conn->conn);
if(is_array($profile_picture_result_set)){
	$display_flag =true;
	$profile_url = $profile_picture_result_set['profilePicture'];
	$fullpath .= $profile_url;
	$requestor_id_resultset = requestor::get_requestor_id($userid,$conn->conn);
	$requestor_id =  $requestor_id_resultset['id'];
	$total_request = (requestor::get_total_request($requestor_id,$conn->conn)>0)?requestor::get_total_request($requestor_id,$conn->conn):0;
}else{
	$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
	header("Location profile?w_code=0X004F&hash_code=$hash_code");
}
// ?>
<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Customer Home Page</title>
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
							<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">Bai Bureh Road, Freetown, Sierra Leone.</a>
						</div>
						<div class="deatils">
							<ul>
								<li><?php echo ($display_flag==true)?"<img src='".$fullpath."'class='img img-responsive img-circle'/>":'<img src="../images/avatar.png"  class="img img-responsive img-circle"/>'; ?></li>
								<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href='#' data-href='logout' data-toggle='modal' data-target='#logoutmodal'>Logout <?php echo $username; ?></a></li>
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
				                    <li class="menu__item menu__item--current"><a href="property" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-search"></span> Property Search</span></a></li>
				                    <li class="menu__item"><a href="request" class="menu__link"><span class="menu__helper"><span class="glyphicon glyphicon-briefcase"></span>  Requests <span class="badge badge-primary"><?php echo $total_request; ?></span></a></li>
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
				<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Property</span></h3>
			</div>
		</div>
	<!--banner-->
	<!-- Property Search -->
  <div class="content">
		<div class="serach-w3agile">
			<div class="container">
      <form action="property" method="get">
				<h3 class="tittle">Search properties</h3>
				<div class="place-grids">
					<div class="col-md-2 place-grid">
						<h5>City</h5>
						<select class="sel" name="city">
							<option value="">All Cities</option>
				              <?php
				              $query =  "select * from city order by name";
				              if($conn->checkQuery($query)){
				                $result = $conn->executeQuery($query);
				                $count =  $conn->showAffectedRows();
				                for($i=0;$i<$count;$i++){
				                  $row = mysqli_fetch_array($result);
				                  $id = $row['id'];
				                  $name =$row['name'];
				                  echo  "<option value='{$id}'>{$name}</option><br />";
				                }
				              }
				              ?>
						</select>
					</div>
					<div class="col-md-2 place-grid">
						<h5>District</h5>
						<select class="sel" name="district">
							<option value="">All Districts</option>
				              <?php
				              $query =  "select * from district order by name";
				              if($conn->checkQuery($query)){
				                $result = $conn->executeQuery($query);
				                $count =  $conn->showAffectedRows();
				                for($i=0;$i<$count;$i++){
				                  $row = mysqli_fetch_array($result);
				                  $id = $row['id'];
				                  $name =$row['name'];
				                  echo  "<option value='{$id}'>{$name}</option><br />";
				                }
				              }
				              ?>
						</select>
					</div>
					<div class="col-md-2 place-grid">
						<h5>Beds</h5>
						<select class="sel" name="bed">
							<option value="">any</option>
							<?php
				                for ($i=1; $i <11 ; $i++) {
				                  echo "<option value='{$i}'>$i</option>";
				                }
				              ?>
						</select>
					</div>
					<div class="col-md-2 place-grid">
						<h5>Property Status</h5>
						<select class="sel" name = "propertystatus">
							<option value="">any</option>
				              <?php
				              $query =  "select * from propertystatus order by name";
				              if($conn->checkQuery($query)){
				                $result = $conn->executeQuery($query);
				                $count =  $conn->showAffectedRows();
				                for($i=0;$i<$count;$i++){
				                  $row = mysqli_fetch_array($result);
				                  $id = $row['id'];
				                  $name =$row['name'];
				                  echo  "<option value='{$id}'>{$name}</option><br />";
				                }
				              }
				              ?>
						</select>
					</div>
					<div class="col-md-2 place-grid">
						<h5>Property Type</h5>
						<select class="sel" name="propertytype">
							<option value="">All Type</option>
				              <?php
				              $query =  "select * from propertytype order by name";
				              if($conn->checkQuery($query)){
				                $result = $conn->executeQuery($query);
				                $count =  $conn->showAffectedRows();
				                for($i=0;$i<$count;$i++){
				                  $row = mysqli_fetch_array($result);
				                  $id = $row['id'];
				                  $name =$row['name'];
				                  echo  "<option value='{$id}'>{$name}</option><br />";
				                }
				              }
				              ?>
						</select>
					</div>
					<div class="col-md-2 place-grid">
							<input type="submit" value="Search" name="submit">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	<!-- End of property search form -->
	<div class="popular-w3">
			<div class="container">
				<?php echo (!isset($_REQUEST['submit']))?'<h2 class="tittle">List of recently added property</h2>':''; ?>
				<?php echo (isset($_REQUEST['submit']))?'<h2 class="tittle">Property Search Result(s)</h2>':''; ?>
				<div class="popular-grids">
				<?php
				$display = NULL;
				$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
				$query =  "SELECT p.railtorID,p.id AS property_id,p.description,p.propertyPhoto,p.area,p.bath,p.bed,p.parking,p.cost,pt.name AS propertytype,c.name AS city,CONCAT(ra.firstName,' ',ra.middleName,' ',ra.lastName) AS fullname,u.email,ra.tel FROM property AS p LEFT JOIN city AS c ON c.id = p.cityID LEFT JOIN railtor AS ra ON ra.id = p.railtorID LEFT JOIN estate.user AS u ON u.id =ra.userID LEFT JOIN propertytype AS pt ON pt.id = p.propertytype ORDER BY post_date LIMIT 0,3";
	              if($conn->checkQuery($query)){
	                $result = $conn->executeQuery($query);
	                $count =  $conn->showAffectedRows();
	                for($i=0;$i<$count;$i++){
	                  $row = mysqli_fetch_array($result);
	                  $fullname = $row['fullname'];
	                  $city = $row['city'];
	                  $bed = $row['bed'];
	                  $email = $row['email'];
	                  $description = $row['description'];
	                  $bath = $row['bath'];
	                  $cost = $row['cost'];
	                  $parking = $row['parking'];
	                  $area = $row['area'];
	                  $tel = $row['tel'];
	                  $photopath = "../upload/".$row['propertyPhoto'];
	                  $propertytype = $row['propertytype'];
	                  $railtor_id = $row['railtorID'];
	                  $property_id = $row['property_id'];
	                  //print_r($row);
					$display .= <<< EOF
					<div class="col-md-4 popular-grid">
										<h4>Posted by: $fullname</h4>
										<img src="$photopath" class="img-responsive" alt="Image not available"/>
										<div class="popular-text">
											<h5>Owner Email: $email </h5>
											<a href="property_view?r_id=$railtor_id&p_id=$property_id&p_token=$hash_code" class="button">View details</a>
											<div class="detail-bottom">
												<p>$description</p>
												<ul>
													<li class="text-info">Property Type :</li>
													<li class="text-info1">$propertytype</li>
													<div class="clearfix"></div>
												</ul>
                        <ul>
													<li class="text-info">Price</li>
													<li class="text-info1">$cost</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Sq Ft</li>
													<li class="text-info1">$area</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Baths</li>
													<li class="text-info1">$bath</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Beds</li>
													<li class="text-info1">$bed</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Parking</li>
													<li class="text-info1">$parking</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">City / Town</li>
													<li class="text-info1">$city</li>
													<div class="clearfix"></div>
												</ul>
											</div>
										</div>
									</div>
EOF;
}
}

if(!isset($_REQUEST['submit'])){
	echo $display;
}else{
	$query =  "SELECT p.railtorID,p.id AS property_id,
	p.description,p.propertyPhoto,p.area,
	p.bath,p.bed,p.parking,p.cost,pt.name AS propertytype,
	c.name AS city,CONCAT(ra.firstName,' ',ra.lastName,' ',ra.lastName) AS fullname,
	u.email,ra.tel FROM property AS p LEFT JOIN city AS c ON c.id = p.cityID
	LEFT JOIN railtor AS ra ON ra.id = p.railtorID
	LEFT JOIN estate.user AS u ON u.id =ra.userID
	LEFT JOIN district AS d ON d.id = p.districtID
	LEFT JOIN propertystatus AS ps ON ps.id = p.propertyStatus
	LEFT JOIN region AS re ON re.id = p.regionID
	LEFT JOIN propertytype AS pt ON pt.id = p.propertytype ";
	$filter =" WHERE ";
	$query_flag = false;
	$sanitizer =  new sanitizer();
	if(isset($_REQUEST['city']) AND !empty($_REQUEST['city'])){
		$city_id =  $sanitizer->sanitize($_REQUEST['city']);
		$filter .= "p.cityID = '$city_id' AND ";
		$query_flag = true;
	}
	if(isset($_REQUEST['district']) AND !empty($_REQUEST['district'])){
		$district_id =  $sanitizer->sanitize($_REQUEST['district']);
		$filter .= "p.districtID = '$district_id' AND ";
		$query_flag = true;
	}
	if(isset($_REQUEST['bed']) AND !empty($_REQUEST['bed'])){
		$bed =  $sanitizer->sanitize($_REQUEST['bed']);
		$filter .= "p.bed = '$bed' AND ";
		$query_flag = true;
	}
	if(isset($_REQUEST['propertystatus']) AND !empty($_REQUEST['propertystatus'])){
		$propertystatus =  $sanitizer->sanitize($_REQUEST['propertystatus']);
		$filter .= "p.propertyStatus = '$propertystatus' AND ";
		$query_flag = true;
	}
	if(isset($_REQUEST['propertytype']) AND !empty($_REQUEST['propertytype'])){
		$propertytype =  $sanitizer->sanitize($_REQUEST['propertytype']);
		$filter .= "p.propertytype = '$propertytype' AND ";
		$query_flag = true;
	}
	if(!$query_flag){
    $filter .=" 1=1 ORDER BY p.post_date";
	}else{
	 $filter .=" 1=1 ORDER BY p.post_date";
	}
	$search_display = NULL;
	$query_builder = $query.$filter;
	if($conn->checkQuery($query_builder)){
	                $result = $conn->executeQuery($query_builder);
	                $count =  $conn->showAffectedRows();
	                for($i=0;$i<$count;$i++){
	                  $row = mysqli_fetch_array($result);
	                  $fullname = $row['fullname'];
	                  $city = $row['city'];
	                  $bed = $row['bed'];
	                  $email = $row['email'];
	                  $description = $row['description'];
	                  $bath = $row['bath'];
	                  $cost = $row['cost'];
	                  $parking = $row['parking'];
	                  $area = $row['area'];
	                  $tel = $row['tel'];
	                  $photopath = "../upload/".$row['propertyPhoto'];
	                  $propertytype = $row['propertytype'];
	                  $railtor_id = $row['railtorID'];
	                  $property_id = $row['property_id'];
	                  //print_r($row);
					$search_display .= <<< EOF
					<div class="col-md-4 popular-grid">
										<h4>Posted by: $fullname</h4>
										<img src="$photopath" class="img-responsive" alt="Image not available"/>
										<div class="popular-text">
											<h5>Owner Email: $email </h5>
											<a href="property_view?r_id=$railtor_id&p_id=$property_id&p_token=$hash_code" class="button">Le $cost</a>
											<div class="detail-bottom">
												<p>$description</p>
												<ul>
													<li class="text-info">Property Type :</li>
													<li class="text-info1">$propertytype</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Sq Ft</li>
													<li class="text-info1">$area</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Baths</li>
													<li class="text-info1">$bath</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Beds</li>
													<li class="text-info1">$bed</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Parking</li>
													<li class="text-info1">$parking</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">City / Town</li>
													<li class="text-info1">$city</li>
													<div class="clearfix"></div>
												</ul>
											</div>
										</div>
									</div>
EOF;
}
}
echo $search_display;
}
?>
					<div class="clearfix"></div>
				</div>

			<div class="popular-grids">
				<?php
				$display = NULL;
				$hash_code =  hash("ripemd128", mt_rand(1000000,9999999));
				$query =  "SELECT p.railtorID,p.id AS property_id,p.description,p.propertyPhoto,p.area,p.bath,p.bed,p.parking,p.cost,pt.name AS propertytype,c.name AS city,CONCAT(ra.firstName,' ',ra.lastName,' ',ra.lastName) AS fullname,u.email,ra.tel FROM property AS p LEFT JOIN city AS c ON c.id = p.cityID LEFT JOIN railtor AS ra ON ra.id = p.railtorID LEFT JOIN estate.user AS u ON u.id =ra.userID LEFT JOIN propertytype AS pt ON pt.id = p.propertytype ORDER BY post_date LIMIT 3,3";
	              if($conn->checkQuery($query)){
	                $result = $conn->executeQuery($query);
	                $count =  $conn->showAffectedRows();
	                for($i=0;$i<$count;$i++){
	                  $row = mysqli_fetch_array($result);
	                  $fullname = $row['fullname'];
	                  $city = $row['city'];
	                  $bed = $row['bed'];
	                  $email = $row['email'];
	                  $description = $row['description'];
	                  $bath = $row['bath'];
	                  $cost = $row['cost'];
	                  $parking = $row['parking'];
	                  $area = $row['area'];
	                  $tel = $row['tel'];
	                  $photopath = "../upload/".$row['propertyPhoto'];
	                  $propertytype = $row['propertytype'];
	                  $railtor_id = $row['railtorID'];
	                  $property_id = $row['property_id'];
	                  //print_r($row);
					$display .= <<< EOF
					<div class="col-md-4 popular-grid">
										<h4>Posted by: $fullname</h4>
										<img src="$photopath" class="img-responsive" alt="Image not available"/>
										<div class="popular-text">
											<h5>Owner Email: $email </h5>
											<a href="property_view?r_id=$railtor_id&p_id=$property_id&p_token=$hash_code" class="button">Le $cost</a>
											<div class="detail-bottom">
												<p>$description</p>
												<ul>
													<li class="text-info">Property Type :</li>
													<li class="text-info1">$propertytype</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Sq Ft</li>
													<li class="text-info1">$area</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Baths</li>
													<li class="text-info1">$bath</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Beds</li>
													<li class="text-info1">$bed</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">Parking</li>
													<li class="text-info1">$parking</li>
													<div class="clearfix"></div>
												</ul>
												<ul>
													<li class="text-info">City / Town</li>
													<li class="text-info1">$city</li>
													<div class="clearfix"></div>
												</ul>
											</div>
										</div>
									</div>
EOF;
}
}
if(!isset($_REQUEST['submit'])){
    echo $display;
}
?>
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
		<!--popular-->
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
