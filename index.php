<?php
   include 'include/header.php';
   include 'include/slider.php';
?>
<?php
   $product = new product();
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
			<h3>Sản phẩm mới</h3>
			</div>
			<div class="clear"></div>
	    </div>
		<div class="section group">
			<?php
                $product_new = $product->getproduct_new();
                if ($product_new) {
                	while ($result_new = $product_new->fetch_assoc()) {  
	      	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="details.php?productid=<?php echo $result_new['productId']?>"><img src="admin/uploads/<?php echo $result_new['image']?>" alt="" height="250px" /></a>
				 <h2><?php echo $result_new['productName']?></h2>
				 <p><?php echo $fm->textShorten($result_new['product_desc'], 30)?></p>
				 <p><span class="price"><?php echo number_format($result_new['price']).''.'VNĐ'?></span></p>
			     <div class="button"><span><a href="details.php?productid=<?php echo $result_new['productId']?>" class="details">Thêm giỏ hàng</a></span></div>
			</div>
			<?php
              }
            }
			?>
		</div>
		<br>
		<div class="phantrang">
			<?php
			$product_all = $product->get_all_product_new();
			$product_count = mysqli_num_rows($product_all);
			$product_button = $product_count/8;
			$i =0;
			for ($i = 1; $i <= ceil($product_button) ; $i++) {
				echo '<a style="
				margin:0 5px;
				border: 1px solid #fff;
				border-radius:12px;
				padding:4px;
				background:#f1efef;
				color:black;
				" href="index.php?trang='.$i.'">'.$i.'</a>';
			}
			?>
		</div>

		<div class="content_bottom">
			<div class="heading">
			<h3>Sản phẩm nổi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
        <div class="section group">
      	<?php
            $product_feathered = $product->getproduct_feathered();
            if ($product_feathered) {
            	while ($result = $product_feathered->fetch_assoc()) {  
      	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="details.php?productid=<?php echo $result['productId']?>"><img src="admin/uploads/<?php echo $result['image']?>" alt="" height="200px" /></a>
				 <h2><?php echo $result['productName']?></h2>
				 <p><?php echo $fm->textShorten($result['product_desc'], 30)?></p>
				 <p><span class="price"><?php echo number_format($result['price'])." "."VNĐ"?></span></p>
			     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']?>" class="details">Thêm giỏ hàng</a></span></div>
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
