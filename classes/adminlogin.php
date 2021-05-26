<?php
  $filepath = realpath(dirname(__FILE__));
   include ($filepath.'/../lib/session.php');
   Session::checkLogin(); // gọi hàm checkLogin trong file session
   include_once ($filepath.'/../lib/database.php');
   include_once ($filepath.'/../helpers/format.php');
?>


<?php
   /**
    * summary
    */
   class adminlogin
   {
       private $db;
       private $fm;

       public function __construct()
       {
           $this->db = new Database();

           $this->fm = new Format();
       }
       public function login_admin($adminUser, $adminPass){
       	// dùng hàm Validation trong class format để kiểm tra hai biến truyền vào cóa hợp lệ hay không
           $adminUser = $this->fm->validation($adminUser);
           $adminPass = $this->fm->validation($adminPass);

           $adminUser = mysqli_real_escape_string($this->db->link, $adminUser); 
           $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
           // link là biến chứa các file như connect đến database ở bên file database
           // mysql_real_escape_string bình thường sẽ cóa 1 biến, but mysqli_real_escape_string sẽ cóa 2 biến 1 là kết nối csdl, 1 là dữ liệu

           if (empty($adminUser) || empty($adminPass)) {
           	  $alert = "User and Pass must be not empty";
           	  return $alert;
           }else{
           	  $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
           	  $result = $this->db->select($query);

           	  if ($result != false) {
           	  	 $value = $result->fetch_assoc();
           	  	 Session::set('adminlogin',true);
           	  	 Session::set('adminId',$value['AdminId']);
           	  	 Session::set('adminUser',$value['AdminUser']);
           	  	 Session::set('adminName',$value['AdminName']);
           	  	 header('Location:index.php'); //nếu đúng thì cho quay về trang index
           	  }else {
           	  	 $alert = "User and Pass not match";
           	  	 return $alert;
           	  }
           }
       }
   }
?>