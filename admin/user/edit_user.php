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
           $query_id="SELECT taikhoan,hoten,email,sodt,diachi,anh,ngaysinh,role,status FROM db_user WHERE id={$id}" ;    
           $result_id= mysqli_query($dbc,$query_id);
            $taikhoan_info = mysqli_fetch_assoc($result_id);
           if(mysqli_num_rows($result_id)==1)
            {
                list($taikhoan,$hoten,$email,$sodt,$diachi,$anh,$ngaysinh,$status)= mysqli_fetch_array($result_id,MYSQLI_NUM);
                
            }
            else
            {
              $message="<p class='require'>Id User Không tồn tại</p>";
              header('Location:list_user.php');
            }  
        }
        else
        {
            header('Location: list_user.php');
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
            $ngaysinh=$_POST['ngaysinh'];
         
            $status=$_POST['status'];
             $img=$_FILES['img']['name'];
            if($_POST['sodt'] != $taikhoan_info['sodt'])
                {
                    $query_sodt="SELECT sodt FROM db_user WHERE sodt='{$_POST['sodt']}'";
                    $result_sodt= mysqli_query($dbc,$query_sodt);
                    kt_query($result_sodt, $query_sodt);
                    
                      if(mysqli_num_rows($result_sodt) ==1)
                    {
                          $error[]='sodt';
                    }
                }
              
                if ($_POST['email'] != $taikhoan_info['email'])
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
                        move_uploaded_file($_FILES['img']['tmp_name'],"../upload/anh_user/".$img);
                    }
                 
                $chrole=$_POST['chrole'];
               $countcheckrole=count($chrole);
               $del_role='';
               for($i=0; $i<$countcheckrole ;$i++)
               {
                   $del_role=$del_role.','.$chrole[$i];
               }
                $query_update="UPDATE db_user SET hoten='{$_POST['hoten']}',sodt='{$_POST['sodt']}',email='{$_POST['email']}',diachi='{$_POST['diachi']}',anh='{$link_img}',ngaysinh='{$_POST['ngaysinh']}', role='{$del_role}',status={$_POST['status']} WHERE id={$id}";
                $result_update= mysqli_query($dbc,$query_update);
                kt_query($result_update, $query_update);
                if($result_update){
                    echo "<script>alert('Cập Nhập Thành Công Rồi Nhé !!');setTimeout(function(){window.location='list_user.php' }, 500);</script>";
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
                  <label for="inputEmail3" class="col-sm-2 control-label" >Tài Khoản </label>

                  <div  class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" name="taikhoan" id="taikhoan" value="<?php if(isset($taikhoan_info['taikhoan'])){echo $taikhoan_info['taikhoan'];}?> " readonly placeholder="Tài Khoản"/>
                 
                  <span id="taikhoan_error"></span>
                  </div>
                </div>
               

                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Họ Và Tên</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="hoten" id="hoten" placeholder="Nhập Số Họ Và Tên" value="<?php if(isset($taikhoan_info['hoten'])){echo $taikhoan_info['hoten'];}?>">
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
                    <input type="email" class="form-control" id="inputPassword3" name="email" id="email" placeholder="Nhập Email" value="<?php 
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
                 <div class="form-group">
                 
                     <label class="col-sm-2 control-label">Chọn Ảnh Đại Diện</label>
                     <div class="col-sm-10">
                 <img class="anh_r" src="../<?php echo $taikhoan_info['anh'];?>" />
                 <input type="file" name="img" value="<?php echo $taikhoan_info['anh'];?>" />
                 <input type="hidden" name="anh" value="<?php echo $taikhoan_info['anh'];?>"/>
                
                    </div>
                 
               
            </div>
                   
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Sinh</label>
                  <div class="col-sm-10">
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input readonly class="form-control" type="text" name="ngaysinh"  id="ngaysinh"  value="<?php if(isset($_POST['ngaysinh'])){echo $_POST['ngaysinh'];}?>" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
                   <div class="form-group">
                <label class="col-sm-2 control-label">Chọn Quyền</label>
                <div class="col-sm-10">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                        <div class="check_item_all"> 
                        <input type="checkbox" name="chkfull" onclick="checkall('chrole',this)" >
                        <label>Full Quyền</label>
                        </div>
                    </div>
                    
            </div>
                </div>
                <div class="form-group">
                      <div class="col-sm-2"></div>
                      
                      <div class="col-sm-10">
                    <?php 
                                    foreach ($mang as $mang_add)
                                    {
                                        $edit_role= explode(",",$taikhoan_info['role']);
                                        $ok=0;
                                        foreach ($edit_role as $itemrole)
                                        {
                                                $edit_ht=$mang_add['tieude'].'-'.$mang_add['link_add'].'-'.$mang_add['link_list'].'-'.$mang_add['link_edit'].'-'.$mang_add['link_delete'].'-'.$mang_add['link_choduyet'].'-'.$mang_add['link_kichhoat'].'-'.$mang_add['link_reset'];
                                            if($edit_ht == $itemrole)
                                            {
                                                $ok=1;
                                                    break;
                                            }
                                            
                                        }
                                       
                                            
                                   
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                                            <div class="check_item">
                                            <input type="checkbox" name="chrole[]" 
                                                <?php 
                                                    if($ok==1)
                                                    {
                                                    ?> 
                                                   checked="checked"
                                                    <?php
                                                    }
                                                ?>
                                                   class="chrole" value="<?php echo $mang_add['tieude'].'-'.$mang_add['link_add'].'-'.$mang_add['link_list'].'-'.$mang_add['link_edit'].'-'.$mang_add['link_delete'].'-'.$mang_add['link_choduyet'].'-'.$mang_add['link_kichhoat'].'-'.$mang_add['link_reset'];?>"/>
                                            <label><?php echo $mang_add['tieude'];?></label>
                                            </div>
                                        </div>
                    
                                   <?php
                    }
                    ?>
                </div>
                </div>
            
                                 <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Trạng Thái</label>
                 <div class="col-sm-10">
                 <?php 
                    if($taikhoan_info['status']==1)
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
                  
                  <button id="submit" name="submit" type="submit" class="btn btn-info center-block" >Sửa Tài Khoản</button>
                 
                  
              </div>
            
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
<?php ob_flush();?>