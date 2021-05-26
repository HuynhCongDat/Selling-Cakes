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
   
   //  $product = new product();
   //  $ct = new cart();
   //  $cat = new category();

   //  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
   //      $quantity = $_POST['quantity'];
   //      $addtocart = $ct->add_to_cart($quantity, $id); // gọi đến hàm trong class
   //  }
?>
<?php
 $ct = new cart();
?>
<form action="" method="post">
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="heading">
				<h3>Thanh toán offline</h3>
			</div>
			<div class="clear"></div>
			<div class="box_left">
				<div class="cartpage">
			    	<h2>Giỏ hàng của bạn</h2>
				    <?php
				    if (isset($update_quantity_cart)) {
				    	echo $update_quantity_cart;
				    }
				    ?>	
				    <?php
				    if (isset($delProductCart)) {
				    	echo $delProductCart;
				    }
				    ?>
						<table class="tblone">
							<tr>
								<th width="5%">STT</th>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
							</tr>
							<?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                            	$subtotal = 0;
                            	$qty = 0;
                            	$i =0;
                            	while ($result = $get_product_cart->fetch_assoc()) {
                            		$i++;
                            
							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo number_format($result['price'])." "."VNĐ"?></td>
								<td>
									<?php echo $result['quantity']?>
								</td>
								<td><?php
                                 $total = $result['price'] * $result['quantity'];
                                 echo number_format($total)." "."VNĐ";
								?></td>
							</tr>
							
							<?php
                             	    $subtotal += $total;
                             	    $qty = $qty + $result['quantity'];
                            	}
                            }
							?>
							
						</table>
						<?php
						$check_cart = $cart->check_cart();
								if ($check_cart) {
						?>
						
						<table style="float:right;text-align:left; border: 1px solid #666;" width="40%">
							<tr>
								<th>Tổng giá : </th>
								<td><?php

                                   echo number_format($subtotal)." "."VNĐ";
                                   // Session::set("sum",$subtotal);
                                   Session::set("qty",$qty);
								?></td>
							</tr>
							<tr>
								<th>Phí vận chuyển : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Thành tiền :</th>
								<td><?php
                                 $vat = $subtotal * 0.1;
                                 $grandtotal = $subtotal + $vat;
                                 echo number_format($grandtotal)." "."VNĐ";
								?></td>
							</tr>
					   </table>
					   <?php
					   }else {
					   	echo 'Your cart is empty! Please shopping now';
					   }
					   ?>
					</div>
			</div>
			<div class="box_right">
				    		<table class="tblone">
    			<?php
    			$id = session::get('customer_id');
    			$get_customer = $cus->show_customer($id);
    			if ($get_customer) {
    				while ($result = $get_customer->fetch_assoc()) {
    		
    			?>
    			<tr>
    				<td>Name</td>
    				<td>:</td>
    			    <td><?php echo $result['cusName']?></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
    			    <td><?php echo $result['city']?></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
    			    <td><?php echo $result['phone']?></td>
    			</tr>
    			<tr>
    				<td>Country</td>
    				<td>:</td>
    			    <td><?php echo $result['country']?></td>
    			</tr>
    			<tr>
    				<td>Zip-code</td>
    				<td>:</td>
    			    <td><?php echo $result['zipcode']?></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
    			    <td><?php echo $result['email']?></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td>:</td>
    			    <td><?php echo $result['address']?></td>
    			</tr>
    			<tr>
    				<td colspan="3"><a href="editprofile.php">Update profile</a></td>
    			</tr>
    			<?php

    				}
    			}
    			?>
    		</table>
			</div>
 		</div>
 	</div>
 	<center><a href="?orderid=order" class="a_order">Order Now</a></center><br>

</div>
 </form>
<?php
   include 'include/footer.php';
?>

	