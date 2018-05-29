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
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $error=array();
        if(empty($_POST['taikhoan']))
        {
            $error[]='taikhoan';
        }
        else
        {
            $taikhoan=$_POST['taikhoan'];
        }
        if(empty($_POST['matkhau']))
        {
            $error[]='matkhau';
        }
        else {
            $matkhau= md5(trim($_POST['matkhau']));
        }
        if(empty($_POST['xnmatkhau']))
        {
            $error[]='xnmatkhau';
        }
         else {
            $xnmatkhau= md5(trim($_POST['xnmatkhau']));
        }
        
        if(md5(trim($_POST['matkhau'])) != md5(trim($_POST['xnmatkhau'])))
        {
            $error[]='xnmatkhau';
        }
          if(empty($_POST['hoten']))
        {
            $error[]='hoten';
        }
        else
        {
            $hoten=$_POST['hoten'];
        }
          if(filter_var(($_POST['email']),FILTER_VALIDATE_EMAIL)==TRUE)
           {
               $email= mysqli_real_escape_string($dbc,$_POST['email']);
           }
           else
           {
               $error[]='email';
           }
        $ngaysinh=$_POST['ngaysinh'];
        if(!empty($error))
        {
             $message1= "<p class='require'>Bạn Phải Điền Đầy Đủ Thông Tin</p>";
        }
        else {
                     $chrole=$_POST['chrole'];
               $countcheckrole=count($chrole);
               $del_role='';
               for($i=0; $i<$countcheckrole ;$i++)
               {
                   $del_role=$del_role.','.$chrole[$i];
               }
                $query_tk="SELECT taikhoan FROM db_user WHERE taikhoan='{$taikhoan}'";
                $result_tk= mysqli_query($dbc,$query_tk);
                kt_query($result_tk, $query_tk);
                $query_email="SELECT email FROM db_user WHERE email='{$email}'";
                $result_email= mysqli_query($dbc, $query_email);
                kt_query($result_email, $query_email);
                if(mysqli_num_rows($result_tk)!="")
                {
                    $message="<p class='require'>Tài Khoản Đã Tồn Tại</p>";
                }
                 elseif(mysqli_num_rows($result_email)!="")
                {
                    $message="<p class='require'>Email Đã Tồn Tại</p>";
                }
                else{
                    $query_in="INSERT INTO db_user(taikhoan,matkhau,hoten,email,role,ngaysinh)
                             VALUES ('{$taikhoan}','{$matkhau}','{$hoten}','{$email}','{$del_role}','{$ngaysinh}')
                            ";
                           $result_in= mysqli_query($dbc, $query_in);
                           kt_query($result_in, $query_in);
                           if(mysqli_affected_rows($dbc)==1)
                           {
                               $message= "<p class='thanhcong'>Thêm Mới Thành Công</p>";
                               
                           }
                            else {
                                $message= "<p class='require'>Thêm Mới Không Thành Công</p>";
                            }
                }
                    
        }
        
    }
 ?>
   
              
            <div class="box-header with-border">
              <h2 class="them">Thêm Mới User</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formtt" class="form-horizontal" method="post" name="formtt" >
              <div class="box-body">
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tài Khoản</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="10" class="form-control"  name="taikhoan" id="taikhoan" placeholder="Tên Tài Khoản" value="<?php if(isset($_POST['taikhoan'])){echo $_POST['taikhoan'];}?>">
                   <?php 
                        if(isset($error) && in_array('taikhoan', $error))
                        {
                            echo "<p class='require'>Tài Khoản Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Mật Khẩu</label>

                  <div class="col-sm-10">
                      <input type="password" minlength="6" class="form-control" name="matkhau" id="password" placeholder="Mật Khẩu" />
                    <?php 
                        if(isset($error) && in_array('matkhau', $error))
                        {
                            echo "<p class='require'>Mật Khẩu Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="matkhau_error"></span>
                  </div>
                </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Xác Nhận Mật Khẩu</label>

                  <div class="col-sm-10">
                    <input type="password" minlength="6" class="form-control"  name="xnmatkhau" id="cpassword" placeholder="Xác Nhận Mật Khẩu">
                     <?php 
                        if(isset($error) && in_array('xnmatkhau', $error))
                        {
                            echo "<p class='require'>Mật Khẩu Không Giống nhau</p>";
                        }
                    ?>
                    <span id="xnmatkhau_error"></span>
                  </div>
                </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Họ Và Tên</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="10" class="form-control"  name="hoten" id="hoten" placeholder="Nhập Họ Tên" value="<?php if(isset($_POST['hoten'])){echo $_POST['hoten'];}?>">
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
                      <input type="email" class="form-control" class="required email" name="email" id="email" placeholder="Nhập Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
                    <?php 
                        if(isset($error) && in_array('email', $error))
                        {
                            echo "<p class='require'>Email Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
                  </div>
                </div>
                   
           <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Sinh</label>
                  <div class="col-sm-10">
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input class="form-control" type="text" name="ngaysinh" readonly id="ngaysinh"  value="<?php if(isset($_POST['ngaysinh'])){echo $_POST['ngaysinh'];}?>" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
                <div class="form-group">
                <label class="col-sm-2 control-label">Chọn Quyền</label>
                
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                        <div class="check_item_all"> 
                        <input type="checkbox" name="chkfull" onclick="checkall('chrole',this)" >
                        <label>Full Quyền</label>
                        </div>
                    </div>
                </div>
                  <div class="form-group">
                      <div class="col-sm-2"></div>
                      
                      <div class="col-sm-10">

                        <?php 

                                        foreach ($mang as $mang_add)
                                        {
                                            ?>
                                                
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                                                <div class="check_item">
                                                    <input type="checkbox" name="chrole[]"   class="chrole" value="<?php echo $mang_add['tieude'].'-'.$mang_add['link_add'].'-'.$mang_add['link_list'].'-'.$mang_add['link_edit'].'-'.$mang_add['link_delete'].'-'.$mang_add['link_reset'].'-'.$mang_add['link_choduyet'].'-'.$mang_add['link_kichhoat'];?>"/>
                                                <label><?php echo $mang_add['tieude'];?></label>
                                                </div>
                                            </div>

                                       <?php
                        }
                        ?>
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
                  
                  <button id="submit"  name="submit" type="submit" class="btn btn-info center-block" >Thêm Mới User</button>
                 
                  
              </div>
              
            </div>
           
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
            