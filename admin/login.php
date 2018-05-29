<?php session_start();
if(isset($_SESSION['uid']))
{
    header('Location: index.php');
}
?>
<?php include ('inc/function_ordie.php');?>
<?php include ('inc/connect.php');?>
<html>
    <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng Nhập Quản Trị Shopper</title>
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
</style>
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
            if(empty($_POST['tk']))
            {
                $error[]='tk';
            }   
            else {
                 $tk=$_POST['tk'];
             }
             if(empty($_POST['mk']))
             {
                 $error[]='mk';
             }
            else {
                $mk=md5(trim($_POST['mk']));
            }
            
            
            if(empty($error))
            {
                $query="SELECT id,taikhoan,matkhau,hoten,status FROM db_user WHERE taikhoan='{$tk}' AND matkhau='{$mk}' AND status=1 ";
                $result= mysqli_query($dbc, $query);
                kt_query($result, $query);
                $query_tk="SELECT id,taikhoan,matkhau,hoten,status FROM db_user WHERE taikhoan='{$tk}' AND matkhau='{$mk}'  ";
                $result_tk= mysqli_query($dbc, $query_tk);
                kt_query($result_tk, $query_tk);
                
                if(mysqli_num_rows($result_tk) !=1)
                {
                    $message="<p class='require'>Tài Khoản Hoặc Mật Khẩu Không Đúng</p>";
                }
                elseif (mysqli_num_rows($result)!=1) 
                {
                      $message="<p class='require'>Tài Khoản Chưa được Kích Hoạt <br>Ahihi Nạp 50k để được Kích Hoạt nhé hihi !</p>";
                }
                else
                {
                    if(mysqli_num_rows($result) ==1)
                    {
                        list($id,$tk,$mk,$status)= mysqli_fetch_array($result,MYSQLI_NUM);
                        $_SESSION['uid']=$id;
                        $_SESSION['taikhoan']=$tk;
                        $_SESSION['status']=$status;
                        header('Location: index.php');
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
          <input type="text" name="tk" class="form-control" placeholder=" Tài Khoản" value="<?php if(isset($_POST['tk'])){echo $_POST['tk'];}?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('tk', $error))
                {
                    echo "<p class='require'>Bạn Chưa nhập Tài khoản</p>";
                }
                    
            ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="mk" class="form-control" placeholder="Mật Khẩu">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
               <?php 
                if(isset($error) && in_array('mk', $error))
                {
                    echo "<p class='require'>Bạn Chưa nhập Mật Khẩu</p>";
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
          <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
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
          <a href="register_tv.php" class="text-center">Đắng Kí Thành Viên</a>
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
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>


</body></html>