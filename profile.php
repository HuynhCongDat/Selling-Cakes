<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
<?php
   $cus = new customer();
   $login_check = session::get('customer_login');
   if ($login_check == false) {
   	  header('Location:login.php');
   }
?>
<?php 
   // if (!isset($_GET['productid']) || isset($_GET['productid']) == NULL){
   //      echo "<script>window.location = '404.php'</script>";   
   //  }else {
   //      $id = $_GET['productid'];
   //  }
   //  $product = new product();
   //  $ct = new cart();
   //  $cat = new category();

   //  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
   //      $quantity = $_POST['quantity'];
   //      $addtocart = $ct->add_to_cart($quantity, $id); // gọi đến hàm trong class
   //  }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
				<div class="heading">
				<h3>Thông tin khách hàng</h3>
				</div>
				<div class="clear"></div>
		    </div>
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
<?php
   include 'include/footer.php';
?>

