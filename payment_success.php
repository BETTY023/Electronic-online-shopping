
 <?php include('header.php'); ?>

<div class="container login_form">
    <div class="row" style=" text-align: center;margin: 10px 0px;">
<h2 style="color: forestgreen;">Payment Successful</h2>

<div class="col-sm-12" style="margin: 50px 0px;" id="printDiv">
            <table class="table table-hover" id="myTable" style="width:100%;border: solid 1px #dddddd;">
                <thead>
                    <tr>
                        <th class="text-left">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th class="text-center"> </th>
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
                    $query="select c.id as order_id,c.order_user_id,c.order_quantity,c.order_price,p.id as pro_id,p.product_price,p.product_cat_id,p.product_discount,p.product_name,p.product_image_name1 from inv_order c inner join inv_products p on c.order_product_id = p.id where c.order_status='1' and c.order_user_id='$inv_user_login_id' order by c.id desc";

                    $res=mysqli_query($con,$query);
                    $num_row=mysqli_num_rows($res);
                    if($num_row>0)
                    {
                    $i=1;
                    while($row=mysqli_fetch_assoc($res))
                    { ?>

                    <tr id="<?php echo $row['pro_id'];?>">
                        <td class="col-sm-8 col-md-6" style="text-align: left">
                        <?php echo $row['product_name'];?>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <?php $product_price=round((($row['product_price'])-($row['product_price']/$row['product_discount'])),2) ?>

                        <?php echo $row['order_quantity'];?>
                        </td>

                        <td class="col-sm-1 col-md-1 text-center">₹<strong id="product_price_<?php echo $row['pro_id'];?>"><?php echo $product_price;?></strong></td>

                        <?php $tot_price=round(($row['order_quantity'] * $product_price),2);?>
                        <td class="col-sm-1 col-md-1 text-center">₹<strong class="product_tot_price" id="product_tot_price_<?php echo $row['pro_id'];?>"><?php echo $tot_price;?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        </td>
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
                        </td>
                        <td>
                         
                       </td>
                    </tr>
                    <?php } else { ?> <td colspan="4"> Empty record</td><?php } } else {?>

                    <td colspan="4"> Empty record</td> <?php } ?> 
                </tbody>

            </table>
        </div>

<div class="col-sm-12">
<a href="login.php" style="background-color: #d10024;border-color: #d10024;" class="btn btn-danger">
    Cacel
 </a>
 <button style="background-color: #5aaf3f;border-color: #5aaf3f;" onclick="printDiv()" class="btn btn-danger">
    Print Bill
 </button>
</div>

<div>
</div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
  
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
</script>
<script type="text/javascript">
  
  function printDiv() {
    var DocumentContainer = document.getElementById('printDiv');
    var WindowObject = window.open();
    var strHtml = "<html>\n<head>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"test.css\">\n</head><body><div style=\"testStyle\">\n" + DocumentContainer.innerHTML + "\n</div>\n</body>\n</html>";
    WindowObject.document.writeln(strHtml);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();

}
</script>

<?php include('footer.php'); ?>