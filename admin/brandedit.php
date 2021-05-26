<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    if (!isset($_GET['brandid']) || isset($_GET['brandid']) == NULL){
        echo "<script>window.location = 'brandlist.php'</script>";   
    }else {
        $id = $_GET['brandid'];
    }
    $brand = new brand();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $brandName = $_POST['brandName'];  // tạo biến lấy dữ liệu từ form

        $updateBrand = $brand->update_brand($brandName, $id); // gọi đến hàm trong class
    }
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
                <div class="block copyblock"> 
                     <?php
                       if (isset($updateBrand)) {
                           echo $updateBrand;
                       }
                    ?>
                    <?php
                       $get_brand_name = $brand->getbrandbyid($id);
                       if ($get_brand_name) {
                           while ($result = $get_brand_name->fetch_assoc()) {
                               
                       
                    ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']?>" name="brandName" placeholder="Tên thương hiệu" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form> 
                    <?php
                          }
                       }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>