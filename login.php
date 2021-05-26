
<?php
   include 'include/header.php';
?>
<?php
  $login_check = Session::get('customer_login');
  if ($login_check) {
    header('Location:order.php');
  }
?>
<?php
    $cus = new customer();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
       
        $insertCus = $cus->insert_customer($_POST); // gọi đến hàm trong class
    }
?>
<?php
    // $cus = new customer();   // triệu gọi class từ file category.php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
       
        $loginCus = $cus->login_customer($_POST); // gọi đến hàm trong class
    }
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Sign In</h3>
        	<p>Sign in with the form below.</p>
        	<?php
	    		if(isset($loginCus)) {
	    			echo $loginCus;
	    		}
    		?>
        	<form action="" method="post">
            	<input type="text" value="email" name="email" class="field" placeholder="Email">
                <input type="password" value="Password" name="password" class="field" placeholder="Password">
	            <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
	            <div class="buttons">
	            	<div>
	                    <input type="submit" class="grey" name="login" value="Sign In">
	                </div>
	            </div>
            </form>
        </div> 
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php
	    		if(isset($insertCus)) {
	    			echo $insertCus;
	    		}
    		?>
    		<form action="" method="post">
		   	<table >
		   		<tbody>
					<tr>
						<td>
							<div>
							    <input type="text" name="name" placeholder="Name" >
							</div>
							
							<div>
							    <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Zipcode">
							</div>

							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			</td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="GL">Gia Lai</option>
							<option value="HCM">Hồ Chí Minh</option>
							<option value="DN">Đà Nẵng</option>
							<option value="HN">Hà Nội</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
  include 'include/footer.php';
?>