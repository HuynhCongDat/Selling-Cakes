<?php
  $product = new product();
?>
<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastestBrand1 = $product->getLastestBrand1();
			if ($getLastestBrand1) {
				while ($result1 = $getLastestBrand1->fetch_assoc()) {
				    
			?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					 <a href="details.php?productid=<?php echo $result1['productId']?>"> <img src="admin/uploads/<?php echo $result1['image']?>" alt="" /></a>
				</div>
			    <div class="text list_2_of_1">
					<h2><?php echo $result1['brandName']?></h2>
					<p><?php echo $result1['product_desc']?></p>
					<div class="button"><span><a href="details.php?productid=<?php echo $result1['productId']?>">Thêm giỏ hàng</a></span></div>
			   </div>
		   </div>	
		   <?php
		    }
		    }
		   ?>	
		   <?php
			$getLastestBrand2 = $product->getLastestBrand2();
			if ($getLastestBrand2) {
				while ($result2 = $getLastestBrand2->fetch_assoc()) {
				    
			?>	
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					  <a href="preview.html"><img src="admin/uploads/<?php echo $result2['image']?>" alt="" / ></a>
				</div>
				<div class="text list_2_of_1">
					  <h2><?php echo $result2['brandName']?></h2>
					  <p><?php echo $result2['product_desc']?></p>
					  <div class="button"><span><a href="details.php?productid=<?php echo $result2['productId']?>">Thêm giỏ hàng</a></span></div>
				</div>
			</div>
		</div>
		<?php
		    }
		    }
		   ?>	
		<div class="section group">
			<?php
			$getLastestBrand3 = $product->getLastestBrand3();
			if ($getLastestBrand3) {
				while ($result3 = $getLastestBrand3->fetch_assoc()) {
				    
			?>	
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					 <a href="preview.html"> <img src="admin/uploads/<?php echo $result3['image']?>" alt="" /></a>
				</div>
			    <div class="text list_2_of_1">
					<h2><?php echo $result3['brandName']?></h2>
					<p><?php echo $result3['product_desc']?></p>
					<div class="button"><span><a href="details.php?productid=<?php echo $result3['productId']?>">Thêm giỏ hàng</a></span></div>
			   </div>
		   </div>	
		   <?php
		    }
		    }
		   ?>	
		   <?php
			$getLastestBrand4 = $product->getLastestBrand4();
			if ($getLastestBrand4) {
				while ($result4 = $getLastestBrand4->fetch_assoc()) {
				    
			?>		
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					  <a href="preview.html"><img src="admin/uploads/<?php echo $result4['image']?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
					  <h2><?php echo $result4['brandName']?></h2>
					  <p><?php echo $result4['product_desc']?></p>
					  <div class="button"><span><a href="details.php?productid=<?php echo $result4['productId']?>">Thêm giỏ hàng</a></span></div>
				</div>
			</div>
			<?php
		    }
		    }
		   ?>
		</div>
	  <div class="clear"></div>
	</div>
		 <div class="header_bottom_right_images">
	   <!-- FlexSlider -->
         
		<section class="slider">
			  <div class="flexslider">
				<ul class="slides">
					<?php
					$get_slider = $product->show_slider();
					if ($get_slider) {
						while ($result = $get_slider->fetch_assoc()) {
					?>
					<li><img src="admin/uploads/<?php echo $result['sliderImage']?>" alt="<?php echo $result['silderName']?>"/></li>
					<?php
						}
					}
					?>
			    </ul>
			  </div>
      </section>
<!-- FlexSlider -->
    </div>
  <div class="clear"></div>
</div>