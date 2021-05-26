<?php
  include 'lib/session.php';
  Session::init();
?>
<?php
  include_once 'lib/database.php';
  include_once 'helpers/format.php';

  spl_autoload_register(function($class){
  	include_once "classes/".$class.".php";  //tự auto lấy những j chứa trong folder classes
  });
  	$db = new Database();
  	$fm = new Format();
  	$cart = new cart();
  	$user = new user();
  	$cat = new category();
  	$pd = new product();
  	$cus = new customer();
  	$brand = new brand();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script src="https://kit.fontawesome.com/6e4540c13e.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
    <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo1.png" alt="" ></a>
			</div>
			<div class="header_top_right">
			    <div class="search_box">
					<div class="search">
						<form action="search.php" method="post">							
							<input type="text" placeholder="Tìm sản phẩm..." name="key">						
							<button type="submit" name="search_product" value="Tìm kiếm"><i class="fas fa-search"></i>Tìm kiếm</button>
						</form>
					</div>
			    </div>
			    <div class="shopping_cart">
					<i class="fas fa-shopping-cart"></i>
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="no_product">
								<?php
									$check_cart = $cart->check_cart();
									if ($check_cart) {
										// $sum = Session::get("sum");
										$qty = Session::get("qty");
										echo $qty.'';
									}else {
										echo '0';
									}
							    ?>
							</span>
						</a>
					</div>
			    </div>
					<?php 
						if (isset($_GET['customer_id'])) {
							$delcart = $cart->del_all_data_cart();
							session::destroy();
						}
					?>
				<div class="login">
				<!-- <a href="login.php"><i class="far fa-user">Login</i></a></div> -->
				    <?php
						$login_check = Session::get('customer_login');
						if ($login_check==false) {
							echo '<a href="login.php">
							      	<i class="far fa-user"></i>
								</a></div>';
						}else {
							echo '<a href="?customer_id='.session::get('customer_id').'">
									<i class="fas fa-sign-out-alt"></i>
								</a></div>';
						}
					?>
					
				<div class="clear"></div>
	 		</div>
	 	<div class="clear"></div>
 	</div>
	<div class="menu">
		<ul id="dc_mega-menu-orange" class="dc_mm-orange">
			<li><a href="index.php">Trang chủ</a></li>
			<!--  <li><a href="products.php">Products</a> </li> -->
			<li><a href="topbrands.php">Thương hiệu TOP</a></li>
			<!-- <li><a href="cart.php">Cart</a></li> -->
			<?php
				$check_cart = $cart->check_cart();
				if ($check_cart == true) {
					echo '<li><a href="cart.php">Giỏ hàng</a></li>';
				}else {
					echo '';
				}
			?>
			<?php
				$customer_id = session::get('customer_id');
				$check_order = $cart->check_order($customer_id);
				if ($check_order == true) {
					echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
				}else {
					echo '';
				}
			?>
			<?php
				$login_check = Session::get('customer_login');
				if ($login_check==false) {
					echo '';
				}else {
					echo '<li><a href="profile.php">Thông tin khách hàng</a></li>';
				}
			?>
			<!-- <li><a href="compare.php">Compare</a> </li> -->
			<li><a href="contact.php">Liên lạc</a> </li>
			<div class="clear"></div>
		</ul>
	</div>