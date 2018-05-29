<?php include '../inc/connect.php';?>
<?php include '../inc/function_ordie.php';?>
<?php 
    if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
    {
        $id=$_GET['id'];
   
        $query="DELETE FROM db_khachhang WHERE id_khachhang={$id}";
        $result= mysqli_query($dbc,$query);
        kt_query($result, $query);
        header('Location: list_khachhang.php');
    }
 else {
        header('Location: list_khachhang.php');
}
?>