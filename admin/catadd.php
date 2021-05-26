<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
    $cat = new category();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'];  // tạo biến lấy dữ liệu từ form

        $insertCat = $cat->insert_category($catName); // gọi đến hàm trong class
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
                <div class="block copyblock"> 
                     <?php
                       if (isset($insertCat)) {
                           echo $insertCat;
                       }
                    ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Tên danh mục" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>