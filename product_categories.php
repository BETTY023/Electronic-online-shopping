
 <?php include('header.php'); ?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
.login_button button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  opacity: 0.9;
}

.login_button button:hover {
  opacity:1;
}

.login_button a {
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  opacity: 0.9;
}
/* Extra styles for the cancel button */
.login_button .cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.login_button .cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.login_form {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<div class="container login_form">
    <div class="row" style="margin-bottom: 30px;">
<?php $id=$_REQUEST['id']; ?>

            <h3 style="text-align: center;"><?php echo get_product_category_name($id);?></h3>
<?php

          $query="SELECT * FROM `inv_products` where product_cat_id='$id' order by id";
          $res=mysqli_query($con,$query);
          $num_rows=mysqli_num_rows($res);
          if($num_rows>0)
          {
          $i=1;
            while($row=mysqli_fetch_assoc($res))
          { ?>
                  <div class="col-md-4 product" style="padding: 60px">
                      <div class="product-img" style="text-align: center;">
                        <img style="width:unset !important;height: 180px !important;"  src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" alt="">
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
                        <h4 class="product-price"><?php echo round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2); ?> <del class="product-old-price"><?php echo $row['product_price']; ?></del></h4>
                        <div class="product-rating">
                          <i class="fa fa-star"></i>
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
        <?php } } else {?>
              <div class="col-md-4" > No record found</div>
        <?php } ?>


<div>
</div>
</div>
</div>

<script type="text/javascript">
  

</script>

<?php include('footer.php'); ?>