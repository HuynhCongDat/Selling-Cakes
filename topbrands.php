<?php
   include 'include/header.php';
   include 'include/slider.php';
?>
<?php
   // $product = new product();
   // $get_product_
      $brand = new brand();
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>BRODARD BAKERY</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
	    	<?php
	    	$get_product_brand = $brand->get_product_brand_BRODARDBAKERY();
	    	if ($get_product_brand) {
	    		while ($result_product_brand = $get_product_brand->fetch_assoc()) {
	    			echo $result_product_brand;
	    	?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_product_brand['image']?>" alt="" /></a>
				<h2><?php echo $result_product_brand['productName']?></h2>
				<p><?php echo $result_product_brand['product_desc']?></p>
				<p><span class="price"><?php echo number_format($result_product_brand['price']).''.'VNĐ'?></span></p>
				<div class="button"><span><a href="details.php?productid=<?php echo $result_product_brand['productId']?>" class="preview">Chi tiết</a></span></div>
			</div>
			<?php    
	    		}
	    	}
			?>
			
		</div>
		<div class="content_bottom">
    		<div class="heading">
    		    <h3>TOUS LES JOURS</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
	    	$get_product_brand = $brand->get_product_brand_TOUSLESJOURS();
	    	if ($get_product_brand) {
	    		while ($result_product_brand = $get_product_brand->fetch_assoc()) {
	    	?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_product_brand['image']?>" alt="" /></a>
				<h2><?php echo $result_product_brand['productName']?></h2>
				<p><?php echo $result_product_brand['product_desc']?></p>
				<p><span class="price"><?php echo number_format($result_product_brand['price']).''.'VNĐ'?></span></p>
				<div class="button"><span><a href="details.php?productid=<?php echo $result_product_brand['productId']?>" class="preview">Chi tiết</a></span></div>
			</div>
			<?php    
	    		}
	    	}
			?>
		</div>
	    <div class="content_bottom">
    		<div class="heading">
    		<h3>GIVRAL</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
	    	$get_product_brand = $brand->get_product_brand_GIVRAL();
	    	if ($get_product_brand) {
	    		while ($result_product_brand = $get_product_brand->fetch_assoc()) {
	    	?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_product_brand['image']?>" alt="" /></a>
				<h2><?php echo $result_product_brand['productName']?></h2>
				<p><?php echo $result_product_brand['product_desc']?></p>
				<p><span class="price"><?php echo number_format($result_product_brand['price']).''.'VNĐ'?></span></p>
				<div class="button"><span><a href="details.php?productid=<?php echo $result_product_brand['productId']?>" class="preview">Chi tiết</a></span></div>
		    </div>
			<?php    
	    		}
	    	}
			?>
		</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>HỦY LÂM MÔN</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
	    	$get_product_brand = $brand->get_product_brand_HUYLAMMON();
	    	if ($get_product_brand) {
	    		while ($result_product_brand = $get_product_brand->fetch_assoc()) {
	    	?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_product_brand['image']?>" alt="" /></a>
				<h2><?php echo $result_product_brand['productName']?></h2>
				<p><?php echo $result_product_brand['product_desc']?></p>
				<p><span class="price"><?php echo number_format($result_product_brand['price']).''.'VNĐ'?></span></p>
				<div class="button"><span><a href="details.php?productid=<?php echo $result_product_brand['productId']?>" class="preview">Chi tiết</a></span></div>
		    </div>
			<?php    
	    		}
	    	}
			?>
		</div>
    </div>
 </div>
<?php
  include 'include/footer.php';
?>
