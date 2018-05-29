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
              <h3 class="box-title">Danh Sách Slider</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>Mã</th>
                <th>Tiêu Đề</th>
                <th>Ảnh</th>
                <th>Link</th>
                <th>Thứ Tự</th>
                 <th>Ngày Đăng</th>
                <th>Trạng Thái</th>
                <th>Sửa</th>
                <th>Xóa</th>
                </tr>
            </thead>


            <tbody>
                <?php
                $query_slider="SELECT * FROM db_slider ";
                 $result_slider= mysqli_query($dbc,$query_slider);
                 kt_query($result_slider, $query_slider);
                
                while($slider = mysqli_fetch_assoc($result_slider)){
                    ?>
                         <tr>
                            <td><?php echo $slider['id']; ?></td>
                            <td><?php echo $slider['tieude'];?></td>
                            <td><img class="anh_r" src="../<?php echo $slider['anh'];?>"/>
                            <td class="link_slider"><?php echo $slider['link'];?></td>
                            <td><?php echo $slider['thu_tu'];?></td>
                           
                           
                            
                            <td>
                                <?php 
                                         
                                    if(!empty($slider['ngaydang']))
                                    {
                                            $ngay_in= explode("-",$slider['ngaydang']);
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
                                    if($slider['status']==1)
                                    {
                                        ?>
                                <a href="choduyet_slider.php?id=<?php echo $slider['id'];?>"><p class='thanhcong'>Kích Hoạt</p></a>
                                <a class="fa fa-fw fa-refresh icon_st" href="choduyet_slider.php?id=<?php echo $slider['id'];?>"></a>
                                      <?php
                                    }
                                    else 
                                    {
                                        ?>
                                       <a href="kichhoat_slider.php?id=<?php echo $slider['id'];?>"><p class='require'>Chờ Duyệt</p></a>
                                       <a class="fa fa-fw fa-refresh icon_st" href="kichhoat_slider.php?id=<?php echo $slider['id'];?>"></a>
                                      <?php
                                    }
                                ?>
                            </td>
                           
                            <td><a  class="btn btn-info" href="edit_slider.php?id=<?php echo $slider['id'];?>">Sửa</a></td>
                            <td><a  class="btn btn-danger" href="delete_slider.php?id=<?php echo $slider['id'];?>" onclick="return confirm('Bạn Có Thật Sự Muốn Xóa Không')">Xóa</a></td>
                        </tr>
                        <?php 
                    }
                ?>
            </tbody>
        </table>
            </div>
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