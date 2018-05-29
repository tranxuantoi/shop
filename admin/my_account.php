<?php ob_start();?>
<?php include 'include/header.php';?>
<?php include 'include/sidebar.php';?>
<?php include 'include/main.php';?>



<link rel="stylesheet" href="css/bootstrap-datepicker.css.map">
  <link rel="stylesheet" href="css/bootstrap.min.css.map">
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.min.js"></script>

   <!-- validate form-->
  <script src="js/jquery.js"></script>
   <script src="js/jquery.validate.min.js"></script>
   <script src="js/jquery.validate.js"></script>
   <!-- -->
   <script src="js/validate_form/dist/jquery.validate.min.js"></script>
   <script src="js/validate_form/dist/localization/messages_vi.js"></script>
<!--   Date-->

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
    }
   .anh_r
   {
        border: solid #8bf5f0 3px;
        height: 200px;
        width: 350px;
   }
</style>
 <?php 
    
    // kiem tra id co phai kieu so ko
       
        
       
       
              
    
        
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $error=array();

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
            $ngay_dangky=$_POST['ngaydangky'];
         
           
             $img=$_FILES['img']['name'];
            if($_POST['sodt'] != $tk_info['sodt'])
                {
                    $query_sodt="SELECT sodt FROM db_user WHERE sodt='{$_POST['sodt']}'";
                    $result_sodt= mysqli_query($dbc,$query_sodt);
                    kt_query($result_sodt, $query_sodt);
                    
                      if(mysqli_num_rows($result_sodt) ==1)
                    {
                          $error[]='sodt';
                    }
                }
              
                if ($_POST['email'] != $tk_info['email'])
                {
                    $query_e="SELECT email FROM db_user WHERE email='{$_POST['email']}'";
                    $result_e= mysqli_query($dbc,$query_e);
                    kt_query($result_e, $query_e);
                    if(mysqli_num_rows($result_e) >0)
                    {
                         $error[] = "email";
                    }
                }
                
            
            if(!empty($error))
            {
                $message1= "<p class='require'>Dữ Liệu Lỗi Không Cập Nhập Được</p>";
            }
            else {
                
                 if($_FILES['img']['size']== '')
                {
                     $link_img=$_POST['anh'];
                    
                }
                // up anh
                if(($_FILES['img']['type'] !="image/gif")
                    && ($_FILES['img']['type'] !="image/png")
                    && ($_FILES['img']['type'] !="image/jpg")
                    && ($_FILES['img']['type'] !="image/jpeg"))
                {
                    $message ="File Không Đúng Định dạng";
                }
                elseif ($_FILES['img']['size'] >10000000) {
                    $message="File phải nhỏ hơn 10B";
                 }
                elseif($_FILES['img']['size']==0)
                {
                    $message=" Bạn Chưa Chọn file ảnh";
                }
                else
                    {
                        $img=$_FILES['img']['name'];
                        $link_img='upload/anh_user/'.$img;
                        move_uploaded_file($_FILES['img']['tmp_name'],"upload/anh_user/".$img);
                    }
                 
               
                $query_update="UPDATE db_user SET hoten='{$_POST['hoten']}',diachi='{$_POST['diachi']}',anh='{$link_img}' WHERE id={$_SESSION['uid']}";
                $result_update= mysqli_query($dbc,$query_update);
                kt_query($result_update, $query_update);
                if($result_update){
                    $message= "<p class='thanhcong'> Cập Nhập Thành Công</p>";
                }
                   
                   
            }
        }
         
        
        
        
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Thông Tin Tài Khoản</h2>
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
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-8">
                      <input type="email" class="form-control"  name="email" id="email" placeholder="Nhập Email"  readonly value="
                          <?php 
                   
                            if(isset($tk_info['email']))
                          {
                                $email_in=$tk_info['email'];
                                $email_cat= substr($email_in,0,3);
                                $email_cat2= substr($email_in,-13); 
                                echo $email_cat;
                                echo '*******';
                                echo $email_cat2;    
                          }
                          ?>"/>
                   <?php 
                        if(isset($error) && in_array('email', $error))
                        {
                            echo "<p class='require'>Email  Đã Tồn Tại Trên Hệ Thống</p>";
                        }
                    ?>
                 
                    <span id="email_error"></span>
                  </div>
                     <div class="col-sm-2">
                         <button id="submit" class="btn btn-block btn-danger" ><a href="doi_email.php">Đổi Email Đăng Kí</a></button>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Số Điện Thoại</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control"  name="sodt" id="sodt"  readonly placeholder="Nhập Số Điện Thoại" value="<?php if(isset($tk_info['sodt'])){$sodt_in=$tk_info['sodt'];$sodt_cat= substr($sodt_in,-3);echo "********";echo $sodt_cat;}?>"/>
                    <?php 
                        if(isset($error) && in_array('sodt', $error))
                        {
                           echo "<p class='require'>Số Điện  Đã Tồn Tại Trên Hệ Thống</p>";
                        }
                    ?>
                 
                   
                    <span id="phone_error"></span>
                  </div>
                     <div class="col-sm-2">
                        
                             <button id="submit" class="btn btn-block btn-danger" > <a href="doi_sodt.php">Đổi Số Điện Thoại</a></button>
                                           

                  </div>
                </div>

                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Họ Và Tên</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="hoten" id="hoten" placeholder="Nhập Số Họ Và Tên" value="<?php if(isset($tk_info['hoten'])){echo $tk_info['hoten'];}?>">
                   <?php 
                        if(isset($error) && in_array('hoten', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Điền Họ Tên</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                  
                       
                     <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Địa Chỉ</label>

                  <div class="col-sm-10">
                      <input type="text"   class="form-control" id="inputPassword3" name="diachi" id="diachi" placeholder="Nhập Địa Chỉ" value="<?php if(isset($tk_info['diachi'])){echo $tk_info['diachi'];}?>">
                 
                    <span id="phone_error"></span>
                  </div>
                  
                </div>
                 <div class="form-group">
                 
                     <label class="col-sm-2 control-label">Chọn Ảnh Đại Diện</label>
                     <div class="col-sm-10">
                 <img class="anh_r" src="<?php echo $tk_info['anh'];?>" />
                 <input type="file" name="img" value="<?php echo $tk_info['anh'];?>" />
                 <input type="hidden" name="anh" value="<?php echo $tk_info['anh'];?>"/>
                
                    </div>
                 
               
            </div>
                   
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Đăng Kí</label>
                  <div class="col-sm-10">
                  <div  class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input readonly class="form-control" type="text" name="ngaydangky"  id="ngaydangky" value="<?php if(isset($tk_info['ngay_dangky'])){echo $tk_info['ngay_dangky'];}?>"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
                    <script type="text/javascript">
     $(function (){
                $("#datepicker").datepicker({
                    autoclose:true,
                    todayHighlight:true,
                }).datepicker('update', new Date());
            });
   </script>
                
           
                  <!-- Validate FORM 
                  validate email-->
                 
                  
          
                <!-- /.input group -->
              </div>
                <div class="them">
                       <?php 
                 
              if(isset($message))
              {
                  echo $message;
              }
                if(isset($message1))
              {
                  echo $message1;
              }
                ?>
                </div>
              
             
                
              <!-- /.box-body -->
              <div class="box-footer">
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Cập Nhập Tài Khoản</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include 'include/footer.php';?>
<?php include 'include/control_sidebar.php';?>
<?php ob_flush();?>