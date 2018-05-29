<?php session_start();
if(isset($_SESSION['uid']))
{
    header('Location: index.php');
}
?>
<?php include './theme/header.php';?>
<?php include './theme/slider.php';?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.1.4/semantic.min.css" />
<script type="text/javascript" src="admin/js/Jquery/lib/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="admin/js/Jquery/dist/jquery.validate.js"></script>
	<style type="text/css">
		.row {
			padding-bottom: 0px !important;
		}
	</style>
<style>
    .bt_dn
    {
        margin: auto;
    }
    .require
    {
        color: red;
        font-size: 16px;
    }
    .thanhcong
    
    {
            color: blue;
        font-size: 16px;
    }
</style>
<?php
 if($_SERVER['REQUEST_METHOD']=='POST')
    {
       
            
            $matkhau= md5(trim($_POST['matkhau']));    
            $email= mysqli_real_escape_string($dbc,$_POST['email']);

                $query_tk="SELECT id_khachhang,email,matkhau,hoten FROM db_khachhang WHERE email='{$email}' AND matkhau='{$matkhau}'  ";
                $result_tk= mysqli_query($dbc, $query_tk);
                kt_query($result_tk, $query_tk);
                
                if(mysqli_num_rows($result_tk) != 1)
                {
                    $message="<p class='require'>Email Hoặc Mật Khẩu Không Đúng</p>";
                }
               
                else
                {
                    if(mysqli_num_rows($result_tk) ==1)
                    {
                        list($id,$email,$matkhau,$status)= mysqli_fetch_array($result_tk,MYSQLI_NUM);
                        $_SESSION['uid']=$id;
                        $_SESSION['email']=$email;
                        header('Location:index.php');
                    }
                        

                }
                    
        }
        
   
 ?>

<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
                                                <form id="signupForm" method="POST" action="" class="ui grid form" style="padding: 10px">
                                                   <div class="row field">
							<label class="six wide column" for="firstname">Email</label>
							<div class="eight wide column">
								<div class="ui input">
									<input id="email" name="email" type="text" placeholder="Email Đăng Kí" />
								</div>
							</div>
						</div>
                                                    <div class="row field">
							<label class="six wide column" for="password">Mật Khẩu</label>
							<div class="eight wide column">
								<div class="ui input">
									<input id="matkhau" name="matkhau" type="password" placeholder="Mật Khẩu" />
								</div>
							</div>
						</div>

					
					

						
                                                <?php 
                                                  if(isset($message))
                                                  {
                                                      echo "<p class='require'>$message</p>";
                                                  }
                                                   if(isset($message1))
                                                  {
                                                      echo "<p class='thanhcong'>$message1</p>";
                                                  }
                                                  ?>
                                                    <button type="submit" name="submit" id="submit" class="bt_dn btn btn-default">Đăng Nhập</button>
                                                 
                                                    <br/>
                                                 
                                                </form>
                                                <br/>
                                                 <div class="form-group">
                                                        <div class="col-sm-6">
                                                            <a href="dangky_kh.php">Đăng Kí Tài Khoản</a>
                                                        </div>
                                                        <div class=" col-sm-6">
                                                            <a  href="quenpass_kh.php">Quên Mật Khẩu</a>
                                                        </div>
                                                       </div>
					</div><!--/login form-->
				</div>
				
			
			</div>
		</div>
<br/>
<script type="text/javascript">

		$( document ).ready( function () {
			$( "#signupForm" ).validate( {
				rules: {
					
				
					matkhau: {
						required: true,
						minlength: 6
					},
				
					email: {
						required: true,
						email: true
					},
					agree: "required"
				},
				messages: {
					
					
					matkhau: {
						required: "Bạn Chưa Nhập Mật Khẩu",
						minlength: "Mật Khẩu Phải Dài Hơn 6 Ký Tự"
					},
				
                                   
                                     
                                  
                                       
                                  
					email: "Vui Lòng Điền Vào Email",
					agree: "Bạn Chưa Đồng Ý"
				},
				errorPlacement: function ( error, element ) {
					error.addClass( "ui red pointing label transition" );
					error.insertAfter( element.parent() );
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".row" ).addClass( errorClass );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".row" ).removeClass( errorClass );
				}
			} );
		} );
                </script>
                <footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer>
