<?php include './theme/header.php';?>
<?php include './theme/slider.php';?>
<style>
    .submit_lh
    {
       margin-right:40%;
    }
</style>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $hoten=$_POST['hoten'];
    $sodt=$_POST['sodt'];
    $email=$_POST['email'];
    $noidung=$_POST['noidung'];
    $ngaydang=$_POST['ngaydang'];
    $query_lh="INSERT INTO db_lienhe (hoten,sodt,email,noidung,ngaygui) VALUES('{$hoten}','{$sodt}','{$email}','{$noidung}','{$ngaydang}')";
    $result_lh= mysqli_query($dbc,$query_lh);
    kt_query($result_lh, $query_lh);
    if ($result_lh)
    {
        echo "<script>alert('Cảm Ơn Bạn Đã Góp Ý !!!');</script>";
    }
}
?>
<div id="contact-page" class="container">
    	<div class="bg">
	    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Liên Hệ Với Chúng Tôi</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="hoten" class="form-control" required="required" placeholder="Họ Và Tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="text" name="sodt" class="form-control" required="required" placeholder="Số Điện Thoại">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="noidung" id="message" required="required" class="form-control " rows="8" placeholder="Nội Dung"></textarea>
				            </div>                        
				            <div class="form-group col-md-12 ">
				                <input type="submit" name="submit" class="btn btn-primary pull-right submit_lh"  value="Gủi Liên Hệ">
				            </div>
                                                <input type="hidden" name="ngaydang" value="<?php
                                                    $date=date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    $ngayht=date('Y-m-d');
                                                   echo $ngayht;
                                                 ?>"/>
                 
                                            </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Thông Tin Liên Hệ</h2>
	    				<address>
	    					<p>BeShop</p>
							<p>88 Giáp Nhị Thịnh Liệt Hoàng Mai Hà Nội</p>
							<p>Hà Nội Việt Nam</p>
							<p>Moblie : 01625299998</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: tranxuantoi2016@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div>


<?php include './theme/footer.php';?>
