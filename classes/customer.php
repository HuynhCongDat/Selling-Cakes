<?php
  $filepath = realpath(dirname(__FILE__));
   include_once ($filepath.'/../lib/database.php');
   include_once ($filepath.'/../helpers/format.php');
?>


<?php
   /**
    * summary
    */
   class customer
   {
       private $db;
       private $fm;

       public function __construct()
       {
           $this->db = new Database();

           $this->fm = new Format();
       }

      public function insert_customer($data){
      
        $cusName = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($cusName == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == ""  || $password == "") {
          $alert = "<span class='error'>Fields name must be not empty</span>";
          return $alert;
        }else {
          $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1"; //kiểm tra nếu email đã đc đăng ký hay chưa
          $result_check = $this->db->select($check_email);
          if ($result_check) {
            $alert = "<span class='error'>Email already exist</span>";
            return $alert;
          }else {
             $query = "INSERT INTO tbl_customer(cusName, address, city, country, zipcode, phone, email, password) VALUES ('$cusName','$address','$city','$country','$zipcode','$phone','$email','$password')";
            $result = $this->db->insert($query);
            if ($result) {
              $alert = "<span class='success'>Register Successfully</span> ";
              return $alert;
            }else {
              $alert = "<span class='error'>Register false</span> ";
              return $alert;
            }
          }
        }
      }

      public function insert_binhluan(){
        $productId = $_POST['get_id_binhluan'];
        $username = $_POST['username'];
        $comment = $_POST['comment'];

        if ($username == ""|| $comment == "") {
           $alert = "<span class='error'>Fields name must be not empty</span>";
          return $alert;
        }else {
          $query = "INSERT INTO tbl_comment (username, content,blogId) VALUES ('$username','$comment','productId')";
          $result = $this->db->insert($query);
          if ($result) {
            $alert = "<span class='success'>Comment Successfully</span> ";
            return $alert;
          }else {
            $alert = "<span class='error'>Comment false</span> ";
            return $alert;
          }
        }
      }

      public function login_customer($data){
        // $email = $this->fm->validation($email);
        // $password = $this->fm->validation($password);

        $email = mysqli_real_escape_string($this->db->link, $data['email']); 
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        // link là biến chứa các file như connect đến database ở bên file database
        // mysql_real_escape_string bình thường sẽ cóa 1 biến, but mysqli_real_escape_string sẽ cóa 2 biến 1 là kết nối csdl, 1 là dữ liệu

        if ($email== '' || $password == '') {
          $alert = "<span class='error'>Fields name must be not empty</span>";
          return $alert;
        }else{
          $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
          $result = $this->db->select($query);

          if ($result != false) {
             $value = $result->fetch_assoc();
             Session::set('customer_login',true);
             Session::set('customer_id',$value['cusId']);
             Session::set('customer_name',$value['cusName']);
             header('Location:order.php'); //nếu đúng thì cho quay về trang index
          }else {
             $alert = "Email or Password not match";
             return $alert;
          }
       }

      }

      public function show_customer($id){
        $query = "SELECT * FROM tbl_customer WHERE cusId = '$id'";  
        $result = $this->db->select($query);
        return $result;
      }

      public function edit_profile_customer($data,$id){
        $cusName = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        
        if ($cusName == "" || $address == "" || $city == "" || $country == "" || $zipcode == "" || $phone == "" || $email == "" ) {
          $alert = "<span class='error'>Fields name must be not empty</span>";
          return $alert;
        }else {
          $query = "UPDATE tbl_customer SET cusName='$cusName', address='$address', city='$city', country='$country', zipcode='$zipcode', phone='$phone', email='$email' WHERE cusId='$id'" ;
          $result = $this->db->insert($query);
          if ($result) {
            $alert = "<span class='success'>Profile customer update Successfully</span> ";
            return $alert;
          }else {
            $alert = "<span class='error'>Profile customer update not success</span> ";
            return $alert;
          }
        }
      }

   }
?>