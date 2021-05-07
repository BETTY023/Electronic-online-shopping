
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
    <div class="row">
<?php
 if(isset($_GET["msg"]))
  $msg=$_GET["msg"];
else
  $msg=0;

if($msg==1)
{?>
<div class="alert alert-danger" role="alert">
      Mandatory field is missing!
  </div>
<?php }
elseif($msg==2)
{ ?>
<div class="alert alert-danger" role="alert">
      Payment failed!
  </div>
<?php }
?>


<?php

 if(isset($_COOKIE['INV_USERID']))
    $inv_user_login_id=trim($_COOKIE['INV_USERID']);
  else
    $inv_user_login_id='0';
  if($inv_user_login_id!='0')
  {
    $inv_user_login_id=base64_decode($inv_user_login_id);

  $query="select c.id as cart_id,c.cart_user_id,c.cart_quantity,c.cart_price,p.id as pro_id,p.product_price,p.product_cat_id,p.product_discount,p.product_name,p.product_image_name1 from inv_cart c inner join inv_products p on c.cart_product_id = p.id where c.cart_status='1' and c.cart_user_id='$inv_user_login_id' order by c.id desc";

  $res=mysqli_query($con,$query);
  $i=1;$grand_total_amount=99;
  while($row=mysqli_fetch_assoc($res))
  { 
  $product_price=round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2);
  $tot_price=round(($row['cart_quantity'] * $product_price),2);

    $grand_total_amount=$grand_total_amount+$tot_price;

  } ?>
<div>
  <form style="padding: 30px;" method="post" class="modal-content" action="UserController/bank_account.php">
      <h1>Payment</h1>
      <hr>
      <label for="bank_name"><b>Amount</b></label>
      <input type="text"  value="₹<?php echo $grand_total_amount;?>" readonly>

      <label for="bank_name"><b>Bank Name</b></label>
      <input type="text" placeholder="Enter Bank Name" name="bank_name" required>

      <label for="account_number"><b>Account Number</b></label>
      <input type="text" placeholder="Enter Account Number" name="account_number" required>

      <label for="bank_name"><b>IFSC Code</b></label>
      <input type="text" placeholder="Enter IFSC Code" name="ifsc_code" required>

      <label for="bank_name"><b>Branch</b></label>
      <input type="text" placeholder="Enter Branch" name="branch" required>


      <div class="clearfix login_button">
        <a style="text-align: center;" href="cart.php" class="cancelbtn">Cancel</a>
        <button type="submit" class="signupbtn">Submit</button>
      </div>
  </form>
</div>
<?php } ?>
</div>
</div>

<script type="text/javascript">
  

</script>

<?php include('footer.php'); ?>