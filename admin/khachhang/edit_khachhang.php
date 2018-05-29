<?php ob_start();?>
<?php include '../include2/header.php';?>
<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>




 
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
    }
   .anh_r
   {
        border: solid #8bf5f0 3px;
        height: 200px;
        width: 350px;
   }
    .check_item
        {
            width: 100%;
            background: #bdfceb;
            padding: 0 10px;
            margin-bottom: 15px;
            height: 40px;
            line-height:40px;
        }
        .check_item_all
        {
            width: 100%;
            background: #1be3f0;
            padding: 0 10px;
            margin-bottom: 15px;
            height: 50px;
            line-height:50px;
            text-align: center;
            font-family: Tahoma;
            font-size: 20px;
        }
</style>
<script language="javascript">
    function checkall(class_name,obj)
    {
        var items = document.getElementsByClassName(class_name);
        if(obj.checked == true)
        {
            for(i=0;i<items.length; i++)
            
                items[i].checked =true;
            
        }
        else
        {
            for(i=0;i<items.length; i++)
            
                items[i].checked =false;
            
        }
    }
</script>
 <?php 
    
    // kiem tra id co phai kieu so ko
        if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min-range'=>1)))
        {
            $id = $_GET['id'];
            // do du lieu vao cac cot
           $query_id="SELECT * FROM db_khachhang WHERE id_khachhang={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $taikhoan_info = mysqli_fetch_assoc($result_id);
           if(mysqli_num_rows($result_id)==1)
            {
                list($hoten,$email,$sodt,$diachi)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id Khách Hàng Không tồn tại</p>";
              header('Location:list_khachhang.php');
            }  
        }
        else
        {
            header('Location: list_khachhang.php');
            exit();
        }
       
       
              
            
        
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
           
        
              
                if ($_POST['sodt'] != $taikhoan_info['sodt'])
                {
                    $query_e="SELECT sodt FROM db_khachhang WHERE sodt='{$_POST['sodt']}'";
                    $result_e= mysqli_query($dbc,$query_e);
                    kt_query($result_e, $query_e);
                    if(mysqli_num_rows($result_e) >0)
                    {
                         $error[] = "sodt";
                    }
                }
                
            
            if(!empty($error))
            {
                $message1= "<p class='require'>Dữ Liệu Lỗi Không Cập Nhập Được</p>";
            }
            else {
               
            
                $query_update="UPDATE db_khachhang SET ten_khachhang='{$_POST['hoten']}',sodt='{$_POST['sodt']}',email='{$_POST['email']}',diachi='{$_POST['diachi']}' WHERE id_khachhang={$id}";
                $result_update= mysqli_query($dbc,$query_update);
                kt_query($result_update, $query_update);
                if($result_update){
                    echo "<script>alert('Cập Nhập Thành Công Rồi Nhé !!');setTimeout(function(){window.location='list_khachhang.php' }, 500);</script>";
                }
                   
                   
            }
        }
         
        
        
        
    ?>

   
              
            <div class="box-header with-border">
              <h2 class="them">Sửa Tải Khoản</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
            
               

                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Họ Và Tên</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="hoten" id="hoten" placeholder="Nhập Số Họ Và Tên" value="<?php if(isset($taikhoan_info['ten_khachhang'])){echo $taikhoan_info['ten_khachhang'];}?>">
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
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputPassword3" readonly="" name="email" id="email" placeholder="Nhập Email" value="<?php 
                    if(isset($taikhoan_info['email'])){echo $taikhoan_info['email'];}?>">
                   <?php 
                        if(isset($error) && in_array('email', $error))
                        {
                            echo "<p class='require'>Email  Đã Tồn Tại Trên Hệ Thống</p>";
                        }
                    ?>
                 
                    <span id="email_error"></span>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Số Điện Thoại</label>

                  <div class="col-sm-10">
                      <input type="text"  minlength="9" maxlength="12" class="form-control" id="inputPassword3" name="sodt" id="sodt" placeholder="Nhập Số Điện Thoại" value="<?php if(isset($taikhoan_info['sodt'])){echo $taikhoan_info['sodt'];}?>">
                     <?php 
                        if(isset($error) && in_array('sodt', $error))
                        {
                           echo "<p class='require'>Số Điện  Đã Tồn Tại Trên Hệ Thống</p>";
                        }
                    ?>
                 
                   
                    <span id="phone_error"></span>
                  </div>
                  
                </div>
                     <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Địa Chỉ</label>

                  <div class="col-sm-10">
                      <input type="text"   class="form-control" id="inputPassword3" name="diachi" id="diachi" placeholder="Nhập Địa Chỉ" value="<?php if(isset($taikhoan_info['diachi'])){echo $taikhoan_info['diachi'];} if(isset($_POST['diachi'])){echo $_POST['diachi'];}?> ">
                 
                    <span id="phone_error"></span>
                  </div>
                  
                </div>
            
                   
      
              
             
            
            
           
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
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Sửa Tài Khoản</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>