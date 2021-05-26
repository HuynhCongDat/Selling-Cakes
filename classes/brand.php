<?php
   $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../lib/database.php');
   include_once ($filepath.'/../helpers/format.php');
?>


<?php
   /**
    * summary
    */
   class brand
   {
       private $db;
       private $fm;

       public function __construct()
       {
           $this->db = new Database();

           $this->fm = new Format();
       }
       public function insert_brand($brandName){
       	// dùng hàm Validation trong class format để kiểm tra hai biến truyền vào cóa hợp lệ hay không
           $brandName = $this->fm->validation($brandName);

           $brandName = mysqli_real_escape_string($this->db->link, $brandName); 
           // link là biến chứa các file như connect đến database ở bên file database
           // mysql_real_escape_string bình thường sẽ cóa 1 biến, but mysqli_real_escape_string sẽ cóa 2 biến 1 là kết nối csdl, 1 là dữ liệu

           if (empty($brandName)) {
           	  $alert = "<span class='error'>Brand name must be not empty</span>";
           	  return $alert;
           }else{
           	  $query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
           	  $result = $this->db->insert($query);
              if ($result) {
                $alert = "<span class='success'>Insert Brand Successfully</span> ";
                return $alert;
              }else {
                $alert = "<span class='error'>Insert Brand Not Success</span> ";
                return $alert;
              }
           	 
           }
       }
        public function show_brand(){
          $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
          $result =  $this->db->select($query);
          return $result;
        }

        public function get_product_brand_BRODARDBAKERY(){
           $query = "SELECT * FROM tbl_product WHERE brandId = '12' ORDER BY productId DESC LIMIT 4";
          $result =  $this->db->select($query);
          return $result;
        }
        public function get_product_brand_TOUSLESJOURS(){
           $query = "SELECT * FROM tbl_product WHERE brandId = '13' ORDER BY productId DESC LIMIT 4";
          $result =  $this->db->select($query);
          return $result;
        }
        public function get_product_brand_GIVRAL(){
           $query = "SELECT * FROM tbl_product WHERE brandId = '14' ORDER BY productId DESC LIMIT 4";
          $result =  $this->db->select($query);
          return $result;
        }
        public function get_product_brand_HUYLAMMON(){
           $query = "SELECT * FROM tbl_product WHERE brandId = '15' ORDER BY productId DESC LIMIT 4";
          $result =  $this->db->select($query);
          return $result;
        }

        public function getbrandbyid($id){
          $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
          $result = $this->db->select($query);
          return $result;
        }

        public function update_brand($brandName, $id){
           $brandName = $this->fm->validation($brandName);

           $brandName = mysqli_real_escape_string($this->db->link, $brandName); 
           $id = mysqli_real_escape_string($this->db->link, $id); 
          

           if (empty($brandName)) {
              $alert = "<span class='error'>Brand name must be not empty</span>";
              return $alert;
           }else{
              $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
              $result = $this->db->update($query);
              if ($result) {
                $alert = "<span class='success'>Update Brand Successfully</span> ";
                return $alert;
              }else {
                $alert = "<span class='error'>Update Brand Not Success</span> ";
                return $alert;
              }
             
           }
        }

        public function delete_brand($id){
           $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
           $result = $this->db->delete($query);
           if ($result) {
              $alert = "<span class='success'>Delete Brand Successfully</span> ";
              return $alert;
           }else {
              $alert = "<span class='error'>Delete Brand Not Success</span> ";
              return $alert;
           }
        }
   }
?>