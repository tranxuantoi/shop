<?php include '../inc/connect.php';?>
<?php include '../inc/function_ordie.php';?>
<?php 
    if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
    {
        $id=$_GET['id'];
   
        $query="DELETE FROM db_lienhe WHERE id={$id}";
        $result= mysqli_query($dbc,$query);
        kt_query($result, $query);
        header('Location: list_lienhe.php');
    }
 else {
        header('Location: list_lienhe.php');
}
?>