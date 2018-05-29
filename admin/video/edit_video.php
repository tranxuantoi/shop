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
           $query_id="SELECT * FROM db_video WHERE id={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $video_info= mysqli_fetch_assoc($result_id);
           if(mysqli_num_rows($result_id)==1)
            {
                list($tieude,$link,$thutu,$ngaydang,$status)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id Video Không tồn tại</p>";
              header('Location:list_video.php');
            }  
        }
        else
        {
            header('Location: list_video.php');
            exit();
        }
       
       
              
            
        
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $error=array();

            if(empty($_POST['tieude']))
            {
                $error[]='tieude';

            }
            else
            {
               $tieude= addslashes($_POST['tieude']);
            }
         
            
          
            if(empty($_POST['link']))
            {
                $error[]='link';
            }
            else {
                $link=$_POST['link'];
            }
            $ngaydang=$_POST['ngaydang'];
         
            $status=$_POST['status'];
         
   
            
            if(!empty($error))
            {
                $message1= "<p class='require'>Dữ Liệu Lỗi Không Cập Nhập Được</p>";
            }
            else {
                
                 
               
                $query_update="UPDATE db_video SET tieude='$tieude',ngaydang='{$_POST['ngaydang']}',thutu='{$_POST['thutu']}',status={$_POST['status']} WHERE id={$id}";
                $result_update= mysqli_query($dbc,$query_update);
                kt_query($result_update, $query_update);
                if($result_update){
                    $message= "<p class='thanhcong'> Cập Nhập Thành Công</p>";
                }
                   
                   
            }
        }
         
        
        
        
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Sửa Video</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tiêu Đề</label>

                  <div  class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="tieude" id="taikhoan" value="<?php if(isset($video_info['tieude'])){echo $video_info['tieude'];}?> "  placeholder="Tiều Đề"/>
                                    <?php 
                        if(isset($error) && in_array('tieude', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Tiêu Đề</p>";
                        }
                    ?>
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
        
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Link Video</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="link" id="hoten" placeholder="Nhập Link Link Video" value="<?php if(isset($video_info['link'])){echo $video_info['link'];}?>">
                   <?php 
                        if(isset($error) && in_array('link', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Điền Link Video</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Thứ Tự</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="thutu" id="thutu" placeholder="Nhập Link Thứ Tự" value="<?php if(isset($video_info['thutu'])){echo $video_info['thutu'];}?>">
                   <?php 
                        if(isset($error) && in_array('thutu', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Điền Thứ Tự Nha !!</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                   
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Đăng Video</label>
                  <div class="col-sm-10">
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input readonly class="form-control" type="text" name="ngaydang"  id="ngaydang"  value="<?php if(isset($_POST['ngaydang'])){echo $_POST['ngaydang'];}?>" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
                                 <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Trạng Thái</label>
                 <div class="col-sm-10">
                 <?php 
                    if($video_info['status']==1)
                    {
                        ?>
                        <label class="radio-inline thanhcong"><input type="radio" checked="checked" name="status" value="1"/>Đã Duyệt</label>
                        <label class="radio-inline require"><input type="radio" name="status" value="0"/>Chờ Duyệt</label>
                        <?php 
                    }
                    else 
                    {
                        ?>
                        <label class="radio-inline thanhcong"><input type="radio"  name="status" value="1"/>Kích Hoạt </label>
                        <label class="radio-inline require"><input type="radio" checked="checked" name="status" value="0"/>Chờ Duyệt</label>
                       <?php  
                    }
                    ?>  
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
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Sửa Slider</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>
     