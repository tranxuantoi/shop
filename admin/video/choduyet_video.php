<?php include '../inc/connect.php';?>
<?php include '../inc/function_ordie.php';?>
<?php 
      if(isset($_GET['id']) && filter_var($_GET['id'],FILTER_VALIDATE_INT,array('min_range'=>1)))
    {
      $id=$_GET['id'];
      $sql="SELECT status FROM db_video WHERE id={$id}";
      $query_a= mysqli_query($dbc,$sql);
      $anhInfo= mysqli_fetch_assoc($query_a);
    
        $query="UPDATE db_video SET status=0 WHERE id={$id}";
        $result= mysqli_query($dbc,$query);
        kt_query($result, $query);
        header('Location: list_video.php');
    }
 else {
        header('Location: list_video.php');
}
?>