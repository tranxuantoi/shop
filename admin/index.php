<?php include './include/header.php';?>
<?php include './include/sidebar.php';?>
<?php include './include/main.php';?>
<br/>

<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tổng Thành Viên</span>
              <span class="info-box-number">
                  
                 <?php 
                    $query_tv="SELECT COUNT(id) FROM db_user";
                    $result_tv= mysqli_query($dbc, $query_tv);
                    kt_query($result_tv, $query_tv);
                    list($user_info)= mysqli_fetch_array($result_tv,MYSQLI_NUM);
                    echo $user_info;
                 ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tổng Sản Phẩm</span>
              <span class="info-box-number">
                     <?php 
                    $query_sp="SELECT COUNT(id_sanpham) FROM db_sanpham";
                    $result_sp= mysqli_query($dbc, $query_sp);
                    kt_query($result_sp, $query_sp);
                    list($sp_info)= mysqli_fetch_array($result_sp,MYSQLI_NUM);
                    echo $sp_info;
                 ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Khách Hàng Liên Hệ</span>
              <span class="info-box-number">    <?php 
                    $query_lh="SELECT COUNT(status) FROM db_lienhe";
                    $result_lh= mysqli_query($dbc, $query_lh);
                    kt_query($result_lh, $query_lh);
                
                    list($lh_info)= mysqli_fetch_array($result_lh,MYSQLI_NUM);
              
                     echo $lh_info;
                  
                  
                    
                    
                  
                 ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<div class="form-group">
<?php
   $date=date_default_timezone_set('Asia/Ho_Chi_Minh');
   $ngayht=date('Y-m-d H:i:s');
  echo $ngayht;
?>
</div>
<?php include './include/footer.php';?>
<?php include './include/control_sidebar.php';?>