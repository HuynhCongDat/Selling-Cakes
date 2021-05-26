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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $id = session::get('customer_id');
        $profile_cus = $cus->edit_profile_customer($_POST,$id); // gọi đến hàm trong class
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
  				<div class="heading">
  				<h3>Cập nhật thông tin khách hàng</h3>
  				</div>
  				<div class="clear"></div>
		    </div>
        <form action="" method="post">
    		<table class="tblone">
          <tr>
            
              <?php
              if (isset($profile_cus)) {
                echo '<td colspan="3">'.$profile_cus.'</td>';
              }
              ?>
            
          </tr>
    			<?php
    			$id = session::get('customer_id');
    			$get_customer = $cus->show_customer($id);
    			if ($get_customer) {
    				while ($result = $get_customer->fetch_assoc()) {
    		
    			?>
    			<tr>
    				<td>Name</td>
    				<td>:</td>
            <td><input type="text" name="name" value="<?php echo $result['cusName']?>"></td>
    			</tr>
    			<tr>
    				<td>City</td>
    				<td>:</td>
            <td><input type="text" name="city" value="<?php echo $result['city']?>"></td>
    			</tr>
    			<tr>
    				<td>Phone</td>
    				<td>:</td>
            <td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
    			</tr>
    			<tr>
    				<td>Country</td>
    				<td>:</td>
            <td><input type="text" name="country" value="<?php echo $result['country']?>"></td>
    			</tr>
    			<tr>
    				<td>Zip-code</td>
    				<td>:</td>
            <td><input type="text" name="zipcode" value="<?php echo $result['zipcode']?>"></td>
    			</tr>
    			<tr>
    				<td>Email</td>
    				<td>:</td>
            <td><input type="text" name="email" value="<?php echo $result['email']?>"></td>
    			</tr>
    			<tr>
    				<td>Address</td>
    				<td>:</td>
            <td><input type="text" name="address" value="<?php echo $result['address']?>"></td>
    			</tr>
    			<tr>
    				<td colspan="3"><input type="submit" name="save" value="Save" class="grey" style="width: 10%;"></td>
    			</tr>
          <tr>
            <td colspan="3"><a href="offlinepayment.php" style="color: grey;"><< back</a></td>
          </tr>
    			<?php

    				}
    			}
    			?>
    		</table>
      </form>
 		</div>
 	</div>
</div>
<?php
   include 'include/footer.php';
?>

