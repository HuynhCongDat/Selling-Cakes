<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
<?php
 if (isset($_GET['orderid']) || isset($_GET['orderid']) == 'orderid'){
        $customer_id = session::get('customer_id');
        $insertOrder = $cart->insert_order($customer_id);
        $delCart = $cart->del_all_data_cart();
        header('Location:success.php');
    }
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<div class="not_found">
					<h3 class="success_order" style="color:green; text-align: center;font-size: 2rem;">Cảm ơn quý khách đã mua hàng ở trang web chúng tôi</h3>
          <?php
            $customer_id = session::get('customer_id');
            $get_amount = $cart->getAmountPrice($customer_id);
            $amount = 0;
            if ($get_amount) {
              while ($result = $get_amount->fetch_assoc()) {
                $price = $result['price'];
                $amount += $price;
                
                
              }              
            }
          ?>
          <p class="success_note">Total Price You Have Bought From My Website: <?php
           $vat = $amount * 0.1; 
           $total = $vat + $amount;
            echo number_format($total).''.'VNĐ';

           ?>
           </p>
          <p class="success_note">We will contact as soon as posible. Please see your order details here <a href="orderdetails.php">Click here</a></p>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
</div>
<?php
  include 'include/footer.php';
?>

