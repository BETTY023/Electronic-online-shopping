 <?php include('header.php'); ?>


<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row" style="padding: 50px 0px;">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
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
                    $num_row=mysqli_num_rows($res);
                    if($num_row>0)
                    {
                    $i=1;
                    while($row=mysqli_fetch_assoc($res))
                    { ?>

                    <tr id="<?php echo $row['pro_id'];?>">
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="product_details.php?id=<?php echo $row['pro_id'];?>"> 
                            <?php if($row['product_image_name1']!=''){?>
                            <img class="media-object" src="upload_folder/product/<?php echo $row['pro_id'];?>/<?php echo $row['product_image_name1'];?>" style="width: 72px; height: 72px;"> 
                            <?php } else { ?>
                            <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> 
                            <?php } ?>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="product_details.php?id=<?php echo $row['pro_id'];?>"><?php echo $row['product_name'];?></a></h4>
                                <h5 class="media-heading"> by <a href="product_categories.php?id=<?php echo $row['cart_id'];?>"><?php echo get_product_category_name($row['product_cat_id']);?></a></h5>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <?php $product_price=round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2) ?>

                        <input min="1" onchange="cart_quantity(<?php echo $row['cart_id'];?>,<?php echo $row['pro_id'];?>,<?php echo $product_price;?>)" type="number" class="form-control" id="product_quantity_<?php echo $row['pro_id'];?>" value="<?php echo $row['cart_quantity'];?>">
                        </td>

                        <td class="col-sm-1 col-md-1 text-center">₹<strong id="product_price_<?php echo $row['pro_id'];?>"><?php echo $product_price;?></strong></td>

                        <?php $tot_price=round(($row['cart_quantity'] * $product_price),2);?>
                        <td class="col-sm-1 col-md-1 text-center">₹<strong class="product_tot_price" id="product_tot_price_<?php echo $row['pro_id'];?>"><?php echo $tot_price;?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <a href="UserController/delete_cart_item.php?id=<?php echo $row['cart_id'];?>" type="button" class="btn btn-danger">
                             Remove
                        </a></td>
                    </tr>
                <?php } ?>

                    
    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5>₹<strong id="product_sub_total"></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5>₹<strong id="shipping_charge">99</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3>₹<strong id="grand_total"></strong></h3></td>

                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <a href="index.php" type="button" class="btn btn-default">
                             Continue Shopping
                        </a></td>
                        <td>
                         <form id="form_submit" action="payment.php" method="post">
                         <div id="grand_total_amount"> </div>
                            <button style="background-color: #5aaf3f;border-color: #5aaf3f;" onclick="form_submit()" class="btn btn-danger">
                             Checkout
                            </button>
                        </form>
                       </td>
                    </tr>
                    <?php } else { ?> <td colspan="4"> Empty record</td><?php } } else {?>

                    <td colspan="4"> Empty record</td> <?php } ?> 
                </tbody>

            </table>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    


function cart_quantity(cart_id,pro_id,price) {
   var qty=$('#product_quantity_'+pro_id) .val();
   $('#product_tot_price_'+pro_id).html((qty * price));
   calculate_grand_tot();

$.ajax({ 
        type: "POST",
        url:"UserController/payment.php",
        data: {"cart_id":cart_id, "pro_id":pro_id, "qty":qty},
        dataType: 'json',
        success: function (data)
        {
            if(data!='success')
            {
                alert('Only '+data+' left in stock')
            }


        }
      });

}



$(document).ready(function(){
calculate_grand_tot();
});
 
 function calculate_grand_tot()
 {
 $(document).ready(function() {
            $('table thead th').each(function(i) {
                calculateColumn(i);
            });
            
        });

        function calculateColumn(index) {
            var total = 0;
            $('table tr').each(function() {
                var value = parseInt($('td .product_tot_price', this).eq(index).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#product_sub_total').eq(index).text(total);

            var product_sub_total = parseInt($('#product_sub_total').text());
            var shipping_charge = parseInt($('#shipping_charge').text());
            var grand_total=product_sub_total + shipping_charge;
            $('#grand_total').text(grand_total);
            
        }
}

function calculate_grand_tot1()
 {
 $(document).ready(function() {
            $('table thead th').each(function(i) {
                calculateColumn(i);
            });
            
        });

        function calculateColumn(index) {
            var total = 0;
            $('table tr').each(function() {
                var value = parseInt($('td .product_tot_price', this).eq(index).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#product_sub_total').eq(index).text(total);

            var product_sub_total = parseInt($('#product_sub_total').text());
            var shipping_charge = parseInt($('#shipping_charge').text());
            var grand_total=product_sub_total + shipping_charge;
            $('#grand_total').text(grand_total);
            $('#grand_total_amount').val('<input type="hidden" name="grand_total_amount" value="'+grand_total+'">');
            
        }
}


function form_submit()
{
   $('#form_submit').submit(); 
}

</script>

<?php include('footer.php'); ?>