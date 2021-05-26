<?php
  $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../lib/database.php');
   include_once ($filepath.'/../helpers/format.php');
?>


<?php
   /**
    * summary
    */
   class cart
   {
       private $db;
       private $fm;

       public function __construct()
       {
           $this->db = new Database();

           $this->fm = new Format();
       }

       public function add_to_cart($quantity, $id){
          $quantity = $this->fm->validation($quantity);

          $quantity = mysqli_real_escape_string($this->db->link, $quantity); 
          $id = mysqli_real_escape_string($this->db->link, $id); 
          $sId = session_id();

          $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
          $result = $this->db->select($query)->fetch_assoc();

          $productName = $result["productName"];
          $price = $result["price"];
          $image = $result["image"];

          $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sId'";
          $result_check = $this->db->select($check_cart);

          if ($result_check) {
            $msg = "Product Already added";
            return $msg;
          }else {
            $query_insert = "INSERT INTO tbl_cart(productId, sessionId, productName, price, quantity, image) VALUES ('$id','$sId','$productName',' $price','$quantity','$image')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
              header('Location:cart.php');
            }else {
              header('Location:404.php');
            }
          }
          
        }

        public function get_product_cart(){
          $sId = session_id();
          $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
          $result = $this->db->select($query);
          return $result;
        }

        public function update_quantity_cart($cartId, $quantity){
          $quantity = mysqli_real_escape_string($this->db->link, $quantity); 
          $cartId = mysqli_real_escape_string($this->db->link, $cartId); 
          $query = "UPDATE tbl_cart SET 
            quantity = '$quantity'
            WHERE cartId = '$cartId'";
          $result = $this->db->update($query);
          if ($result) {
            header('Location:cart.php');
          }else {
            $msg = "<span class='error'>Product quantity updated not success</span>";
            return $msg;
          }
        }

        public function delete_product_cart($cartId){
          $query = "DELETE FROM tbl_cart WHERE cartId = '$cartId'";
          $result = $this->db->delete($query);
          if ($result) {
            header('Location:cart.php');
          }else {
            $alert = "<span class='error'>Delete Product cart Not Success</span> ";
            return $alert;
          }
        }

        public function check_cart(){
          $sId = session_id();
          $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
          $result = $this->db->select($query);
          return $result;
        }

        public function check_order($customer_id){
       
          $query = "SELECT * FROM tbl_order WHERE customerId = '$customer_id'";
          $result = $this->db->select($query);
          return $result;
        }
        public function del_all_data_cart(){
          $sId = session_id();
          $query = "DELETE FROM tbl_cart WHERE sessionId = '$sId'";
          $result = $this->db->delete($query);
          return $result;
        }

        public function insert_order($customer_id){
           $sId = session_id();
           $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId'";
           $get_product = $this->db->select($query);
          if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productid = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;

                $query_order = "INSERT INTO tbl_order(productId, productName, customerId, quantity, price, image) VALUES ('$productid','$productName','$customer_id',' $quantity','$price','$image')";
                $insert_order = $this->db->insert($query_order);
                if ($insert_order) {
                  header('Location:cart.php');
                }else {
                  header('Location:404.php');
                }
            }
          }
        }

        public function getAmountPrice($customer_id){
          
          $query = "SELECT price FROM tbl_order WHERE customerId = '$customer_id'";
          $get_price = $this->db->select($query);
          return $get_price;
        }

        public function get_cart_ordered($customer_id){
          $query = "SELECT * FROM tbl_order WHERE customerId = '$customer_id'";
          $get_cart_ordered = $this->db->select($query);
          return $get_cart_ordered;
        }

        public function get_inbox_cart(){
           $query = "SELECT * FROM tbl_order ORDER BY date_order";
          $get_inbox_cart = $this->db->select($query);
          return $get_inbox_cart;
        }

        public function shipped($id, $time, $price){
          $id = mysqli_escape_string($this->db->link, $id);
          $time = mysqli_escape_string($this->db->link, $time);
          $price = mysqli_escape_string($this->db->link, $price);

          $query = "UPDATE tbl_order SET 
            status = '1'
            WHERE orderId = '$id' AND date_order = '$time' AND price = '$price'";
          $result = $this->db->update($query);
          if ($result) {
           $msg = "<span class='success'>Updated order successfully</span>";
            return $msg;
          }else {
            $msg = "<span class='error'>Updated order not success</span>";
            return $msg;
          }
        }

        public function confirmed($id, $time, $price){
          $id = mysqli_escape_string($this->db->link, $id);
          $time = mysqli_escape_string($this->db->link, $time);
          $price = mysqli_escape_string($this->db->link, $price);

          $query = "UPDATE tbl_order SET 
                   status = '2' 
                   WHERE orderId = '$id' AND date_order = '$time' AND price = '$price'";
          $result = $this->db->update($query);
          if ($result) {
            $msg = "<span class='success'>Updated order successfully</span>";
            return $msg;
          }else {
            $msg = "<span class='error'>Updated order not success</span>";
            return $msg;
          }

        }
   }
?>