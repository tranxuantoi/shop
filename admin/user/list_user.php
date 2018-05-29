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
              <h3 class="box-title">Danh Sách User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tài Khoản</th>
                    <th>Họ Và Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Ảnh Đại Diện</th>
                    <th>Sinh Nhật</th>
                    <th>Trạng Thái</th>
                    <th>Reset Pass</th>
                    <th>Sửa</th>
                      <th>Xóa</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $query_user="SELECT id,taikhoan,hoten,email,sodt,anh,ngaysinh,status FROM db_user ";
                 $result_user= mysqli_query($dbc,$query_user);
                 kt_query($result_user, $query_user);
                
                while($user = mysqli_fetch_assoc($result_user)){
                    ?>
                         <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['taikhoan'];?></td>
                            <td><?php echo $user['hoten'];?></td>
                            <td><?php echo $user['email'];?></td>
                            <td><?php echo $user['sodt'];?></td>
                            <td><img class="anh_r" src="../<?php echo $user['anh'];?>"/>
                            </td>
                            
                            <td>
                                <?php 
                                         
                                    if(!empty($user['ngaysinh']))
                                    {
                                            $ngay_in= explode("-",$user['ngaysinh']);
                                            $ngay_out=$ngay_in[2].'-'.$ngay_in[1].'-'.$ngay_in[0];
                                             echo $ngay_out;
                                           

                                    } 
                                    else 
                                        {
                                            echo "Chưa Có Dữ Liệu";
                                            
                                    }  
                                ?>
                            
                            </td>
                          
                            <td>
                                    
                                <?php 
                                    if($user['status']==1)
                                    {
                                        ?>
                                        <a href="choduyet_user.php?id=<?php echo $user['id'];?>"><p class='thanhcong'>Kích Hoạt</p></a>
                                       <a class="fa fa-fw fa-refresh icon_st" href="choduyet_user.php?id=<?php echo $user['id'];?>"></a>
                                      <?php
                                    }
                                    else 
                                    {
                                        ?>
                                        <a href="kichhoat_user.php?id=<?php echo $user['id'];?>"><p class='require'>Chờ Duyệt</p></a>
                                        <a class="fa fa-fw fa-refresh icon_st" href="kichhoat_user.php?id=<?php echo $user['id'];?>"></a>
                                      <?php
                                    }
                                ?>
                            </td>
                            <td ><a href="reset_user.php?id=<?php echo $user['id'];?>"><img src="../upload/reset.jfif" width="30" class="xn" /></a></td>
                            <td><a  class="btn btn-info" href="edit_user.php?id=<?php echo $user['id'];?>">Sửa</a></td>
                          <td><a  class="btn btn-danger" href="delete_user.php?id=<?php echo $user['id'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                    
                         
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