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
</style>
 <?php 
    
    // kiem tra id co phai kieu so ko
        if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min-range'=>1)))
        {
            $id = $_GET['id'];
            // do du lieu vao cac cot
           $query_id="SELECT * FROM db_sanpham WHERE id_sanpham={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $sp_info = mysqli_fetch_assoc($result_id);
         
           if(mysqli_num_rows($result_id)==1)
            {
                list($id_sanpham,$ten_sp,$anh,$ma_sp,$gia_goc,$gia_km,$soluong,$trangthai,$ngaydang)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id Sản Phẩm Không tồn tại</p>";
              header('Location:list_sanpham.php');
            }  
        }
        else
        {
            header('Location: list_sanpham.php');
            exit();
        }
       
       
              
            
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
      
            $soluong=$_POST['soluong'];
      
             $parent_id=$_POST['parent'];
            $mota=$_POST['mota'];
            $baohanh=$_POST['baohanh'];
            $khuyenmai=$_POST['khuyenmai'];
            $xuatxu=$_POST['xuatxu'];
            $size=$_POST['size'];
            $mausac=$_POST['mausac'];
             $chitiet=$_POST['chitiet'];
          if($_POST['ma_sp'] != $sp_info['ma_sp'])
                {
                    $query_sodt="SELECT ma_sp FROM db_sanpham WHERE ma_sp='{$_POST['ma_sp']}'";
                    $result_sodt= mysqli_query($dbc,$query_sodt);
                    kt_query($result_sodt, $query_sodt);
                    if(mysqli_num_rows($result_sodt) ==1)
                    {
                          $error[]='ma_sp';
                    }
                }
        if(!empty($error))
        {
             $message= "<p class='require'>Bạn Phải Điền Đầy Đủ Thông Tin</p>";
        }
        else {
//             $query_in="INSERT INTO db_ct_sanpham(mota,baohanh,khuyenmai,xuatxu,size,mausac,chitiet)
//                             VALUES ('{$mota}','{$baohanh}','{$khuyenmai}','{$xuatxu}','{$size}','{$mausac}','{$chitiet}')
//                            ";
//               $result_in= mysqli_query($dbc, $query_in);
//                kt_query($result_in, $query_in);
//               $query_ct="UPDATE db_ct_sanpham SET mota='{$_POST['mota']}',baohanh='{$_POST['baohanh']}',khuyenmai='{$_POST['khuyenmai']}',xuatxu='{$_POST['xuatxu']}',size='{$_POST['size']}',mausac='{$_POST['mausac']}',chitiet='{$_POST['chitiet']}' WHERE id_sanpham={$id}";
//               $result_ct= mysqli_query($dbc, $query_ct);
//                kt_query($result_ct, $query_ct);
               
                if($_FILES['img']['size']== '')
                {
                     $link_img=$_POST['anh'];
                    
                }
                elseif(($_FILES['img']['type'] !="image/gif")
                    && ($_FILES['img']['type'] !="image/png")
                    && ($_FILES['img']['type'] !="image/jpg")
                    && ($_FILES['img']['type'] !="image/jpeg"))
                {
                    $message3 ="File Không Đúng Định dạng";
                }
                elseif ($_FILES['img']['size'] >10000000) {
                    $message3="File phải nhỏ hơn 10B";
                 }
               
                else
                {
                        $img=$_FILES['img']['name'];
                        $link_img='upload/anh_sanpham/'.$img;
                        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/anh_sanpham/".$img);
                }
              
                    $query_update="UPDATE db_sanpham SET id_dm_sp='{$parent_id}',ten_sp='{$_POST['ten_sp']}'
                    ,ma_sp='{$_POST['ma_sp']}',gia_goc='{$_POST['gia_goc']}',gia_km='{$_POST['gia_km']}',
                    anh='{$link_img}',soluong='{$_POST['soluong']}', 
                    mota='{$_POST['mota']}',baohanh='{$_POST['baohanh']}',khuyenmai='{$_POST['khuyenmai']}',xuatxu='{$_POST['xuatxu']}',
                    size='{$_POST['size']}',mausac='{$_POST['mausac']}',chitiet='{$_POST['chitiet']}'
                    WHERE id_sanpham={$id}";
                           $result_update= mysqli_query($dbc, $query_update);
                           kt_query($result_update, $query_update);
                         
                           if($result_update)
                           {
                               $message1= "<p class='thanhcong'>Sửa  Thành Công</p>";
                               echo "<script>alert('Sửa Thành Công !!!')</script>";
                           }
                         
                    
        }
        
    }
        
    ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Chi Tiết Sản Phẩm</h2>
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
                      <input type="text" minlength="6" class="form-control"  name="ten_sp" id="taikhoan" placeholder="Tên Sản Phẩm" value="<?php if(isset($sp_info['ten_sp'])){echo $sp_info['ten_sp'];}?>">
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
                         <img class="anh_r" src="../<?php echo $sp_info['anh'];?>" />
                            <input type="hidden" name="anh" value="<?php echo $sp_info['anh'];?>"/>
                      <input name="img" type="file" class="form-control"/>
                          <?php 
                        if(isset($message3))
                        {
                            echo "<p class='require'>$message3</p>";
                        }
                      ?>
                      </div>
                  
                  </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mã Sản Phẩm</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="6" class="form-control"  name="ma_sp" id="ma_sp" placeholder="Nhập Mã Sản phẩm" value="<?php if(isset($sp_info['ma_sp'])){echo $sp_info['ma_sp'];}?>">
                   <?php 
                        if(isset($error) && in_array('ma_sp', $error))
                        {
                            echo "<p class='require'>Mã Sản Phẩm Đã Tồn Tại Trên Hệ Thống</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Giá Gốc</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="gia_goc" id="gia_goc" placeholder="Nhập Giá Gốc" value="<?php if(isset($sp_info['gia_goc'])){echo $sp_info['gia_goc'];}?>">
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
                      <input type="text" class="form-control" class="required email" name="gia_km" id="gia_goc" placeholder="Nhập Giá Khuyến Mại" value="<?php if(isset($sp_info['gia_km'])){echo $sp_info['gia_km'];}?>">
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
                      <input type="number" class="form-control" class="required email" name="soluong" id="soluong" placeholder="Nhập Số Lượng" value="<?php if(isset($sp_info['soluong'])){echo $sp_info['soluong'];}?>">
                 
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mổ Tả</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="mota" id="gia_goc" placeholder="Nhập Mô Tả" value="<?php if(isset($sp_info['mota'])){echo $sp_info['mota'];}?>">
                 
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Bảo Hành</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="baohanh" id="gia_goc" placeholder="Nhập Bảo Hành sản Phẩm" value="<?php if(isset($sp_info['baohanh'])){echo $sp_info['baohanh'];}?>">
                 
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Khuyến Mại</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="khuyenmai" id="khuyenmai" placeholder="Nhập Khuyến Mại" value="<?php if(isset($sp_info['khuyenmai'])){echo $sp_info['khuyenmai'];}?>">
                  
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Xuất Xứ</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="xuatxu" id="xuatxu" placeholder="Nhập Nơi Xuất Xứ" value="<?php if(isset($sp_info['xuatxu'])){echo $sp_info['xuatxu'];}?>">
                   
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Size</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="size" id="size" placeholder="Nhập Size" value="<?php if(isset($sp_info['size'])){echo $sp_info['size'];}?>">
              
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Lượt Xem</label>

                  <div class="col-sm-10">
                      <input readonly type="text" class="form-control" class="required email" name="view" id="view" placeholder="" value="<?php if(isset($sp_info['view'])){echo $sp_info['view'];}?>">
                  
                    <span id="email_error"></span>
                  </div>
                </div>
                        <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Màu Sắc</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="mausac" id="mausac" placeholder="Chọn Màu Sắc" value="<?php if(isset($sp_info['mausac'])){echo $sp_info['mausac'];}?>">
                  
                    <span id="email_error"></span>
                  </div>
                </div>
                  <script src="../../dist/js/demo.js"></script>
            <!-- CK Editor -->
            <script src="../../bower_components/ckeditor/ckeditor.js"></script>
                        <script>
              $(function () {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1')
                //bootstrap WYSIHTML5 - text editor
                $('.textarea').wysihtml5()
              })
            </script>
                  <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nội Dung</label>
                            <div class="col-sm-10">
                                <div class="box box-info">
           <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Nội Dung
                <small>Chi Tiết Sản Phẩm</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
                    <textarea id="editor1" name="chitiet" rows="10" cols="80" >
                                <?php echo $sp_info['chitiet'];?>             
                    </textarea>
              </form>
            </div>
          </div>
          </div>
                            </div>
                  </div>
                  
               
                 
              
          
        
              
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
                  
                  <button id="submit"  name="submit" type="submit" class="btn btn-info center-block" >Sửa Sản Phẩm</button>
                 
                  
              </div>
              
            </div>
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>