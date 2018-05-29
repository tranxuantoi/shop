   <?php 
                   
                            
                                    $dm=$_GET['dm'];
                                    $sql = "SELECT id,tendm FROM db_dm_sanpham WHERE id={$dm}";
                                    $query_a= mysqli_query($dbc, $sql);
                                    $dm_info = mysqli_fetch_assoc($query_a);
                          
                            
                        ?>
<?php 
include './admin/inc/connect.php';
include './admin/inc/function_ordie.php';

$query = "SELECT * FROM db_sanpham WHERE id_dm_sp=".$dm." ORDER BY id_sanpham ";
                               $result= mysqli_query($dbc, $query)     ;
                               kt_query($result, $query);
$sanpham['id_sanpham']= $id;
?>