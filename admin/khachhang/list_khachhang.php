<link rel="stylesheet" href="dataTables.bootstrap.min.css">
<?php include '../include2/header.php';?>
<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>

<style>
      .anh_r
   {
       border: solid #8bf5f0 3px;
       width: 100px;
       height: 100px;
   }
    .them
    {text-align: center;}
    .dangki
    {
        text-align: center;
    }
    .require
    {
        color: red;
         text-align: center;
         margin-top: 10px;
    }
    .thanhcong
    {
        color :green;
         text-align: center;
         margin-top:10px;
    }
   .xn
   {
       margin-left:30px;
   }
   .icon_st
   {
      padding-left: 40%;
   }
</style>
  <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Khách Hàng</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Khách Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Chi Tiết</th>

                      <th>Xóa</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $query_user="SELECT * FROM db_khachhang ";
                 $result_user= mysqli_query($dbc,$query_user);
                 kt_query($result_user, $query_user);
                
                while($user = mysqli_fetch_assoc($result_user)){
                    ?>
                         <tr>
                            <td><?php echo $user['id_khachhang']; ?></td>
                            <td><?php echo $user['ten_khachhang'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td><?php echo $user['sodt'];?></td>
                            <td><?php echo $user['diachi'];?></td>
                
                         
                            <td><a  class="btn btn-info" href="edit_khachhang.php?id=<?php echo $user['id_khachhang'];?>">Sửa</a></td>
                          <td><a  class="btn btn-danger" href="delete_khachhang.php?id=<?php echo $user['id_khachhang'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                    
                         
                        </tr>

                        <?php 
                
                    }
                
                ?>
            </tbody>
        </table>
            </div>
            <!-- /.box-body -->
 
            <!-- /.box-body -->
          
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>

<!--    phan trang tu viet  
<script type="text/javascript">
                $( document ).ready(function() {
                    $( "#select_page" ).change(function() {
                        var a = $( "#select_page" ).val();
                        window.location.replace("?p="+a);
                    });
                });
            </script>-->
<!--phan trang template-->
            <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>