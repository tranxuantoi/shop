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
        width: 80%;
   }
</style>
 <?php 
    
    // kiem tra id co phai kieu so ko
        if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min-range'=>1)))
        {
            $id = $_GET['id'];
            // do du lieu vao cac cot
           $query_id="SELECT * FROM db_lienhe WHERE id={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $slider_info= mysqli_fetch_assoc($result_id);
            $query_status="UPDATE db_lienhe SET status=1 WHERE id={$id}" ;    
           $result_status= mysqli_query($dbc,$query_status);
            $update_status= mysqli_fetch_assoc($result_id);
           if(mysqli_num_rows($result_id)==1)
            {
                list($hoten,$email,$sodt,$noidung,$ngaygui,$status)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id Khách Liên Hệ Không tồn tại</p>";
              header('Location:list_lienhe.php');
            }  
        }
        else
        {
            header('Location: list_lienhe.php');
            exit();
        }    
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Sửa Slider</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tên Khách Hàng</label>

                  <div  class="col-sm-10">
                      <input type="text" readonly class="form-control" id="inputEmail3" name="hoten" id="hoten" value="<?php if(isset($slider_info['hoten'])){echo $slider_info['hoten'];}?> "  placeholder="Tiều Đề"/>
                   
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
            
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                      <input type="text" readonly="" class="form-control" id="inputPassword3" name="email" id="email" placeholder="Nhập Link Link SLIDER" value="<?php if(isset($slider_info['email'])){echo $slider_info['email'];}?>">
                    <span id="phone_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Số Điện Thoại</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" readonly="" id="inputPassword3" name="sodt" id="sodt" placeholder="Nhập Link Thứ Tự" value="<?php if(isset($slider_info['sodt'])){echo $slider_info['sodt'];}?>">
     
                    <span id="phone_error"></span>
                  </div>
                </div>
                   
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Gửi</label>
                  <div class="col-sm-10">
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input readonly class="form-control" type="text" name="ngaydang"  id="ngaydang"  value="<?php if(isset($slider_info['ngaygui'])){echo $slider_info['ngaygui'];}?>" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
                  <div class="form-group">
                       <label for="inputPassword3" class="col-sm-2 control-label">Nội Dung</label>
                       <div class="col-sm-10">
                       <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">Nội Dung</a></li>

              
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab_1">
                  <?php echo $slider_info['noidung'];?>

           
         
            </div>
            <!-- /.tab-content -->
          </div>
                  </div>
                       </div>

              </div>
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
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Sửa Slider</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>
     