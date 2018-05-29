<?php include '../include2/header.php';?>
<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>



<!--validate date-->
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
    }
    .thanhcong
    {
        color :green;
    }
   
</style>
 <?php 
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $error=array();
        if(empty($_POST['ten_sp']))
        {
            $error[]='ten_sp';
        }
        else
        {
            $ten_sp=$_POST['ten_sp'];
        }
        if(empty($_POST['ma_sp']))
        {
            $error[]='ma_sp';
        }
        else
        {
            $ma_sp=$_POST['ma_sp'];
        }
        
   
        if(empty($_POST['gia_goc']))
        {
            $error[]='gia_goc';
        }
        else
        {
            $gia_goc=$_POST['gia_goc'];
        }
        if(empty($_POST['gia_km']))
        {
            $error[]='gia_km';
        }
        else
        {
            $gia_km=$_POST['gia_km'];
        }
           if(empty($_POST['soluong']))
        {
            $error[]='soluong';
        }
        else
        {
            $soluong=$_POST['soluong'];
        }
        $ngaydang=$_POST['ngaydang'];
         $parent_id=$_POST['parent'];
        
        if(!empty($error))
        {
             $message1= "<p class='require'>Bạn Phải Điền Đầy Đủ Thông Tin</p>";
        }
        else {
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
                        $link_img='upload/anh_sanpham/'.$img;
                        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/anh_sanpham/".$img);
                    }
                 $query_tk="SELECT ma_sp FROM db_sanpham WHERE ma_sp='{$ma_sp}'";
                $result_tk= mysqli_query($dbc,$query_tk);
                kt_query($result_tk, $query_tk);
                if(mysqli_num_rows($result_tk)!="")
                {
                    $message1="<p class='require'>Mã Sản Phẩm Đã Tồn Tại</p>";
                }
                else{
                    $query_in="INSERT INTO db_sanpham(id_dm_sp,ten_sp,ma_sp,gia_goc,gia_km,soluong,anh,ngaydang)
                             VALUES ('{$parent_id}','{$ten_sp}','{$ma_sp}','{$gia_goc}','{$gia_km}','{$soluong}','{$link_img}','{$ngaydang}')
                            ";
                           $result_in= mysqli_query($dbc, $query_in);
                           kt_query($result_in, $query_in);
                           if(mysqli_affected_rows($dbc)==1)
                           {
                               $message1= "<p class='thanhcong'>Thêm Mới Thành Công</p>";
                               
                           }
                            else {
                                $message1= "<p class='require'>Thêm Mới Không Thành Công</p>";
                            }
                }
                    
        }
        
    }
 ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Thêm Mới Sản Phẩm</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formtt" class="form-horizontal" method="post" name="formtt" enctype="multipart/form-data" >
              <div class="box-body">
                    <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Danh Mục Sản Phẩm</label>
                <div class="col-sm-10">
                <?php selectCtrl_sp('parent'); ?>
                </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tên Sản Phẩm</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="6" class="form-control"  name="ten_sp" id="taikhoan" placeholder="Tên Sản Phẩm" value="<?php if(isset($_POST['ten_sp'])){echo $_POST['ten_sp'];}?>">
                   <?php 
                        if(isset($error) && in_array('ten_sp', $error))
                        {
                            echo "<p class='require'>Tên Sản Phẩm Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                      <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Chọn Ảnh Sản Phẩm</label>
                      <div class="col-sm-10">
                      <input name="img" type="file" class="form-control"/>
                          <?php 
                        if(isset($message))
                        {
                            echo "<p class='require'>$message</p>";
                        }
                      ?>
                      </div>
                  
                  </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mã Sản Phẩm</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="6" class="form-control"  name="ma_sp" id="ma_sp" placeholder="Nhập Mã Sản phẩm" value="<?php if(isset($_POST['ma_sp'])){echo $_POST['ma_sp'];}?>">
                   <?php 
                        if(isset($error) && in_array('ma_sp', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Tên Mã Sản Phẩm</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Giá Gốc</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="gia_goc" id="gia_goc" placeholder="Nhập Giá Gốc" value="<?php if(isset($_POST['gia_goc'])){echo $_POST['gia_goc'];}?>">
                    <?php 
                        if(isset($error) && in_array('gia_goc', $error))
                        {
                            echo "<p class='require'>Giá Gốc Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
                  </div>
                </div>
                      <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Giá Khuyến Mại</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="gia_km" id="gia_goc" placeholder="Nhập Giá Khuyến Mại" value="<?php if(isset($_POST['gia_km'])){echo $_POST['gia_km'];}?>">
                    <?php 
                        if(isset($error) && in_array('gia_km', $error))
                        {
                            echo "<p class='require'>Giá Khuyến Mại Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Số Lượng</label>

                  <div class="col-sm-10">
                      <input type="number" class="form-control" class="required email" name="soluong" id="soluong" placeholder="Nhập Số Lượng" value="<?php if(isset($_POST['soluong'])){echo $_POST['soluong'];}?>">
                    <?php 
                        if(isset($error) && in_array('soluong', $error))
                        {
                            echo "<p class='require'>Số Lượng Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
                  </div>
                </div>
               
                 
                 <input type="hidden" name="ngaydang" value="<?php
                    $date=date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngayht=date('Y-m-d');
                   echo $ngayht;
                 ?>"/>
                 
          
        
              
                  <!-- Validate FORM 
                  validate email-->
                 
                  
          
                <!-- /.input group -->
              
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
                  
                  <button id="submit"  name="submit" type="submit" class="btn btn-info center-block" >Thêm Mới Sản Phẩm</button>
                 
                  
              </div>
              
            </div>
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
            