
 <?php include('header.php'); ?>

		

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->

				<?php

					 $query="select pc.product_cat_name,pc.id as cat_id,p.id as pro_id,p.product_image_name1 from inv_product_categories pc inner join inv_products p on pc.id = p.product_cat_id where  pc.product_cat_status='1' group by p.product_cat_id order by pc.id desc limit 3";
					$res=mysqli_query($con,$query);
					$i=1;
						while($row=mysqli_fetch_assoc($res))
					{ ?>
						<div class="col-md-4 col-xs-6">
							<div class="shop">
								<div class="shop-img" style="text-align: center;">
									<img style="width:unset !important;max-height:270px !important;" src="upload_folder/product/<?php echo $row['pro_id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
								</div>
								<div class="shop-body">
									<h3><?php echo $row['product_cat_name'];?></h3>
									<a href="product_categories?id=<?php echo $row['cat_id'];?>" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
					<?php $i++; } ?>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<!-- <div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab1">Cameras</a></li>
									<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
								</ul>
							</div> -->
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->

										<?php
										$query="SELECT * FROM `inv_products` order by id desc limit 10";
										$res=mysqli_query($con,$query);
										$i=1;
											while($row=mysqli_fetch_assoc($res))
										{ ?>

										<div class="product">
											<div class="product-img" style="text-align: center;">
												<img style="width:unset !important;max-height: 180px !important;display: initial;"  src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
												<div class="product-label">
													<span class="sale">-<?php echo $row['product_discount']; ?>%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo get_product_category_name($row['product_cat_id']);?></p>
												  <?php if (strlen($row['product_name']) > 75)
							                                $str = substr($row['product_name'], 0, 75) . '...';
							                              else
							                                $str=$row['product_name'];
							                              ?>

                       						 <h3 style="min-height: 60px;" class="product-name"><a href="product_details.php?id=<?php echo $row['id'];?>"><?php echo $str; ?></a></h3>
												<h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2) ?> <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star checked"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												
											</div>
											<div class="add-to-cart">
												<?php if(user_login_check()!=0) {?>
                        <a href="UserController/user_cart_action.php?id=<?php echo $row['id'];?>" style="padding: 5px 30px;" class="add-to-cart-btn"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
                        <?php } else { ?>
                        <a href="login.php" style="padding: 5px 30px;" class="add-to-cart-btn"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
                        <?php } ?>
											</div>
										</div>
										<?php } ?>
										<!-- /product -->

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Days</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Hours</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Mins</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Secs</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">hot deal this week</h2>
							<p>New Collection Up to 50% OFF</p>
							<a class="primary-btn cta-btn" href="#">Shop now</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
							<div class="section-nav">
								<!-- <ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
									<li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
									<li><a data-toggle="tab" href="#tab2">Cameras</a></li>
									<li><a data-toggle="tab" href="#tab2">Accessories</a></li>
								</ul> -->
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">

						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<!-- product -->

										<?php

										$query="select c.id as cart_id,c.cart_user_id,c.cart_quantity,c.cart_price,p.id as pro_id,p.product_price,p.product_cat_id,p.product_discount,p.product_name,p.product_image_name1,c.cart_product_id,count(c.cart_product_id) as max_sale_pro from inv_cart c inner join inv_products p on c.cart_product_id = p.id where c.cart_status='2' group by c.cart_product_id order by p.id desc limit 10";
										$res=mysqli_query($con,$query);
										$i=1;
											while($row=mysqli_fetch_assoc($res))
										{ ?>

										<div class="product">
											<div class="product-img" style="text-align: center;">
												<img style="width:unset !important;max-height: 180px !important;display: initial;"  src="upload_folder/product/<?php echo $row['pro_id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
												<div class="product-label">
													<span class="sale">-<?php echo $row['product_discount']; ?>%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo get_product_category_name($row['product_cat_id']);?></p>
												  <?php if (strlen($row['product_name']) > 75)
					                                $str = substr($row['product_name'], 0, 75) . '...';
					                              else
					                                $str=$row['product_name'];
					                              ?>

                        						<h3 style="min-height: 60px;" class="product-name"><a href="product_details.php?id=<?php echo $row['pro_id'];?>"><?php echo $str; ?></a></h3>
												<h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2); ?>
												 <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<!-- <div class="product-btns">
													<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
													<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
												</div> -->
											</div>
											<div class="add-to-cart">
												<?php if(user_login_check()!=0) {?>
							                        <a href="UserController/user_cart_action.php?id=<?php echo $row['pro_id'];?>" style="padding: 5px 30px;" class="add-to-cart-btn"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
							                        <?php } else { ?>
							                        <a href="login.php" style="padding: 5px 30px;" class="add-to-cart-btn"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
							                        <?php } ?>
											</div>
										</div>
										<?php } ?>
										<!-- /product -->

										
										
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Under ₹4999</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
							<?php

							$query="SELECT * FROM `inv_products` where product_price<='4999' order by id desc LIMIT 3 OFFSET 0";
							$res=mysqli_query($con,$query);
							$i=1;
							 while($row=mysqli_fetch_assoc($res))
							 { ?>

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img" style="text-align: center;overflow: hidden;">
										<img style="width:unset !important;max-height: 60px !important;"  src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo get_product_category_name($row['product_cat_id']);?></p>
										 <?php if (strlen($row['product_name']) > 35)
				                                $str = substr($row['product_name'], 0, 35) . '...';
				                              else
				                                $str=$row['product_name'];
				                              ?>
										<h3 class="product-name"><a href="product_details.php?id=<?php echo $row['id'];?>"><?php echo $str; ?></a></h3>
										<h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2); ?>
												 <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
									</div>
								</div>
								<!-- /product widget -->
								<?php } ?>


							</div>

						
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Under ₹9999</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div>
							<?php

							$query="SELECT * FROM `inv_products` where product_price BETWEEN 4999 AND 9999 order by id desc LIMIT 3 OFFSET 0";
							$res=mysqli_query($con,$query);
							$i=1;
							 while($row=mysqli_fetch_assoc($res))
							 { ?>

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img" style="text-align: center;overflow: hidden;">
										<img style="width:unset !important;max-height: 60px !important;" src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo get_product_category_name($row['product_cat_id']);?></p>
										 <?php if (strlen($row['product_name']) > 35)
				                                $str = substr($row['product_name'], 0, 35) . '...';
				                              else
				                                $str=$row['product_name'];
				                              ?>
										<h3 class="product-name"><a href="product_details.php?id=<?php echo $row['id'];?>"><?php echo $str; ?></a></h3>
										<h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2); ?>
												 <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
									</div>
								</div>
								<!-- /product widget -->
								<?php } ?>


							
						</div>
					</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Under ₹19999</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<?php



							$query="SELECT * FROM `inv_products` where product_price BETWEEN 9999 AND 19999 order by id desc LIMIT 3 OFFSET 0";
							$res=mysqli_query($con,$query);
							$i=1;
							 while($row=mysqli_fetch_assoc($res))
							 { ?>

								<!-- product widget -->
								<div class="product-widget">
									<div class="product-img" style="text-align: center;overflow: hidden;">
										<img style="width:unset !important;max-height: 60px !important;" src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo get_product_category_name($row['product_cat_id']);?></p>
										 <?php if (strlen($row['product_name']) > 35)
				                                $str = substr($row['product_name'], 0, 35) . '...';
				                              else
				                                $str=$row['product_name'];
				                              ?>
										<h3 class="product-name"><a href="product_details.php?id=<?php echo $row['id'];?>"><?php echo $str; ?></a></h3>
										<h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2); ?>
												 <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
									</div>
								</div>
								<!-- /product widget -->
								<?php } ?>

						
						</div>
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<!-- <div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		  <?php include('footer.php'); ?>