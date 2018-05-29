<?php ob_start();?>
<?php include '../include2/header.php';?>
<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>


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
        text-align: center;
    }
     .require1
    {
        color: red;
        
    }
    .thanhcong
    {
        color :green;
                text-align: center;
    }
   
</style>
 <?php 
    if($_GET['id'] && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min-range'=>1)))
    {
        $id=$_GET['id'];
    }
    else {
         header('Location: list_user.php');
        exit();
       
   }
    $query_tk="SELECT id,taikhoan FROM db_user WHERE id={$id}";
       $result_tk= mysqli_query($dbc,$query_tk);
       kt_query($result_tk, $query_tk);
      
       if(mysqli_num_rows($result_tk)==1)
       {
           list($id,$taikhoan)= mysqli_fetch_array($result_tk,MYSQLI_NUM);
       }
        else {
           $message3="<p class='require'>ID Tài Khoản Không Tồn Tại</p>";

       }
        
      
   if($_SERVER['REQUEST_METHOD']=='POST')
   {
      $error=array();
      if(empty($_POST['matkhaumoi']))
      {
          $error[]='matkhaumoi';
      }
       else {
          $matkhaumoi=md5(trim($_POST['matkhaumoi']));
      }
      if(md5(trim($_POST['matkhaumoi'])) != md5(trim($_POST['cmatkhau'])))
      {
          $error[]='cmatkhau';
      }
      else {
        $cmatkhau=md5(trim($_POST['cmatkhau']));
      }
      if(!empty($error))
      {
          $message2="<p class='require'>Bạn Hãy Điền Đầy đủ thông tin</p>";
  
      }
      else {
            
            $query_up="UPDATE db_user SET matkhau='{$matkhaumoi}' WHERE id={$id} ";
             $result_up= mysqli_query($dbc,$query_up);
             kt_query($result_up, $query_up);
             $message1="<p class='thanhcong'>Đổi Mật Khẩu Thành Công!!!</p>";
             
      }
   }
?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Resset Mật Khẩu</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tài Khoản </label>

                  <div  class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="taikhoan" id="taikhoan" value="<?php if(isset($taikhoan)){echo $taikhoan;}?> " readonly placeholder="Tài Khoản"/>
                 
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
                     <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Mật Khẩu Mới</label>

                  <div  class="col-sm-10">
                      <input type="password" class="form-control" id="inputEmail3" minlength="6" name="matkhaumoi" id="matkhau" value="" />
                      <?php 
                        if(isset($error) && in_array('matkhaumoi',$error))
                        {
                            echo "<p class='require1'>Bạn Chưa Điền Mật Khẩu</p>";
                        }
                      ?>
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Xác Nhận Mật Khẩu</label>

                  <div  class="col-sm-10">
                      <input type="password" class="form-control" id="inputEmail3" minlength="6" name="cmatkhau" id="cmatkhau" value="" />
                  <?php 
                        if(isset($error) && in_array('cmatkhau',$error))
                        {
                            echo "<p class='require1'>Mật Khẩu Không Giống Nhau</p>";
                        }
                      ?>
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
               

                   
                  
                    
                
                 
                 
               
          
               
           
                  <!-- Validate FORM 
                  validate email-->
                 
                  
          
                <!-- /.input group -->
              </div>
               
              
             <?php
              if(isset($message3))
             {
                 echo $message3;
             }
                 if(isset($message2))
             {
                 echo $message2;
             }
                     if(isset($message1))
             {
                 echo $message1;
             }
             
           ?>
                
              <!-- /.box-body -->
              <div class="box-footer">
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Resset Mật Khẩu</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>