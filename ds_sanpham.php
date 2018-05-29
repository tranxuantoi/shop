<?php include './theme/header.php';?>
<?php include './theme/slider.php';?>
<?php include './theme/left.php';?>
<?php include './theme/container.php';?>
                        <?php 
                        if(isset($_GET['dm']) && filter_var($_GET['dm'],FILTER_VALIDATE_INT,array('min_range'=>1)))
                            {
                                    $dm=$_GET['dm'];
                                    $sql = "SELECT id,tendm FROM db_dm_sanpham WHERE id={$dm}";
                                    $query_a= mysqli_query($dbc, $sql);
                                    $dm_info = mysqli_fetch_assoc($query_a);
                            }
                            else
                            {
                                header('Location:index.php');
                                exit();

                            }
                            
                        ?>	
                    <div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $dm_info['tendm'];?></h2>
				  <?php
                             // phan trang
                             $limit=9;
                             //xac dinh vi tri bat dau
                             if(isset($_GET['s']) && filter_var($_GET['s'],FILTER_VALIDATE_INT,array('min_range'=>1)))
                             {
                                 $start=$_GET['s'];
                             }
                             else {
                             $start=0;
                                }
                                  if(isset($_GET['p']) && filter_var($_GET['p'],FILTER_VALIDATE_INT,array('min_range'=>1)))
                             {
                                 $per_page=$_GET['p'];
                             }
                             
                            else {
                                    // neu p khong co thi truy van CSDL de tim xem bao nhieu bao ghi
                                $query_page="SELECT COUNT(id_sanpham) FROM db_sanpham WHERE id_dm_sp=".$dm."";
                                $result_page= mysqli_query($dbc, $query_page);
                                kt_query($result_page, $query_page);
                                list($record)= mysqli_fetch_array($result_page,MYSQLI_NUM);
                                if($record >$limit)
                                {
                                    $per_page= ceil($record/$limit);
                                }
                                else
                                {
                                    $per_page=1;
                                }
                            }
				$query = "SELECT * FROM db_sanpham WHERE id_dm_sp=".$dm." ORDER BY id_sanpham DESC LIMIT {$start},{$limit}";
                               $result= mysqli_query($dbc, $query)     ;
                               kt_query($result, $query);
                               while ($sanpham = mysqli_fetch_array($result,MYSQLI_ASSOC))
                               {
                                   ?>
                               <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
                                                                            <img width="255" height="238" src="admin/<?php echo $sanpham['anh'];?>" alt="" />
                                                                            <h2><?php echo number_format($sanpham['gia_goc']);?> VND</h2> 
										<p><?php echo $sanpham['ten_sp'];?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
                                                                                      <img width="255" height="238" src="admin/<?php echo $sanpham['anh'];?>" alt="" />
											<h2><?php echo number_format($sanpham['gia_goc']);?> VND</h2>
											<p><?php echo $sanpham['ten_sp'];?></p>
											<a href="add_cart.php?id=<?php echo $sanpham['id_sanpham'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vảo Giỏ</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="chitiet_sp.php?id=<?php echo $sanpham['id_sanpham'];?>"><i class="fa fa-plus-square"></i>Chi Tiết Sản Phẩm</a></li>
										<li><a  href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
                                   
                                             
                                <?php
                               }
                                   echo "<ul class='pagination'>";
                                 if($per_page >1)
                                 {
                                   $current_page=($start / $limit) +1;
                                   // khong phai trang dau hien thi trang truoc
                                   if($current_page!=1)
                                   {
                                       echo "<li><a href='ds_sanpham.php?dm={$dm}&s=".($start - $limit)."&p={$per_page}'>Back</a></li>";
                                   }
                                   // hien thi nhung phan con lai con trang
                                   for($i=1;$i <= $per_page ; $i++)
                                   {
                                       if($i != $current_page)
                                       {
                                           echo "<li><a href='ds_sanpham.php?dm={$dm}&s=".($limit*($i-1))."&p={$per_page}'>{$i}</a></li>";
                                       }
                                    else
                                    {
                                            echo "<li class='active'><a>{$i}</a></li>";
                                    }
                                   }
                                   // neu khong phai trang cuoi thi hien thi nut next
                                   if($current_page != $per_page)
                                   {
                                       echo "<li><a href='ds_sanpham.php?dm={$dm}&s=".($start+$limit)."&p={$per_page}'>Next</a></li>";
                                   }
                                 }
                                   echo "</ul>";
                                
                            
                             ?>
						
						
                                            </div>
                        <br/>
                         
				<h2 class="title text-center">Sản Phẩm Bán Chạy</h2>
                                <?php
                               $query_xn = "SELECT * FROM db_sanpham WHERE id_dm_sp=".$dm." ORDER BY view DESC LIMIT 0,3";
                               $result_xn= mysqli_query($dbc, $query_xn)     ;
                               kt_query($result_xn, $query_xn);
                               while ($sanpham = mysqli_fetch_array($result_xn,MYSQLI_ASSOC))
                               {
                                   ?>
                               <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									 
                                                                        
                                                                            <img  width="255" height="238" src="admin/<?php echo $sanpham['anh'];?>" alt="" />
                                                                            <h2><?php echo number_format($sanpham['gia_goc']);?> VND</h2> 
										<p><?php echo $sanpham['ten_sp'];?></p>
                                                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Vào Giỏ</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
                                                                                      <img width="255" height="238" src="admin/<?php echo $sanpham['anh'];?>" alt="" />
											<h2><?php echo number_format($sanpham['gia_goc']);?> VND</h2>
											<p ><?php echo $sanpham['ten_sp'];?></p>
											<a  href="#" class="btn btn-default add-to-cart"><i id="add_sanpham" class="fa fa-shopping-cart"></i>Thêm Vảo Giỏ</a>
                                                                            
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="chitiet_sp.php?id=<?php echo $sanpham['id_sanpham'];?>"><i class="fa fa-plus-square"></i>Chi Tiết Sản Phẩm</a></li>
										<li><a   href="#"><i  class="fa fa-plus-square"></i>So Sánh</a></li>
									</ul>
								</div>
							</div>
                                             
						</div>
                                   
                                             
                                <?php
                               }
                               ?>
                    </div>
					

<?php include './theme/container_bot.php';?>
<?php include './theme/footer.php';?>