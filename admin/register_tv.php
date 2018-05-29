
<?php include ('inc/function_ordie.php');?>
<?php include ('inc/connect.php');?>
<html>
    <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng Kí Quản Trị Shopper</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css.map">
  <link rel="stylesheet" href="css/bootstrap.min.css.map">
  <!--validate ngay dang ki-->
  
  
<!--  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">-->
  <script src="js/bootstrap-datepicker.js"></script>
 
  <script src="js/jquery.min.js"></script>
  

   <script src="js/jquery.validate.min.js"></script>
   <script src="js/jquery.validate.js"></script>
   
  <script src="js/jquery.js"></script>

  
   <!-- validate form-->

  
   <script src="js/validate_form/dist/localization/messages_vi.js"></script>
<style>
    .them
    {text-align: center;}
    .dangki
    {
        text-align: center;
    }
    .require
    {
        color: red;
         text-align: center;
        
    }
    .thanhcong
    {
        color :green;
         text-align: center;
        
    }
   .xn
   {
       margin-left:30px;
   }
   .hoten 
   {
       padding-right:  8%;
   }
</style>
     <script type="text/javascript">
     $(function (){
                $("#datepicker").datepicker({
                    autoclose:true,
                    todayHighlight:true,
                }).datepicker('update', new Date());
            });
   </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php 
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $error=array();
        if(empty($_POST['taikhoan']))
        {
            $error[]='taikhoan';
        }
        else
        {
            $taikhoan=$_POST['taikhoan'];
        }
         if(empty($_POST['sodt']))
        {
            $error[]='sodt';
        }
        else
        {
            $sodt=$_POST['sodt'];
        }
        if(empty($_POST['matkhau']))
        {
            $error[]='matkhau';
        }
        else {
            $matkhau= md5(trim($_POST['matkhau']));
        }
        if(empty($_POST['xnmatkhau']))
        {
            $error[]='xnmatkhau';
        }
         else {
            $xnmatkhau= md5(trim($_POST['xnmatkhau']));
        }
        
        if(md5(trim($_POST['matkhau'])) != md5(trim($_POST['xnmatkhau'])))
        {
            $error[]='xnmatkhau';
        }
          if(empty($_POST['hoten']))
        {
            $error[]='hoten';
        }
        else
        {
            $hoten=$_POST['hoten'];
        }
          if(filter_var(($_POST['email']),FILTER_VALIDATE_EMAIL)==TRUE)
           {
               $email= mysqli_real_escape_string($dbc,$_POST['email']);
           }
           else
           {
               $error[]='email';
           }
       
        if(!empty($error))
        {
             $message1= "<p class='require'>Bạn Phải Điền Đầy Đủ Thông Tin</p>";
        }
        else {
                $query_tk="SELECT taikhoan FROM db_user WHERE taikhoan='{$taikhoan}'";
                $result_tk= mysqli_query($dbc,$query_tk);
                kt_query($result_tk, $query_tk);
                $query_email="SELECT email FROM db_user WHERE email='{$email}'";
                $result_email= mysqli_query($dbc, $query_email);
                kt_query($result_email, $query_email);
                 $query_sodt="SELECT sodt FROM db_user WHERE sodt='{$sodt}'";
                $result_sodt= mysqli_query($dbc,$query_sodt);
                kt_query($result_sodt, $query_sodt);
                if(mysqli_num_rows($result_tk)!="")
                {
                    $message="<p class='require'>Tài Khoản Đã Tồn Tại</p>";
                }
                 elseif(mysqli_num_rows($result_email)!="")
                {
                    $message="<p class='require'>Email Đã Tồn Tại</p>";
                }
                elseif(mysqli_num_rows($result_sodt)!="")
                {
                    $message="<p class='require'>Số Điện Thoại Đã Tồn Tại</p>";
                }
                else{
                    $query_in="INSERT INTO db_user(taikhoan,matkhau,hoten,email,sodt)
                             VALUES ('{$taikhoan}','{$matkhau}','{$hoten}','{$email}','{$sodt}')
                            ";
                           $result_in= mysqli_query($dbc, $query_in);
                           kt_query($result_in, $query_in);
                           if(mysqli_affected_rows($dbc)==1)
                           {
                               $message= "<p class='thanhcong'>Đăng Kí  Thành Công</p>";
                               
                           }
                            else {
                                $message= "<p class='require'>Lỗi Không Đăng Kí Được</p>";
                            }
                }
                    
        }
        
    }
 ?>
   
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <a href="../../index2.html"><b>Shopper Pro Version 9 </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Quản Trị Shopper Pro !!</p>

    <form action="" method="POST">
           <div class="form-group has-feedback">
          <input type="text" name="hoten" class="form-control" placeholder=" Họ Và Tên" value="<?php if(isset($_POST['hoten'])){echo $_POST['hoten'];}?>">
        <span class="fa fa-fw fa-user-plus form-control-feedback hoten"></span>
               <?php 
                if(isset($error) && in_array('hoten', $error))
                {
                    echo "<p class='require'>Bạn Chưa Nhập Họ Và Tên</p>";
                }
                    
            ?>
      </div>
      <div class="form-group has-feedback">
          <input type="text" name="taikhoan" class="form-control" minlength="10" placeholder=" Tài Khoản" value="<?php if(isset($_POST['taikhoan'])){echo $_POST['taikhoan'];}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('taikhoan', $error))
                {
                    echo "<p class='require'>Bạn Chưa nhập Tài khoản</p>";
                }
                    
            ?>
      </div>
      <div class="form-group has-feedback">
          <input type="password" name="matkhau" minlength="6" class="form-control" placeholder="Mật Khẩu">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('matkhau', $error))
                {
                    echo "<p class='require'>Bạn Chưa nhập Mật Khẩu</p>";
                }
                    
            ?>
      </div>
              <div class="form-group has-feedback">
        <input type="password" name="xnmatkhau" minlength="6" class="form-control" placeholder="Xác Nhận Mật Khẩu">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('xnmatkhau', $error))
                {
                    echo "<p class='require'> Mật Khẩu Không Giống Nhau</p>";
                }
                    
            ?>
      </div>
           <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Nhập Email Đắng Ký" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('email', $error))
                {
                    echo "<p class='require'>Bạn Chưa Nhập Email !!!</p>";
                }
                    
            ?>
      </div>
           <div class="form-group has-feedback">
               <input type="text" name="sodt" minlength="9" maxlength="12" class="form-control" placeholder="Nhập Số Điện Thoai Đăng Ký" value="<?php if(isset($_POST['sodt'])){echo $_POST['sodt'];}?>">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('sodt', $error))
                {
                    echo "<p class='require'>Bạn Chưa Nhập Số Điện Thoại</p>";
                }
                    
            ?>
      </div>
         
        
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Ghi Nhớ Tài Khoản
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Đăng Kí</button>
        </div>
        
         
        <!-- /.col -->
      </div>
         <?php 
                    if(isset($message))
                    {
                        echo $message;
                    }
                ?>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

      <div class="form-group">
            <div class="col-xs-6">
        <a href="login.php" class="text-center">Đăng Nhập</a>
    </div>
    <div class="col-xs-6">
        
          <a href="fogot_pass.php">Quên Mật Khẩu</a><br>
    </div>
  
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>

</script>


</body></html>