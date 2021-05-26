<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    if (!isset($_GET['catid']) || isset($_GET['catid']) == NULL){
        echo "<script>window.location = 'catlist.php'</script>";   
    }else {
        $id = $_GET['catid'];
    }
    $cat = new category();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'];  // tạo biến lấy dữ liệu từ form

        $updateCat = $cat->update_category($catName, $id); // gọi đến hàm trong class
    }
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                <div class="block copyblock"> 
                     <?php
                       if (isset($updateCat)) {
                           echo $updateCat;
                       }
                    ?>
                    <?php
                       $get_cate_name = $cat->getcatbyid($id);
                       if ($get_cate_name) {
                           while ($result = $get_cate_name->fetch_assoc()) {
                               
                       
                    ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName']?>" name="catName" placeholder="Tên danh mục" class="medium" />
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