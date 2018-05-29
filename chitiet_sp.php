<?php error_reporting();?>
<?php include './theme/header.php';?>
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
<?php include './theme/slider.php';?>
<?php include './theme/left.php';?>
<?php include './theme/container.php';?>
                        <?php 
                        if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
                            {
                                    $id=$_GET['id'];
                                   $sql="SELECT * FROM db_sanpham WHERE id_sanpham={$id}";
                                    $query_a= mysqli_query($dbc, $sql);
                                    $dm_info= mysqli_fetch_assoc($query_a);
                                    $sql2="SELECT * FROM db_dm_sanpham WHERE id={$dm_info['id_dm_sp']}";
                                    $query_a2= mysqli_query($dbc, $sql2);
                                    $dm_info2 = mysqli_fetch_assoc($query_a2);
                                    $view_tang=$dm_info['view']+1;
                                    $sql3="UPDATE db_sanpham SET view ={$view_tang} WHERE id_sanpham={$id}";
                                    $query_a3= mysqli_query($dbc, $sql3);
                                    kt_query($query_a3, $sql3);
                              
                                           
                                    ?>
                            
                                 <div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
                                                            <img src="admin/<?php echo $dm_info['anh'];?>" alt="">
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active left">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item next left">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="">
								<h2><?php echo $dm_info['ten_sp'];?></h2>
								<p>Mã Sẩn Phẩm : <?php echo $dm_info['ma_sp'];?></p>
								Đánh Giá : <img src="images/product-details/rating.png" alt="">
                                                                <br/>
								<span>
                                                                    <span>Giá KM : <?php echo number_format($dm_info['gia_km']);?> VND</span>
                                                                    <br/>
                                                                   Giá Gốc : <?php echo number_format($dm_info['gia_goc']);?> VND
                                                                   
								</span>
                                                                <br/>
                                                                <span>
                                                                 <label>Số Lượng:</label>
                                                                 <a href="add_cart.php?id=<?php echo $dm_info['id_sanpham'];?>">
									<input type="text" value="3">
									<button type="button" class="btn btn-fefault cart">
                                                                            <i class="fa fa-shopping-cart"></i>
										Thêm Vào Giỏ
									</button>
                                                                 </a>
                                                                </span>
								<p><b>Ngày Đăng : </b><?php   $ngay_in=$dm_info['ngaydang'];  
                                                                                    $ngay_in= explode("-",$dm_info['ngaydang']);
                                                                                    $ngay_out=$ngay_in[2].'-'.$ngay_in[1].'-'.$ngay_in[0];
                                                                                     echo $ngay_out;?></p>
                                                                <p><b>Khuyến Mại : </b><?php echo $dm_info['khuyenmai'];?> </p>
                                                                 <p><b>Lượt Xem : </b><?php echo $dm_info['view'];?> </p>
                                                               <p><b>Xuất Xứ : </b><?php echo $dm_info['xuatxu'];?> </p>
                                                                  <p><b>Trạng Thái : </b>
                                                                  <?php 
                                                                  if($dm_info['soluong'] ==0)
                                                                  {
                                                                      echo 'Liên Hệ';
                                                                  }
                                                                  else
                                                                  {
                                                                      echo 'Còn Hàng';
                                                                  }
                                                                  ?> 
                                                                  </p>
                                                               <select>
                                                                   <option>M</option>
                                                                    <option>L</option>
                                                                     <option>XL</option>
                                                                      <option>XXL</option>
                                                                  
                                                               </select>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt=""></a>
							</div><!--/product-information-->
						</div>
                                     <div>
                                         <h2 class="chitiet">Chi Tiết Sản Phẩm</h2>
                                     </div>
                                     <br/>
                                        <div class="noidung">
                                                <?php echo $dm_info['chitiet'];?>
                                        </div>
					</div>    
<script type="text/javascript">
    $(document).ready(function()
    {
       $("#add_sanpham<?php echo $dm_info['id_sanpham'];?>").click(function(){
             alert('ok');
         }); 
         
    });
    </script>
                                      
                                        
                       <?php
                            }
                           
                            else
                            {
                                header('Location:index.php');
                                exit();

                            }
                            
                        ?>	
              

<?php include './theme/container_bot.php';?>
<?php include './theme/footer.php';?>
