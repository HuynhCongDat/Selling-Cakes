<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
<?php
   // $cus = new customer();
   // $login_check = session::get('customer_login');
   // if ($login_check == false) {
   // 	  header('Location:login.php');
   // }
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
				<h3>Payment method</h3>
				</div>
				<div class="clear"></div>
        <div class="wrapper-method">
          <h3 class="payment">Choose your method payment</h3>
          <a class="payment_method" href="offlinepayment.php">Offline Payment</a>
          <a class="payment_method" href="onlinepayment.php">Online Payment</a><br><br>
          <a style="background: grey;" href="cart.php"><< Previous</a>
        </div>
		    </div>
 		</div>
 	</div>
</div>
<?php
   include 'include/footer.php';
?>

