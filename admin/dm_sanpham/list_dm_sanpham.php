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
              <h3 class="box-title">Danh Sách Danh Mục</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Mã</th>
                <th>ID CHA</th>
                <th>Tên Danh Mục</th>
                <th>Thứ Tụ</th>
                <th>Trạng Thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $query_sp="SELECT * FROM db_dm_sanpham ";
                 $result_sp= mysqli_query($dbc,$query_sp);
                 kt_query($result_sp, $query_sp);
                
                while($dm_sp = mysqli_fetch_assoc($result_sp)){
                    ?>
                         <tr>
                            <td><?php echo $dm_sp['id']; ?></td>
                            <td><?php echo $dm_sp['parent_id']; ?></td>
                            <td><?php echo $dm_sp['tendm'];?></td>
                            <td><?php echo $dm_sp['thutu'];?></td>
                            <td>
                                    
                                <?php 
                                    if($dm_sp['status']==1)
                                    {
                                        ?>
                                <a href="choduyet_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>"><p class='thanhcong'>Kích Hoạt</p></a>
                                <a class="fa fa-fw fa-refresh icon_st" href="choduyet_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>"></a>
                                      <?php
                                    }
                                    else 
                                    {
                                        ?>
                                <a href="kichhoat_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>"><p class='require'>Chờ Duyệt</p></a>
                                <a class="fa fa-fw fa-refresh icon_st" href="kichhoat_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>"></a>
                                      <?php
                                    }
                                ?>
                            </td>
                           
                            <td><a  class="btn btn-info" href="edit_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>">Sửa</a></td>
                            <td><a  class="btn btn-danger" href="delete_dm_sanpham.php?id=<?php echo $dm_sp['id'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                        </tr>
                        <?php 
                    }
                ?>
            </tbody>
        </table>
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