<link rel="stylesheet" href="dataTables.bootstrap.min.css">
<?php include '../include2/header.php';?>
<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>
<!--validate date-->

   <!-- validate form-->


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
            if(empty($_POST['tendm']))
            {
                $error[]='tendm';
            }
            else {
                  $tendm=$_POST['tendm'];
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
        
            if(!empty($error))
            {
                   $message="<p class='require'>Bạn phải Điền đẩy đủ thông tin</p>";
            }
            else
            {
                if($_POST['parent']==0)
                {
                    $parent_id=0;
                }
                else 
                {
                   $parent_id = $_POST['parent'];
                }
                $query="INSERT INTO db_dm_sanpham(parent_id,tendm,thutu,status) VALUES($parent_id,'{$tendm}','{$thutu}',$status)";
                $results= mysqli_query($dbc,$query) or die("Query {$query} \n <br/> MySql error:".mysqli_error($dbc));
                if(mysqli_affected_rows($dbc)==1)
                {
                    $message="<p class='thanhcong'>Thêm Mới Thành công </p>";
                }
                else {
                        $message= "<p class='require'>Không thêm mới được</p>";
                }
           
                
            }
        
           
        }
    ?>
              
            <div class="box-header with-border">
              <h2 class="them">Thêm Mới Danh Mục</h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="formtt" class="form-horizontal" method="post" name="formtt" enctype="multipart/form-data">
              <div class="box-body">
                  <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Danh Mục Cha</label>
                <div class="col-sm-10">
                <?php selectCtrl('parent'); ?>
                </div>
                </div>
                 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Tên Danh Mục</label>

                  <div class="col-sm-10">
                      <input type="text" minlength="6" class="form-control"  name="tendm" id="temdm" placeholder="Nhập Tên Danh Mục" value="<?php if(isset($_POST['tendm'])){echo $_POST['tendm'];}?>">
                   <?php 
                        if(isset($error) && in_array('tendm', $error))
                        {
                            echo "<p class='require'>Bạn Chưa Nhập Tên Danh Mục</p>";
                        }
                    ?>
                    <span id="phone_error"></span>
                  </div>
                </div>
                       <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Thứ Tự</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" class="required email" name="thutu" id="thutu" placeholder="Nhập Thứ Tự" value="">
                    <?php 
                        if(isset($error) && in_array('thutu', $error))
                        {
                            echo "<p class='require'>Thứ Tự Không Được Để Trống</p>";
                        }
                    ?>
                    <span id="email_error"></span>
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
                  <button id="submit"  name="submit" type="submit" class="btn btn-info center-block" >Thêm Mới Danh Mục</button>
                 
                  
              </div>
              
            
           </div>
              <!-- /.box-footer -->
            </form>
       
     
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
            