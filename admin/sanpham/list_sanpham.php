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
              <h3 class="box-title">Danh Sách Sản Phẩm</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Ảnh</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Giá Gốc</th>
                    <th>Giá Khuyên Mại</th>
                    <th>Số Lượng</th>
                    <th>Ngày Đăng</th>
                    <th>Trạng Thái</th>
                    <th>Chi Tiết</th>
                      <th>Xóa</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $query_sp="SELECT id_sanpham,ten_sp,trangthai,anh,ma_sp,soluong,gia_goc,gia_km,ngaydang,db_dm_sanpham.tendm FROM db_sanpham INNER JOIN db_dm_sanpham ON db_dm_sanpham.id =db_sanpham.id_dm_sp ";
                 $result_sp= mysqli_query($dbc,$query_sp);
                 kt_query($result_sp, $query_sp);
                
                while($sp = mysqli_fetch_assoc($result_sp)){
                    ?>
                         <tr>
                            <td><?php echo $sp['id_sanpham']; ?></td>
                            <td><?php echo $sp['tendm'];?></td>
                            <td><?php echo $sp['ten_sp'];?></td>
                            <td><img class="anh_r" src="../<?php echo $sp['anh'];?>"/></td>
                            <td><?php echo $sp['ma_sp'];?></td>
                             <td><?php echo $sp['gia_goc'];?></td>
                              <td><?php echo $sp['gia_km'];?></td>
                            <td><?php echo $sp['soluong'];?></td>    
                            <td>
                                <?php 
                                         
                                    if(!empty($sp['ngaydang']))
                                    {
                                            $ngay_in= explode("-",$sp['ngaydang']);
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
                                    if($sp['trangthai']==1)
                                    {
                                        ?>
                                        <a href="choduyet_sanpham.php?id=<?php echo $sp['id_sanpham'];?>"><p class='thanhcong'>Đã Duyệt</p></a>
                                       <a class="fa fa-fw fa-refresh icon_st" href="choduyet_sanpham.php?id=<?php echo $sp['id_sanpham'];?>"></a>
                                      <?php
                                    }
                                    else 
                                    {
                                        ?>
                                        <a href="kichhoat_sanpham.php?id=<?php echo $sp['id_sanpham'];?>"><p class='require'>Chờ Duyệt</p></a>
                                        <a class="fa fa-fw fa-refresh icon_st" href="kichhoat_sanpham.php?id=<?php echo $sp['id_sanpham'];?>"></a>
                                      <?php
                                    }
                                ?>
                            </td>
                            <td><a  class="btn btn-info" href="edit_sanpham.php?id=<?php echo $sp['id_sanpham'];?>">Chi Tiết</a></td>
                          <td><a  class="btn btn-danger" href="delete_sanpham.php?id=<?php echo $sp['id_sanpham'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                    
                         
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