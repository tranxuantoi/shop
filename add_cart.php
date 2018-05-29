<?php include './theme/header.php';?>
<?php include './theme/slider.php';?>
<style>
    .noidung
    
    {
        margin-left: 5%;
  
    }
    .chitiet
    {
        text-align: center;
    }
</style>
<?php 
       if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
                            {  
                                    $id=$_GET['id'];
                                    $sql="SELECT * FROM db_sanpham WHERE id_sanpham={$id}";
                                    $query_a= mysqli_query($dbc, $sql);
                                    $dm_info= mysqli_fetch_assoc($query_a);
                            ?>
                                                    <section id="cart_items">
                                        <div class="container">
                                                <div class="breadcrumbs">
                                                        <ol class="breadcrumb">
                                                          <li><a href="#">Home</a></li>
                                                          <li class="active">Giỏ Hàng</li>
                                                        </ol>
                                                </div>
                                                <div class="table-responsive cart_info">
                                                        <table class="table table-condensed">
                                                                <thead>
                                                                        <tr class="cart_menu">
                                                                                <td class="image">Sản Phẩm</td>
                                                                                <td class="description">Thông Tin</td>
                                                                                <td class="price">Giá</td>
                                                                                <td class="quantity">Số Lượng</td>
                                                                                <td class="total">Tổng Tiền</td>
                                                                                <td class="total">Xóa</td>

                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <tr>
                                                                                <td style="margin-left:0" class="cart_product">
                                                                                    <a  href=""><img  width="100" src="admin/<?php  echo $dm_info['anh'];?>" alt=""></a>
                                                                                </td>
                                                                                <td style="margin-left:0" class="cart_description">
                                                                                        <h4><a href=""><?php  echo $dm_info['ten_sp'];?></a></h4>
                                                                                        <p>Mã Sản Phẩm :<?php  echo $dm_info['ma_sp'];?></p>
                                                                                </td>
                                                                                <td class="cart_price">
                                                                                    <p><?php  echo number_format($dm_info['gia_km']);?> VND </p>
                                                                                </td>
                                                                                <td class="cart_quantity">
                                                                                        <div class="cart_quantity_button">
                                                                                                <a id="loz" onclick="j()"class="cart_quantity_down"> - </a>
                                                                                                <input class="cart_quantity_input" id="so" type="text" name="quantity" maxlength="2" value="1" autocomplete="off" size="2">
                                                                                                <a id="loz" onclick="i()"  class="cart_quantity_up" > + </a>
                                                                                        </div>
                                                                                </td>


                                                                                    <script>

                                                                                    function i(){
                                                                                            var k = parseInt(document.getElementById('so').value) + 1;

                                                                                        document.getElementById('so').value = k;
                                                                                    }
                                                                                     function j(){
                                                                                            var k = parseInt(document.getElementById('so').value) - 1;


                                                                                                  document.getElementById('so').value = k;


                                                                                    }
                                                                                    </script>
                                                                                <td class="cart_total">
                                                                                        <p class="cart_total_price"><?php  echo number_format($dm_info['gia_km']);?> VND</p>
                                                                                </td>
                                                                                <td class="cart_delete">
                                                                                        <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                                                                </td>
                                                                        </tr>



                                                                </tbody>
                                                        </table>
                                                </div>
                                        </div>
                                </section>


                            <?php
                            }
                            else
                            {
                                header('Location:index.php');
                                exit();
                            }
                            
                        ?>	
              



<?php include './theme/footer.php';?>