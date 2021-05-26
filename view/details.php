<?php
   include 'include/header.php';
   // include 'include/slider.php';
?>
	
<?php 
   if (!isset($_GET['productid']) || isset($_GET['productid']) == NULL){
        echo "<script>window.location = '404.php'</script>";   
    }else {
        $id = $_GET['productid'];
    }
    $product = new product();
    $ct = new cart();
    $cat = new category();
    $cus = new customer();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $addtocart = $ct->add_to_cart($quantity, $id); // gọi đến hàm trong class
    }

    if (isset($_POST['send_binhluan'])) {
    	$binhluan = $cus->insert_binhluan();
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <?php
                $get_product_details = $product->get_details($id);
                if ($get_product_details) {
                	while ($result_detail = $get_product_details->fetch_assoc()) {
         
            ?>
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2">
					<img src="admin/uploads/<?php echo $result_detail['image']?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_detail['productName']?></h2>
					<p><?php echo $fm->textShorten($result_detail['product_desc'],150)?></p>					
					<div class="price">
						<p>Price: <span><?php echo $result_detail['price']." "."VNĐ"?></span></p>
						<p>Category: <span><?php echo $result_detail['catName']?></span></p>
						<p>Brand:<span><?php echo $result_detail['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						<?php
                          if (isset($addtocart)) {
                          	echo '<span style="color:red;font-size:10px;">Product Already Added</span>';
                          }
						?>
					</form>				
				</div>
				</div>
				<div class="product-desc">
					<h2>Product preview</h2>
					<p><?php echo $fm->textShorten($result_detail['product_desc'],300)?></p>
				</div>
			</div>
			<?php
              }
            }
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
				  <?php
				    $get_all_category = $cat->show_category_frontend();
				  	if ($get_all_category) {
				  		while ($result_allcat = $get_all_category->fetch_assoc()) {
				  ?>
			      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName']?></a></li>
			      <?php
			      	}
				  	}
			      ?>
				</ul>
			</div>

 		</div>
 	</div>
 	
 	<div class="comment">
 		
 		<form action="" method="post">
	 		<h5>Ý kiến về sản phẩm</h5>
	 		<?php
	 		if (isset($binhluan)) {
	 			echo $binhluan;
	 		}
	 		?>
	 		<p><input type="hidden" name="get_id_binhluan" value="<?php echo $id?>"></p>
	 		<p><input type="text" placeholder="username" class="form-control" name="username"></p>
	 		<p><textarea style="resize: none;" name="comment" placeholder="Comment..." class="form-control" id="" cols="30" rows="10"></textarea></p>
	 		<p><input style=" 
	 		    background-color: #34f134;
			    border: none;
			    width: 7rem;
			    height: 2rem;
			    border-radius: 6px;
			    margin: -7px 0 9px; 
			    cursor: pointer;"
	            name="send_binhluan" type="submit" value="Gửi bình luận"></p>
        </form>
 	</div>
</div>
<?php
   include 'include/footer.php';
?>

