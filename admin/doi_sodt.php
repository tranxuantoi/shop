<?php ob_start();?>
<?php include 'include/header.php';?>
<?php include 'include/sidebar.php';?>
<?php include 'include/main.php';?>



<link rel="stylesheet" href="../css/bootstrap-datepicker.css.map">
  <link rel="stylesheet" href="css/bootstrap.min.css.map">
  <script src="../js/bootstrap-datepicker.js"></script>
 
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.js"></script>
   <script src="../js/jquery.validate.min.js"></script>
   <script src="../js/jquery.validate.js"></script>
   <!-- validate form-->

   <script src="../js/validate_form/dist/jquery.validate.min.js"></script>
   <script src="../js/validate_form/dist/localization/messages_vi.js"></script>
<!--   Date-->
   <script type="text/javascript">
     $(function (){
                $("#datepicker").datepicker({
                    autoclose:true,
                    todayHighlight:true,
                }).datepicker('update', new Date());
            });
   </script>
   <script type="text/javascript">
        
    $(document).ready(function (){
          $('#formtt').validate(
                  {
                     rules:{
                         
                     },
                      sodt:{range [9,11]}
                  }
                );
          
          
       });
   </script>
  
  
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
        
    }
    .thanhcong
    {
        color :green;
        text-align: center;
    }
   .anh_r
   {
        border: solid #8bf5f0 3px;
        height: 200px;
        width: 350px;
   }
</style>
  <?php 
    
    // lay du lieu do vao tai khoan va Kiem tra Bien
         $query_m="SELECT matkhau,email,sodt FROM db_user WHERE id={$_SESSION['uid']}";
            $result_m= mysqli_query($dbc,$query_m);
            kt_query($result_m, $query_m);
            $info = mysqli_fetch_assoc($result_m);

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $error=array();
             $error2=array();
              $error3=array();
              $error4=array();
              // bat loi de trong
           if(filter_var(($_POST['email']),FILTER_VALIDATE_EMAIL)==TRUE)
           {
               $email= mysqli_real_escape_string($dbc,$_POST['email']);
           }
           else
           {
               $error[]='email';
           }
            if(empty($_POST['matkhaucu']))
            {
                $error[]='matkhaucu';
            }
            else {
                   $matkhaucu=md5(trim($_POST['matkhaucu']));
            }
            if(empty($_POST['sodt']))
            {
                $error[]='sodt';
            } else {
                $sodt=$_POST['sodt'];
            }
              
         // bat loi mat khau cu Nguoi co dung khong
            if(md5(trim($_POST['matkhaucu'])) != $info['matkhau'])
            {
                $error2[]='matkhaucu';
            }
            //bat loi email co dung khong
                if($_POST['email'] != $info['email'])
            {
                $error3[]='email';
            }
            //bat loi Sodt ko duoc == ton tai he thong
                if($_POST['sodt'] != $info['sodt'])
                {
                    $query_sodt="SELECT sodt FROM db_user WHERE email='{$_POST['email']}'";
                    $result_sodt= mysqli_query($dbc, $query_sodt);
                    kt_query($result_sodt, $query_sodt);
                    if(mysqli_num_rows($result_sodt)!= 1)
                    {
                        $error4[]='sodt';
                    }
                }
       
            
          
            
            if(!empty($error))
            {
                $message= "<p class='require'> Bạn Phải Đẩy Đủ Thông Tin</p>";
            }
                else {
                    if(!empty($error2))
                    {
                        $message2="<p class='require'>Mật Khẩu Cũ Không Đúng</p>";

                    }

                    else 
                        {
                            if(!empty($error3))
                            {
                                  $message3="<p class='require'>Email Hiện Tại Không Đúng</p>";
                            }
                            else {
                                   if(!empty($error4))
                                   {
                                       $message4 ="<p class='require'>Số Điện Thoại  Đã Tồn Tại Trên Hệ Thống</p>";
                                   }
                                    else {
                                     // lay mat khau tren dua tren id cua Userid ng dang nhap hien tai
                                      $query_mk="SELECT id,matkhau FROM db_user WHERE matkhau=md5('{$_POST['matkhaucu']}') AND id={$_SESSION['uid']}";
                                       $result_mk= mysqli_query($dbc, $query_mk);
                                       kt_query($result_mk, $query_mk);
                                       if(mysqli_num_rows($result_mk)!=1)
                                       {
                                               $error[]="Dữ Liệu Lỗi Không Đổi Được Email";
                                       }
                                       else 
                                        {
                                            $query_up_sodt="UPDATE db_user SET sodt='{$_POST['sodt']}' WHERE id={$_SESSION['uid']} ";
                                                               $result_up_sodt= mysqli_query($dbc,$query_up_sodt);
                                                               kt_query($result_up_sodt, $query_up_sodt);
                                                $message5= "<p class='thanhcong'>Đổi Số Điện Thoại Thành Công</p>";
                                       }  
                                }    
                            }


                     }
               
                   
            }
        }
         
        
        
        
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Đổi Số Điện Thoại</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tài Khoản </label>

                  <div  class="col-sm-10">
                      <input type="text" class="form-control"  name="taikhoan" id="taikhoan" value="<?php if(isset($tk_info)){echo $tk_info['taikhoan'];}?> " readonly placeholder="Tài Khoản"/>
                 
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
             
                     <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Mật Khẩu Cũ</label>

                  <div  class="col-sm-10">
                      <input type="password" class="form-control"  minlength="6" name="matkhaucu" id="matkhaucu" value="" placeholder="Nhập Mật Khẩu Hiện Tại Nha !!"/>
                      <?php 
                        if(isset($error) && in_array('matkhaucu',$error))
                        {
                            echo "<p class='require'>Bạn Chưa Điền Mật Khẩu</p>";
                            
                        }
                        if(isset($message2))
                        {
                            echo $message2;
                        }
//                      
                      ?>
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
                     <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Email Hiện Tại</label>

                  <div class="col-sm-10">
                      <input type="email" class="form-control"  minlength="6" name="email" id="email" placeholder="Nhập Email Đắng Ký" value=""/>
                   <?php 
                       if(isset($error) && in_array('email', $error))
                       {
                            echo "<p class='require'>Bạn Chưa Nhập Email</p>";
                       }
                     if(isset($message3))
                        {
                            echo $message3;
                        }
                          
                    ?>
                 
                    <span id="email_error"></span>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Số Điện Thoại Mới</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" minlength="6"  name="sodt" id="sodt" placeholder="Nhập Số Điện Mới" value=""/>
                   <?php 
                       if(isset($error) && in_array('sodt', $error))
                       {
                            echo "<p class='require'>Bạn Chưa Nhập Số Điện Thoại</p>";
                       }
                      if(isset($message4))
                      {
                          echo $message4;
                      }
                          
                    ?>
                 
                    <span id="email_error"></span>
                  </div>
                </div>
               
            
                  
                        

                   
                <div class="them">
                       <?php 
                 
              if(isset($message))
              {
                  echo $message;
              }
                if(isset($message5))
              {
                  echo $message5;
              }
                ?>
                </div>
              
             
                
              <!-- /.box-body -->
              <div class="box-footer">
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Đôi Mật Khẩu</button>
                 
                  
              </div>
            
              </div>
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include 'include/footer.php';?>
<?php include 'include/control_sidebar.php';?>
<?php ob_flush();?>