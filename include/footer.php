<?php
   $cat = new category();
?>
</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>THÔNG TIN</h4>
						<ul>
						<li><a href="#">Nhóm 8</a></li>
						<li><a href="#">KTX Khu A - ĐH Quốc Gia</a></li>
						<li><a href="#"><span>Linh Trung, Thủ Đức, TP HCM</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>VỀ BAKER ABC</h4>
						<ul>
						<li><a href="#">Baker ABC là một cửa hàng mới nổi</a></li>
						<li><a href="#">Với những sản phẩm thơm ngon, bổ dưỡng</a></li>
						<li><a href="#">Giá cả hợp lý</a></li>
						<li><a href="#"><span>Nhiều ưu đãi hấp dẫn</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>SẢN PHẨM</h4>
						<ul>
							<?php
							    $get_all_category = $cat->show_category_frontend();
							  	if ($get_all_category) {
							  		while ($result_allcat = $get_all_category->fetch_assoc()) {
							 ?>
							<li><a href="productbycat.php?catid=<?php echo $result_allcat['catId']?>"><?php echo $result_allcat['catName']?></a></li>
							 <?php
						      	}
							  	}
						      ?>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>HỖ TRỢ KHÁCH HÀNG</h4>
						<ul>
							<li><span>Hostline:0327151365</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Nhóm 8 </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
