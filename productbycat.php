
<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
<?php
    if (!isset($_GET['catid']) || isset($_GET['catid']) == NULL){
        echo "<script>window.location = '404.php'</script>";   
    }else {
        $id = $_GET['catid'];
    }
    $cat = new category();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'];  // tạo biến lấy dữ liệu từ form

        $updateCat = $cat->update_category($catName, $id); // gọi đến hàm trong class
    }
    $cat = new category();
    
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<?php
	    	$getnamebycat = $cat->get_name_by_cat($id);
	    	if ($getnamebycat) {
	    		while ($result_namebycat = $getnamebycat->fetch_assoc()) {
	    	?>
    		<div class="heading">
    		<h3>Category: <?php echo $result_namebycat['catName']?> </h3>
    		</div>
    		<?php
    	    }
    	    }
    	    else {
    	    	echo 'category not avaiable!';
    	    }
    		?>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
	    	<?php
	    	$getproductbycat = $cat->get_product_by_cat($id);
	    	if ($getproductbycat) {
	    		while ($result_probycat = $getproductbycat->fetch_assoc()) {
	    		    
	    	
	    	?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result_probycat['image']?>" alt="" /></a>
				 <h2><?php echo $result_probycat['productName']?></h2>
				 <p><?php echo $fm->textShorten($result_probycat['product_desc'])?></p>
				 <p><span class="price"><?php echo number_format($result_probycat['price']).''.'VNĐ'?></span></p>
			     <div class="button"><span><a href="details.php?productid=<?php echo $result_probycat['productId']?>" class="preview">preview</a></span></div>
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