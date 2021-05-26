
<?php
   include 'include/header.php';

?>
<?php
    $ct = new cart();
  // $login_check = Session::get('customer_login');
  // if ($login_check==false) {
  //   header('Location:login.php');
  // }

?>
<?php
    $cart = new cart();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $cartId = $_POST['cartId'];
        $update_quantity_cart = $ct->update_quantity_cart($cartId, $quantity); // gọi đến hàm trong class
        if ($quantity<=0) {
        	 $delProductCart = $cart->delete_product_cart($cartId); 
        }
    }
    if (isset($_GET['cartId'])){
        $cartId = $_GET['cartId'];
        $delProductCart = $cart->delete_product_cart($cartId); 

    }
?>
<?php
  if (!isset($_GET['id'])) {
  	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
  }
?>
	
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Hành động</th>
							</tr>
							<?php
                            $get_product_cart = $ct->get_product_cart();
                            if ($get_product_cart) {
                            	$subtotal = 0;
                            	$qty = 0;
                            	while ($result = $get_product_cart->fetch_assoc()) {
                            
							?>
							<tr>
								<td><?php echo $result['productName']?></td>
								<td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
								<td><?php echo number_format($result['price'])." "."VNĐ"?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']?>" min="0"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php
                                 $total = $result['price'] * $result['quantity'];
                                 echo number_format($total)." "."VNĐ";
								?></td>
								<td><a onclick="return confirm('Are you want to delete?')" href="?cartId=<?php echo $result['cartId']?>">Xóa</a></td>
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
						
						<table style="float:right;text-align:left;" width="40%">
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
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<?php
							   	$login_check = Session::get('customer_login');
							   	if ($login_check==false) {
							   		echo '<a href="login.php"><button class="dangnhap" style="
												    font-size: 2rem;												   
												    border-radius: .5rem;
												    background: orange;
												    color: #fff;
												    width: 230px;
												    height: 50px;
												    cursor: pointer;
													border:none;
													box-shadow: 0px 4px #888888;													
													font-size:22px;
													font-weight:bold;													
													margin: 1rem 0 1rem 8rem;
												">Login</button></a></div>
											<span style="margin-left:10rem;">Đăng nhập để thanh toán</span>';
							   	}else {
							        echo '<a href="payment.php"><img src="images/check.png" alt="" />';
							    }
							?>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
  include 'include/footer.php';
?>
