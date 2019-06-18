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
<title>Online Real Estate Application::Homepage</title>
<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--css-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link href="css/fallback.css" rel="stylesheet" type="text/css" media="all" />
<!--js-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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
									<li class="menu__item menu__item--current"><a href="index" class="menu__link"><span class="menu__helper">Home</span></a></li>
									<li class="menu__item"><a href="about" class="menu__link"><span class="menu__helper">About</span></a></li>
									<!-- <li class="menu__item"><a href="property" class="menu__link"><span class="menu__helper">Property Search</span></a></li> -->
									<li class="menu__item"><a href="login" class="menu__link"><span class="menu__helper">Login</span></a></li>
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
	<!--header-->
	<!--banner-->
		<div class="banner-section">
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides" id="slider">
					<li>
					  <img src="images/ba1.jpg" alt="">
					 <div class="caption">
						<h3>Bringing your dream home to your doorstep today</h3>
						<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknowns.</p> -->
					 </div>
					</li>
					<li>
					  <img src="images/ba2.jpg" alt="">
						<div class="caption">
						<h3>Acquire your home with just a click!</h3>
						<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknowns.</p> -->
					</div>
					</li><li>
					  <img src="images/ba3.jpg" alt="">
						<div class="caption">
						<h3>Always available 24/7</h3>
						<!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknowns.</p> -->
					</div>
					</li>
				</ul>
		  </div>
	  </div>
	</div>
	<!--banner-->
	<!-- <div class="content">
		<div class="serach-w3agile"> -->
			<!-- <div class="container">
      <form action="#" method="post">
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
							<input type="submit" value="Search">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div> -->
    <!-- End of property search form -->
		<div class="popular-w3">
			<div class="container">
				<h2 class="tittle">Recently posted Items</h2>
				<div class="popular-grids">
						<?php
				$display = NULL;
				$photopath = "upload/";
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
	                  $photopath = "upload/".$row['propertyPhoto'];
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
											<a href="requestor/property_view?r_id=$railtor_id&p_id=$property_id&p_token=$hash_code" class="button">Le $cost</a>
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
echo $display;
?>
					<!-- <div class="col-md-4 popular-grid">
						<h4>Excepteur sint</h4>
						<img src="images/a.jpg" class="img-responsive" alt=""/>
						<div class="popular-text">
							<h5>Lorem ipsum dolor </h5>
							<a href="property_view?p_id=123&token=Kjas3" class="button">$5000</a>
							<div class="detail-bottom">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
								<ul>
									<li class="text-info">Property Type :</li>
									<li class="text-info1">Apartment</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Sq Ft</li>
									<li class="text-info1">05</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Baths</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Beds</li>
									<li class="text-info1">04</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Parking</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">City / Town</li>
									<li class="text-info1">USA</li>
									<div class="clearfix"></div>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-4 popular-grid">
						<h4>Corporis Suscipit</h4>
						<img src="images/a1.jpg" class="img-responsive" alt=""/>
						<div class="popular-text">
							<h5>Lorem ipsum dolor </h5>
							<a href="property_view?p_id=123&token=Kjas3" class="button">$5000</a>
							<div class="detail-bottom">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
								<ul>
									<li class="text-info">Property Type :</li>
									<li class="text-info1">Office</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Sq Ft</li>
									<li class="text-info1">04</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Baths</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Beds</li>
									<li class="text-info1">04</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Parking</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">City / Town</li>
									<li class="text-info1">UK</li>
									<div class="clearfix"></div>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-4 popular-grid">
						<h4>Excepteur sint</h4>
						<img src="images/a2.jpg" class="img-responsive" alt=""/>
						<div class="popular-text">
							<h5>Lorem ipsum dolor </h5>
							<a href="property_view?p_id=123&token=Kjas3" class="button">$5000</a>
							<div class="detail-bottom">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et...</p>
								<ul>
									<li class="text-info">Property Type : </li>
									<li class="text-info1">Villa</li>
									<div class="clearfix"></div>
								</ul><ul>
									<li class="text-info">Sq Ft</li>
									<li class="text-info1">04</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Baths</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Beds</li>
									<li class="text-info1">04</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">Parking</li>
									<li class="text-info1">03</li>
									<div class="clearfix"></div>
								</ul>
								<ul>
									<li class="text-info">City / Town</li>
									<li class="text-info1">USA</li>
									<div class="clearfix"></div>
								</ul>
							</div>
						</div>
					</div> -->
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!--popular-->
		<!--high properties-->
			<div class="properties-w3ls">
				<div class="container">
					<div class="properties-grids">
						<div class="col-md-6 properties-grid">
							<div id="owl-demo" class="owl-carousel">
								<div class="item">
									<img src="images/p1.jpg" class="img-responsive" alt=""/>
								</div>
								<div class="item">
									<img src="images/p2.jpg" class="img-responsive" alt=""/>
								</div>
								<div class="item">
									<img src="images/p3.jpg" class="img-responsive" alt=""/>
								</div>
							</div>
						</div>
						<div class="col-md-6 properties-grid1">
							<h3 class="tittle">Premium Properties</h3>
							<div class="care">
								<div class="left-grid">
										<p>01</p>
								</div>
								<div class="right-grid">
									<h4>Coastal Beach Resort</h4>
									<!-- <p>Donec sagittis interdum tellus sed bibendum. Aen ean fringilla ut lacus eu vehicula. Curabitur non nibh quis nisi vestibulum aliquet ..</p> -->
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="care">
								<div class="left-grid">
									<p>02</p>
								</div>
								<div class="right-grid">
									<h4>Inland Villa</h4>
									<!-- <p>Donec sagittis interdum tellus sed bibendum. Aen ean fringilla ut lacus eu vehicula. Curabitur non nibh quis nisi vestibulum aliquet ..</p> -->
								</div>
								<div class="clearfix"></div>
							</div>

						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!--high properties-->
		<!--featured-->
			<div class="featured-w3l">
				<div class="container">
					<h3 class="tittle1">Our Services</h3>
					<div class="feature-grids">
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-home" aria-hidden="true"></i>
							</div>
								<h4> Real Estate Property Search</h4>
								<p>With our application, you can find the largest list of real estate in Sierra Leone at anytime and anywhere with ease.</p>
						</div>
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-signal" aria-hidden="true"></i>
							</div>
							<h4>Connecting Requestors & Railtors</h4>
								<p>We provide the medium for Requestors and Railtors to easily meet and do real estate business transactions in a more rationalized and efficient routine.</p>
						</div>
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-cog" aria-hidden="true"></i>
							</div>
								<h4>Property placement Automation</h4>
								<p>We provide Railtors with the opportunity to upload images and videos of their real estate which makes our application an automated altinative for the placement of their properties.</p>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="feature-grids">
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-globe" aria-hidden="true"></i>
							</div>
								<h4>Digital Convergence</h4>
								<p>We contribute grately in the reduction of barriers between sectors, so that the real estate busuness in Sierra Leone have new oppoerunities and customer benefit from greater choice and accessabbility.</p>
						</div>
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-signal" aria-hidden="true"></i>
							</div>
							<h4>Deep database Search</h4>
								<p>Our users, especially the Requestors can do a profound search on the available properties in our database and this help them to look through the available real estate and have a better choice of place.</p>
						</div>
						<div class="col-md-4 fer-grid">
							<div class="icons">
								<i class="glyphicon glyphicon-cog" aria-hidden="true"></i>
							</div>
								<h4>Product Optimization</h4>
								<p>Our system provides users with the functionality to make changes or adjustment on the properties they upload for better attraction and more profit.</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!--featured-->
		<!--Testimonial-->
			<div class="testimonials-w3l">
				<div class="container">
					<h3 class="tittle1">Testimonials</h3>
					<div class="testimonial-grids">
						<div class="col-md-6 test-grid">
							<div class="col-md-4 test-left">
								<img src="images/t1.jpg" class="img-responsive" alt=""/>
							</div>
							<div class="col-md-8 test-right">
								<p>The Online Real Estate Application is really good and i do appreciate it a lot. I was looking for a place to let in Freetown but i found it difficult to access one for morethan two weeks. My friend told me to visit this site and i did. I am currently residing at a nice house in Brookfields and i really like it. I got this awesome place through this medium. Thanks very much for the initiative.</p>
								<h5>Amid C Jalloh</h5>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-6 test-grid">
							<div class="col-md-4 test-left">
								<img src="images/t2.jpg" class="img-responsive" alt=""/>
							</div>
							<div class="col-md-8 test-right">
								<p>I can't believe i bought a house for my family in Sierra Leone via the internet. This real estate application is realy good and i am so happy that such developments are happening in my beloved nation Sierra Leone. I will tell all my friends here in Canada to visit this site if they want to do any real estate transaction. Bravo to the developers for such an amazing work done. Sierra Leoneans can do it better.</p>
								<h5>Jariatu Kargbo</h5>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!--End of first testimonials-->
				</div>
			</div>
		<!--Testimonial-->
	</div>

				<!--copy-->
<?php
	include_once("lib/_footer.php");
?>
</body>
</html>
