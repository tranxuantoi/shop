
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
<style type="text/css">
    .require
    {
        color: red;
    
    }
    .thanhcong
    {
        color: green;
     
    }
    .banner
    {
        text-align: center;
        }
        .footer_slider
        {
            text-align: center;
        }
</style>
  <?php
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
            else 
            {
                $link=$_POST['link'];
            }
            if(!empty($_POST['thutu']))
            {
                $thutu=$_POST['thutu'];
            }
            else
            {
                $error[]='thutu';
            }
            $status=$_POST['status'];
            $ngaydang=$_POST['ngaydang'];
            if(!empty($error))
            {
                $message="<p class='require'>Bạn phải Điền đẩy đủ thông tin</p>";
               
                
            }
            else 
            {
                 $query="INSERT INTO db_video(tieude,link,thutu,ngaydang,status) VALUES('{$tieude}','{$link}','{$thutu}','{$ngaydang}',$status)";
                $results= mysqli_query($dbc,$query) or die("Query {$query} \n <br/> MySql error:".mysqli_error($dbc));
                if(mysqli_affected_rows($dbc)==1)
                {
                    $message1="<p class='thanhcong'>Thêm Mới Thành công </p>";
                }
                else {
                        echo "<p>Không thêm mới được</p>";
                }
                $_POST['tieude']='';
                
                $_POST['ordernum']='';
                    
            }
               
        }
        
    ?>
              
            <div class="box-header with-border">
              <h2 class="them">Thêm Mới Video</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formtt" class="form-horizontal" method="post" name="formtt" enctype="multipart/form-data">
              <div class="box-body">
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tiêu Đề</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="6" class="form-control"  name="tieude" id="tieude" placeholder="Nhập Tên Tiêu Đề" value="<?php if(isset($_POST['tieude'])){echo $_POST['tieude'];}?>">
                   <?php 
                        if(isset($error) && in_array('tieude', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Tên Tiều Đề</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
             
               
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Link</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="10" class="form-control"  name="link" id="link" placeholder="Nhập Link Tiêu Đề" value="">
                   <?php 
                        if(isset($error) && in_array('link', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Link</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Thứ Tự</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="thutu" id="thutu" placeholder="Nhập Thứ Tự" value="<?php if(isset($_POST['thutu'])){echo $_POST['thutu'];}?>">
                    <?php 
                        if(isset($error) && in_array('thutu', $error))
                        {
                            echo "<p class='require'>Thứ Tự Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
                  </div>
                </div>
                   
        
              
                  <!-- Validate FORM 
                  validate email-->
                 
                    
          
                <!-- /.input group -->
             
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ngày Đăng</label>
                  <div class="col-sm-10">
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
               
                      <input class="form-control" type="text" name="ngaydang" readonly id="ngaydang"  value="<?php if(isset($_POST['ngaysinh'])){echo $_POST['ngaysinh'];}?>" />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                
            </div>
           </div>
           </div>
              
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Trạng Thái</label>
                 <div class="col-sm-10">
               
                        <label class="radio-inline thanhcong"><input type="radio"  name="status" value="1"/>Đã Duyệt</label>
                        <label class="radio-inline require"><input type="radio" checked="checked" name="status" value="0"/>Chờ Duyệt</label>
          
                 </div>
                 
            </div>
                
              <!-- /.box-body -->
              <div class="box-footer footer_slider">
                           <?php 
            
              if(isset($message1))
              {
                  echo $message1;
              }
                if(isset($message))
              {
                  echo $message;
              }
                ?>
                  <button id="submit"  name="submit" type="submit" class="btn btn-info center-block" >Thêm Mới Video</button>
                 
                  
              </div>
              
            
           </div>
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
            