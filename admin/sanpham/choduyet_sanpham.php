<?php include '../inc/connect.php';?>
<?php include '../inc/function_ordie.php';?>
<?php 
      if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
    {
      $id=$_GET['id'];
      $sql="SELECT trangthai FROM db_sanpham WHERE id_sanpham={$id}";
      $query_a= mysqli_query($dbc,$sql);
      $anhInfo= mysqli_fetch_assoc($query_a);
    
        $query="UPDATE db_sanpham SET trangthai=0 WHERE id_sanpham={$id}";
        $result= mysqli_query($dbc,$query);
        kt_query($result, $query);
        header('Location: list_sanpham.php');
    }
 else {
        header('Location: list_sanpham.php');
}
?>