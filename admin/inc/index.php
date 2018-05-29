
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Ðang Kí Tài Kho?n</title>
    <style type="text/css">
     
    .require
    {
        color: red;
    }
    .thanhcong
    {
        color: blue;
    }
    .banner
    {
        text-align: center;
        }
</style>
</head>
<?php include('../inc/connect.php');?>
<?php include('../inc/function_ordie.php');?>

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
            if(empty($_POST['matkhau']))
            {
                $error[]='matkhau';
            }
            else 
            {
                $matkhau= md5(trim($_POST['matkhau']));
            }
            if(trim($_POST['matkhau']) != trim($_POST['xnmatkhau'])) 
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
             if(empty($_POST['sodt']))
            {
                $error[]='sodt';    
            }
            else 
            {
                $sodt=$_POST['sodt'];
            }
            
           if(filter_var(($_POST['email']),FILTER_VALIDATE_EMAIL)==TRUE)
           {
               $email= mysqli_real_escape_string($dbc,$_POST['email']);
           }
           else
           {
               $error[]='email';
           }
            if(empty($_POST['diachi']))
            {
                $error[]='diachi';
            }
            else {
                $diachi=$_POST['diachi'];
            }
            $status=$_POST['status'];
            if(empty($error))
            {
               
                $query="SELECT taikhoan FROM db_user WHERE taikhoan='{$taikhoan}'";
                $result= mysqli_query($dbc,$query);
                kt_query($result, $query);
                $query2="SELECT email FROM db_user WHERE email='{$email}'";
                $result2= mysqli_query($dbc, $query2);
                kt_query($result2, $query2);
                $query3="SELECT sodt FROM db_user WHERE sodt='{$sodt}'";
                $result3= mysqli_query($dbc,$query3);
                kt_query($result3,$query3);
                        
                if(mysqli_num_rows($result)==1)
                {
                    $message="<p class='require'>Tài Kho?n Ðã T?n T?i</p>";
                }
             
                elseif(mysqli_num_rows($result2) ==1) 
                {
                    $message2="<p class=require> Email Ðã T?n T?i</p>";
                }
                      elseif(mysqli_num_rows($result3)==1)
                {
                      $message3="<p class=require>  S? Ði?n Thoai Ðã T?n T?i</p>";
                }
                else{
                    $query_in="INSERT INTO db_user(taikhoan,matkhau,hoten,sodt,email,diachi,status)
                             VALUES ('{$taikhoan}','{$matkhau}','{$hoten}','{$sodt}','{$email}','{$diachi}','{$status}')
                            ";
                           $result_in= mysqli_query($dbc, $query_in);
                           kt_query($result_in, $query_in);
                           if(mysqli_affected_rows($dbc)==1)
                           {
                               echo "<p class='thanhcong'>Thêm M?i Thành Công</p>";
                           }
                            else {
                                echo "<p class='require'>Thêm M?i Không Thành Công</p>";
                            }
                }
                 
                
            }
            else {
                echo "<p class='require'>B?n Hãy Ði?n Ð?y Ð? Thông tin</p>";
            }
               
        }
        
    ?>
	 <?php include('includes/footer.php'); ?> 
</html>
