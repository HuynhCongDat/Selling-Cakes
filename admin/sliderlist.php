<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
    $product = new product();   // triệu gọi class từ file category.php
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {   
    //     $insertSlider = $product->insert_slider($_POST, $_FILE); // gọi đến hàm trong class
    // }
?>
<?php
	if (isset($_GET['type_slider']) && isset($_GET['type'])) {
		$id = $_GET['type_slider'];
		$type = $_GET['type'];
		$update_slider = $product->update_slider($id,$type);
	}
    if (isset($_GET['del_slider'])) {
   	   $id = $_GET['del_slider'];
   	   $del_slider = $product->delete_slider($id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
        	<?php
        	if (isset($del_slider)) {
        		echo $del_slider;
        	}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$get_slider = $product->show_slider_admin();
					$i=0;
					if ($get_slider) {
						while ($result = $get_slider->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i?></td>
					<td><?php echo $result['sliderName']?></td>
					<td><img src="uploads/<?php echo $result['sliderImage']?>" height="40px" width="60px"/></td>	
					<td>
						<?php
						if ($result['type'] == 1) {
					    ?>
					    <a href="?type_slider=<?php echo $result['sliderId']?>&type=0">On</a> 
					    <?php
					    }else {
					    ?>
					     <a href="?type_slider=<?php echo $result['sliderId']?>&type=1">Off</a> 
					    <?php 
					    }
					    ?>
					</td>			
					<td>
						<a href="?del_slider=<?php echo $result['sliderId']?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
