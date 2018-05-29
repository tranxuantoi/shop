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
           $query_id="SELECT * FROM db_dm_sanpham WHERE id={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $dm_info= mysqli_fetch_assoc($result_id);
           if(mysqli_num_rows($result_id)==1)
            {
                    list($parent_id,$tendm,$thutu,$status)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id Danh Mục Không tồn tại</p>";
              header('Location:list_dm_sanpham.php');
            }  
        }
        else
        {
            header('Location: list_dm_sanpham.php');
            exit();
        }
       
       
              
            
        
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $error=array();

            if(empty($_POST['tendm']))
            {
                $error[]='tendm';

            }
            else
            {
               $tendm= addslashes($_POST['tendm']);
            }
              if(empty($_POST['thutu']))
            {
                $error[]='thutu';

            }
            else
            {
               $thutu= addslashes($_POST['thutu']);
            }
            $status=$_POST['status'];     
            if(!empty($error))
            {
                $message1= "<p class='require'>Dữ Liệu Lỗi Không Cập Nhập Được</p>";
            }
            else {
                if($_POST['parent']==0)
                {
                    $parent_id=0;
                }
                else 
                {
                   $parent_id = $_POST['parent'];
                }
                $query_update="UPDATE db_dm_sanpham SET tendm='$tendm',thutu='{$_POST['thutu']}',status={$_POST['status']},parent_id={$parent_id} WHERE id={$id}";
                $result_update= mysqli_query($dbc,$query_update);
                kt_query($result_update, $query_update);
                if($result_update){
                    $message= "<p class='thanhcong'> Cập Nhập Thành Công</p>";
                }
                   
                   
            }
        }
         
        
        
        
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Sửa Danh Mục Sản Phẩm</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" name="formtt" id="formtt" enctype="multipart/form-data">
              <div class="box-body">
                     <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Danh Mục Cha</label>
                <div class="col-sm-10">
                <?php selectCtrl('parent'); ?>
                </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tên Danh Mục</label>

                  <div  class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="tendm" id="taikhoan" value="<?php if(isset($dm_info['tendm'])){echo $dm_info['tendm'];}?> "  placeholder="Tên Danh Mục"/>
                                    <?php 
                        if(isset($error) && in_array('tendm', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Tên Danh Mục</p>";
                        }
                    ?>
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
      
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Thứ Tự</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="thutu" id="thutu" placeholder="Nhập Link Thứ Tự" value="<?php if(isset($dm_info['thutu'])){echo $dm_info['thutu'];}?>">
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
                 <label for="inputPassword3" class="col-sm-2 control-label">Trạng Thái</label>
                 <div class="col-sm-10">
                 <?php 
                    if($dm_info['status']==1)
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
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Sửa Danh Mục</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>
     