<link rel="stylesheet" href="dataTables.bootstrap.min.css">
<?php include '../include2/header.php';?>


<style>
      .anh_r
   {
       border: solid #8bf5f0 3px;
       width: 300px;
       height: 150px;
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
  link_slider
   
   {
       text-align: center;
   }
</style>

<?php include '../include2/sidebar.php';?>
<?php include '../include2/main.php';?>


<div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Khách Liên Hệ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên Khách Hàng</th>
                 
                  <th>Email</th>
                  <th>Số Điện thoại</th>
                   <th>Ngày Gửi</th>
                   <th>Trạng Thái</th>
                  <th>Sửa</th>
                   <th>Xóa</th>
                </tr>
                </thead>


                <tbody>
                  <?php
                    $query_lh="SELECT * FROM db_lienhe";
                    $result_lh= mysqli_query($dbc,$query_lh);
                    while($ttkh = mysqli_fetch_assoc($result_lh)){
                  ?>
                <tr>
                  <td><?php echo  $ttkh['id']; ?></td>
                  <td><?php echo $ttkh['hoten']; ?></td>
                 
                  <td><?php echo  $ttkh['email']; ?></td>
                  <td><?php echo $ttkh['sodt']; ?></td>
                     <td><?php echo  $ttkh['ngaygui']; ?></td>
                   <td>
                       <?php
                       if(($ttkh['status'])==1)
                       {
                           echo "<p class='thanhcong'>Đã Xem</p>";
                       }
                       else
                       {
                            echo "<p class='require'>Chưa Xem</p>";
                       }
                       ?>
                   
                   </td>
                    <td><a  class="btn btn-info" href="edit_lienhe.php?id=<?php echo $ttkh['id'];?>">Chi Tiết</a></td>
                    <td><a  class="btn btn-danger" href="delete_lienhe.php?id=<?php echo $ttkh['id'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                </tr>

                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
<?php include '../include2/footer.php';?>
<?php include '../include2/control_sidebar.php';?>
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