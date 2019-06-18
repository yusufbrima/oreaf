<!DOCTYPE html>
<html>
<head>
<title>Online Real Estate Application::Template</title>
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
									<li class="menu__item"><a href="property" class="menu__link"><span class="menu__helper">Property Search</span></a></li>
									<li class="menu__item"><a href="login" class="menu__link"><span class="menu__helper">Login</span></a></li>
									<li class="menu__item menu__item--current"><a href="register" class="menu__link"><span class="menu__helper">Register</span></a></li>
									<li class="menu__item"><a href="contact" class="menu__link"><span class="menu__helper">Contact</span></a></li>
								</ul>
							</nav>
								<div class="social-icons">
									<a href="#"><i class="icon"></i></a>
									<a href="#"><i class="icon1"></i></a>
									<a href="#"><i class="icon2"></i></a>
									<a href="#"><i class="icon3"></i></a>
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
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s"><a href="index">Home</a> / <span>Template</span></h3>
		</div>
	</div>
	<div>
		<button class="btn btn-primary" data-toggle='modal' data-target='#templatemodal' id="send-request">Send Request</button>
	</div>
		<div id="templatemodal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span style='Color:red;'>&times;</span></button>
			        <h4 class="modal-title">Test Modal</h4>
			      </div>
			      <div class="modal-body">
			      	Test Modal Dialog
			       <div id="result"></div>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <a class="btn btn-danger btn-ok">Ok</a>
			      </div>
			    </div>
			  </div>
			  <?php $id = 3; 
			  ?>
	</div><!--End of modal dialog -->
	<!--banner-->
	<!--Template body-->
	<!--End of template-->
<!--copy-->
<!--Website Footer Information-->
<?php
	include_once("lib/_footer.php");
?>
</body>
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
		//$('#result').load('include/job_title_search.php').show();
              $('#send-request').click(function(){
                    //$('#feedback').append('a');
                    $.post('test.php', {msg: "<?php echo $id; ?>",id: "<?php echo $id; ?>",pass: "<?php echo $id; ?>"},
                        function(result){
                            $('#result').html(result).show();
                        });
              });
		});

	</script>
</html>
