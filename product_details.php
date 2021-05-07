
 <?php include('header.php'); ?>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.css">

<style type="text/css">
  

/*****************globals*************/
body {
  font-family: 'open sans';
  overflow-x: hidden; }

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #f5f5f5;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #d10024; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #d10024;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #d10024; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */

</style>

<?php 
        $id=$_REQUEST['id']; 

          $query="SELECT * FROM `inv_products` where id='$id' ";
          $res=mysqli_query($con,$query);
          $i=1;
          $row=mysqli_fetch_assoc($res);
?>


  <div class="container">
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">
            
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img style="width:unset !important;max-height: 500px !important;" src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" /></div>
              <?php if($row['product_image_name2']!='') {?>
              <div class="tab-pane" id="pic-2"><img style="width:unset !important;max-height: 500px !important;" src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name2'];?>" /></div>
              <?php }?>
              <?php if($row['product_image_name3']!='') {?>
              <div class="tab-pane" id="pic-3"><img style="width:unset !important;max-height: 500px !important;" src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name3'];?>" /></div>
              <?php }?>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
              <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name1'];?>" /></a></li>
              <?php if($row['product_image_name2']!='') {?>
              <li><a data-target="#pic-2" data-toggle="tab"><img src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name2'];?>" /></a></li>
              <?php }?>
              <?php if($row['product_image_name3']!='') {?>
              <li><a data-target="#pic-3" data-toggle="tab"><img src="upload_folder/product/<?php echo $row['id'];?>/<?php echo $row['product_image_name3'];?>" /></a></li>
              <?php }?>
             
            </ul>
            
          </div>
          <div class="details col-md-6">
            <h3 class="product-title"><?php echo $row['product_name'];?></h3>
            <div class="rating">
              <div class="stars">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
              </div>
<!--               <span class="review-no">41 reviews</span>
 -->            </div>
            <p class="product-description"><?php echo $row['product_desc']?></p>
            <h4 class="price">current price:<span><?php echo (($row['product_price'])-($row['product_price']/$row['product_discount'])) ?></span> <del style="color: #b1aeae;" class="price"><?php echo $row['product_price']; ?></del></h4>
<!--             <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
 -->            


            <div class="action">
            <?php if(user_login_check()!=0) {?>
            <a href="UserController/user_cart_action.php?id=<?php echo $row['id'];?>" style="padding: 5px 30px;" class="add-to-cart btn btn-default"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
            <?php } else { ?>
            <a href="login.php" style="padding: 5px 30px;" class="add-to-cart btn btn-default"><i style="line-height: 25px;" class="fa fa-shopping-cart"></i> add to cart</a>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
$('.ql-editor').attr('contenteditable', 'false');
$('.ql-hidden').remove();
});

</script>

<?php include('footer.php'); ?>