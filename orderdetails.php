
<?php
   include 'include/header.php';
   include_once 'helpers/format.php';

?>
<?php
    $ct = new cart();
    $fm = new Format();
  

?>
<?php
    $cart = new cart();   // triệu gọi class từ file category.php
    if(isset($_GET['confirmed'])){
        $id = $_GET['confirmed'];
        $time = $_GET['time'];
        $price = $_GET['price'];
        $confirmed = $cart->confirmed($id, $time, $price);
    }    
?>
<?php
  $customer_id = session::get('customer_id');
  if ($customer_id == false) {
    header('Location:login.php');
  }
?>
    
 <div class="main">
    <div class="content">
        <div class="cartoption">        
            <div class="cartpage">
                    <h2>Đơn hàng đã mua của bạn</h2>
                        <table class="tblone">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="25%">Tên sản phẩm</th>
                                <th width="10%">Hình ảnh</th>
                                <th width="15%">Giá</th>
                                <th width="10%">Số lượng</th>
                                <th width="15%">Tổng giá</th>
                                <th width="10%">Ngày đặt hàng</th>
                                <th width="10%">Trạng thái</th>
                                <th width="10%">Hành động</th>
                            </tr>
                            <?php
                             $customer_id = session::get('customer_id');
                            $get_cart_ordered = $ct->get_cart_ordered($customer_id);
                            if ($get_cart_ordered) {
                                $subtotal = 0;
                                $qty = 0;
                                $i=0;
                                while ($result = $get_cart_ordered->fetch_assoc()) {
                                   $i++;
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $result['productName']?></td>
                                <td><img src="admin/uploads/<?php echo $result['image']?>" alt=""/></td>
                                <td><?php echo number_format($result['price'])." "."VNĐ"?></td>
                                <td>
                                   <?php echo $result['quantity']?>
                                </td>
                                <td><?php
                                 $total = $result['price'] * $result['quantity'];
                                 echo number_format($total)." "."VNĐ";
                                ?></td>
                                <td><?php echo $fm->formatDate($result['date_order'])?></td>
                                <td>
                                    <?php
                                    if ($result['status'] == 0) {
                                        echo 'Pending';
                                    }elseif($result['status'] == 1) {                               
                                    ?>
                                    <span>Shipped</span>
                                    <?php
                                    }elseif($result['status'] == 2) {
                                        echo 'Received';
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($result['status'] == '0') {
                                ?>
                                <td><?php echo 'N/A'; ?></tr>
                                <?php
                                 }elseif($result['status'] == '1') {
                                ?>
                                <td><a href="?confirmed=<?php echo $result['orderId']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>">Confirmed</a></td>
                                <?php
                                }elseif ($result['status'] == '2') {
                                ?>
                                <td><?php echo 'Received'?></td>
                                <?php
                                }
                                ?>
                            </tr>
                            
                            <?php
                                   
                                }
                            }
                            ?>
                            
                        </table>
                       
                    </div>
                    <div class="shopping">
                        <div class="shopleft">
                            <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                        </div>
                    </div>
        </div>      
       <div class="clear"></div>
    </div>
 </div>
<?php
  include 'include/footer.php';
?>
