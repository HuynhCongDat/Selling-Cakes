
<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
<div class="main">
    <div class="content">
        <?php
        $product = new product();   // triệu gọi class từ file category.php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $key = $_POST['key'];  // tạo biến lấy dữ liệu từ form

            $search_product = $product->search_product($key); // gọi đến hàm trong class
        }
        ?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Từ khó tìm kiếm: <?php echo  $key?> </h3>
    		</div>
    		
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
	    	<?php
				if ($search_product) {
					while ($result = $search_product->fetch_assoc()) {
				?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image']?>" alt="" /></a>
					<h2><?php echo $result['productName']?></h2>
					<p><?php echo $fm->textShorten($result['product_desc'])?></p>
					<p><span class="price"><?php echo number_format($result['price']).''.'VNĐ'?></span></p>
					<div class="button"><span><a href="details.php?productid=<?php echo $result['productId']?>" class="preview">preview</a></span></div>
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