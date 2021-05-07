
<?php include('UserController/user_common_function.php');?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Inventory Management System</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>


	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<!-- <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li> -->
					</ul>
					<ul class="header-links pull-right">
						<!-- <li><a href="#"><i class="fa fa-dollar"></i> INR</a></li> -->
						<?php if(user_login_check()!=0) {?>
						<li><a href=""><i class="fa fa-user-o"></i> My Account</a></li>
						<li><a href="UserController/user_logout_action.php"><i class="fa fa-user-o"></i> Logout</a></li>
						<?php } else { ?>
						<li><a href="login.php"><i class="fa fa-user-o"></i> Login</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
								<h1 style="color: #fff">Inventory Management System</h1>
									<!-- <img src="./img/logo.png" alt=""> -->
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="product_search.php" method="GET">
									<select name="search_cat" style="width: 150px;" class="input-select">
									  <option value="0">All Categories</option>
									<?php
									$query="SELECT * FROM `inv_product_categories`";
									$res=mysqli_query($con,$query);
									$i=1;
										while($row=mysqli_fetch_assoc($res))
									{ ?>
									  <option value="<?php echo $row['id'];?>">
									  <?php echo $row['product_cat_name'];?>
									  </option>
									<?php $i++; } ?>
									</select>
									<input class="input" name="search_keyword" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<!-- <div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div> -->
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
								<?php if(isset($_COOKIE['INV_USERID']))
								    $inv_user_login_id=trim($_COOKIE['INV_USERID']);
								  else
								    $inv_user_login_id='0';
								  if($inv_user_login_id!='0')
								  {
								    $inv_user_login_id=base64_decode($inv_user_login_id);
								    ?>
									<a href="cart.php">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<?php
									$query_catr_count="SELECT * FROM `inv_cart` where cart_user_id='$inv_user_login_id' and cart_status='1'";
									$res_catr_count=mysqli_query($con,$query_catr_count);
									$cart_count=mysqlI_num_rows($res_catr_count);
									?>
										<div class="qty"><?php echo $cart_count; ?></div>
									</a>
								   <?php } else { ?>
								   <a href="login.php">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
									</a>
								   <?php }?>
									<!-- <div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div> -->
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
					<li ><a href="index.php">Home</a></li>

					<?php
					$query="SELECT * FROM `inv_product_categories`";
					$res=mysqli_query($con,$query);
					$i=1;
						while($row=mysqli_fetch_assoc($res))
					{ ?>
						<li><a 
						<?php if($i==1) { ?> class="active" <?php } ?> href="product_categories?id=<?php echo $row['id'];?>">
						<?php echo $row['product_cat_name'];?>
						</a></li>
						<?php $i++; } ?>

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->