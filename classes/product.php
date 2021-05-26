<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../lib/database.php');
   include_once ($filepath.'/../helpers/format.php');
?>


<?php
   /**
    * summary
    */
   class product
   {
       private $db;
       private $fm;

       public function __construct()
       {
           $this->db = new Database();

           $this->fm = new Format();
       }
       public function insert_product($data, $files){

          $productName = mysqli_real_escape_string($this->db->link, $data['productName']); 
          $brand = mysqli_real_escape_string($this->db->link, $data['brand']); 
          $category = mysqli_real_escape_string($this->db->link, $data['category']); 
          $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']); 
          $price = mysqli_real_escape_string($this->db->link, $data['price']); 
          $type = mysqli_real_escape_string($this->db->link, $data['type']); 

          //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
          $permited = array('jpg','jpeg','png','gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;
         
           // link là biến chứa các file như connect đến database ở bên file database
           // mysql_real_escape_string bình thường sẽ cóa 1 biến, but mysqli_real_escape_string sẽ cóa 2 biến 1 là kết nối csdl, 1 là dữ liệu

           if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "" ) {
           	  $alert = "<span class='error'>Fields name must be not empty</span>";
           	  return $alert;
           }else{
              move_uploaded_file($file_temp, $uploaded_image);
           	  $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, image) VALUES ('$productName','$category','$brand','$product_desc','$type','$price','$unique_image')";
           	  $result = $this->db->insert($query);
              if ($result) {
                $alert = "<span class='success'>Insert Product Successfully</span> ";
                return $alert;
              }else {
                $alert = "<span class='error'>Insert Product Not Success</span> ";
                return $alert;
              }
           	 
           }
       }

       public function insert_slider($data, $files){
          $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']); 
          $type = mysqli_real_escape_string($this->db->link, $data['type']); 
        
          //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
          $permited = array('jpg','jpeg','png','gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;
          

          if ($sliderName == "" || $type == ""){
            $alert = "<span class='error'>Fields name must be not empty</span>";
            return $alert;
          }else{
            if (!empty($file_name)) {
              //nếu người dùng chọn ảnh
              if ($file_size > 204800) {
                $alert = "<span class='error'>Image Size should be less then 2MB!</span> ";
                return $alert;
              }elseif (in_array($file_ext,$permited) === false) {
                // echo "<span class='error'>You can upload only:-".implode(',',$permited)."</span>";
                $alert = "<span class='error'>You can upload only:-".implode(',',$permited)."</span> ";
                return $alert;
              }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName, type, sliderImage) VALUES ('$sliderName','$type','$unique_image')";
              $result = $this->db->insert($query);
              if ($result) {
                $alert = "<span class='success'>Insert Slider Successfully</span> ";
                return $alert;
              }else {
                $alert = "<span class='error'>Insert Slider Not Success</span> ";
                return $alert;
              }
             }
           }
       }
       }

       public function show_slider(){
         $query = "SELECT * FROM tbl_slider WHERE type ='1' ORDER BY sliderId DESC";
          $result = $this->db->select($query);
          return $result;
       }

       public function show_slider_admin(){
         $query = "SELECT * FROM tbl_slider ORDER BY sliderId DESC";
          $result = $this->db->select($query);
          return $result;
       }
        public function show_product(){
           $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
           FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
           INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
           ORDER BY tbl_product.productId DESC";
          // $query = "SELECT * FROM tbl_product ORDER BY productId DESC";
          $result =  $this->db->select($query);
          return $result;
        }

        public function getproductbyid($id){
          $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
          $result = $this->db->select($query);
          return $result;
        }

        public function update_product($data,$files, $id){

          $productName = mysqli_real_escape_string($this->db->link, $data['productName']); 
          $brand = mysqli_real_escape_string($this->db->link, $data['brand']); 
          $category = mysqli_real_escape_string($this->db->link, $data['category']); 
          $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']); 
          $price = mysqli_real_escape_string($this->db->link, $data['price']); 
          $type = mysqli_real_escape_string($this->db->link, $data['type']); 

          //kiểm tra hình ảnh và lấy hình ảnh cho vào folder uploads
          $permited = array('jpg','jpeg','png','gif');
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_temp = $_FILES['image']['tmp_name'];

          $div = explode('.', $file_name);
          $file_ext = strtolower(end($div));
          $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
          $uploaded_image = "uploads/".$unique_image;
          

          if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == ""){
            $alert = "<span class='error'>Fields name must be not empty</span>";
            return $alert;
          }else{
            if (!empty($file_name)) {
              //nếu người dùng chọn ảnh
              if ($file_size > 204800) {
                $alert = "<span class='error'>Image Size should be less then 2MB!</span> ";
                return $alert;
              }elseif (in_array($file_ext,$permited) === false) {
                // echo "<span class='error'>You can upload only:-".implode(',',$permited)."</span>";
                $alert = "<span class='error'>You can upload only:-".implode(',',$permited)."</span> ";
                return $alert;
              }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE tbl_product SET 
                productName = '$productName',
                catId = '$category',
                brandId = '$brand',
                product_desc = '$product_desc',
                type = '$type',
                price = '$price',
                image = '$unique_image'
                WHERE productId = '$id'";
              }
            }else{
              //nếu người dùng không chọn ảnh
              $query = "UPDATE tbl_product SET 
              productName = '$productName',
              catId = '$category',
              brandId = '$brand',
              product_desc = '$product_desc',
              type = '$type',
              price = '$price'
              WHERE productId = '$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
              $alert = "<span class='success'>Update Product Successfully</span> ";
              return $alert;
            }else {
              $alert = "<span class='error'>Update Product Not Success</span> ";
              return $alert;
            }
             
           }
        }

        public function update_slider($id,$type){
          $type = mysqli_real_escape_string($this->db->link, $type); 
          $query = "UPDATE tbl_slider SET type='$type' WHERE sliderId = '$id'";
          $result = $this->db->update($query);
          return $result;
        }

        public function delete_product($id){
           $query = "DELETE FROM tbl_product WHERE productId = '$id'";
           $result = $this->db->delete($query);
           if ($result) {
              $alert = "<span class='success'>Delete Product Successfully</span> ";
              return $alert;
           }else {
              $alert = "<span class='error'>Delete Product Not Success</span> ";
              return $alert;
           }
        }

        public function delete_slider($id){
           $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
           $result = $this->db->delete($query);
           if ($result) {
              $alert = "<span class='success'>Delete Slider Successfully</span> ";
              return $alert;
           }else {
              $alert = "<span class='error'>Delete Slider Not Success</span> ";
              return $alert;
           }
        }

        //End backend
        //start front end
        public function getproduct_feathered(){
          
          $query = "SELECT * FROM tbl_product WHERE type = '0' LIMIT 4 ";
          $result = $this->db->select($query);
          return $result;
        }

        public function get_all_product_new(){
          $query = "SELECT * FROM tbl_product ";
          $result = $this->db->select($query);
          return $result;
        }

        public function getproduct_new(){
          $sp_tungtrang = 8;
          if (!isset($_GET['trang'])) {
            $trang = 1;
          }else {
            $trang = $_GET['trang'];
          }
          $tung_trang = ($trang - 1)*$sp_tungtrang;
          $query = "SELECT * FROM tbl_product ORDER BY productId LIMIT $tung_trang,$sp_tungtrang";
          $result = $this->db->select($query);
          return $result;
        }

        public function get_details($id){
          $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
          FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
          INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId 
          WHERE tbl_product.productId = '$id'";
      
          $result =  $this->db->select($query);
          return $result;
        }

        public function getLastestBrand1(){
          $query = "SELECT * FROM tbl_product, tbl_brand WHERE tbl_brand.brandId = tbl_product.brandId AND tbl_product.brandId = '12' ORDER BY tbl_product.productId DESC LIMIT 1";
          $result = $this->db->select($query);
          return $result;
        }
        public function getLastestBrand2(){
          $query = "SELECT * FROM tbl_product, tbl_brand WHERE tbl_brand.brandId = tbl_product.brandId AND tbl_product.brandId = '13' ORDER BY tbl_product.productId DESC LIMIT 1";
          $result = $this->db->select($query);
          return $result;
        }
        public function getLastestBrand3(){
          $query = "SELECT * FROM tbl_product, tbl_brand WHERE tbl_brand.brandId = tbl_product.brandId AND tbl_product.brandId = '14' ORDER BY tbl_product.productId DESC LIMIT 1";
          $result = $this->db->select($query);
          return $result;
        }
        public function getLastestBrand4(){
          $query = "SELECT * FROM tbl_product, tbl_brand WHERE tbl_brand.brandId = tbl_product.brandId AND tbl_product.brandId = '15' ORDER BY tbl_product.productId DESC LIMIT 1";
          $result = $this->db->select($query);
          return $result;
        }

        public function search_product($key){
          $key = $this->fm->validation($key);
          $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$key%'";
          $result = $this->db->select($query);
          return $result;
        }
   }
?>