<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../classes/cart.php');
   include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cart = new cart();   // triệu gọi class từ file category.php
    if(isset($_GET['shipid'])){
        $id = $_GET['shipid'];
    	$time = $_GET['time'];
    	$price = $_GET['price'];
    	$shipped = $cart->shipped($id, $time, $price);
    }

    if(isset($_GET['shiftid'])){
        $id = $_GET['shiftid'];
    	$time = $_GET['time'];
    	$price = $_GET['price'];
    	$shifted = $cart->shifted($id, $time, $price);
    }
    
    
    
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">        
        <?php
        if (isset($shifted)) {
        	echo $shifted;
        }
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Order Time</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Customer Id</th>
					<th>Address</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$cart = new cart();
				$fm = new Format();
				$get_inbox_cart = $cart->get_inbox_cart();
				$i=0;
				if ($get_inbox_cart) {
					while ($result = $get_inbox_cart->fetch_assoc()) {
					    $i++;
				
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $fm->formatDate($result['date_order'])?></td>
					<td><?php echo $result['productName']?></td>
					<td><?php echo $result['quantity']?></td>
					<td><?php echo number_format($result['price']).' '.'VNĐ'?></td>
					<td><?php echo $result['customerId']?></td>
					<td><a href="customer.php?customerid=<?php echo $result['customerId']?>">View Address</a></td>
					<td>
						<?php
						if ($result['status']==0) {
						?>
						<a href="?shipid=<?php echo $result['orderId']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Pending</a>
						<?php
					    }elseif($result['status'] ==1 ) {
						?>
						<?php
						echo 'Shipping...'
						?>
						<?php
					    }elseif($result['status'] ==2 ) {
						?>
						<a href="?delid=<?php echo $result['orderId']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Remove</a>
						<?php
					    }
						?>

					</td>
				</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
