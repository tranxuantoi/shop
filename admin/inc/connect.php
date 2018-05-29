<?php 
// ket noi vs co so du lieu
$dbc= mysqli_connect('localhost','root','','shop');
// neu ket noi khong thanh cong in ra loi
if(!$dbc)
{
    echo "Ket noi khong thanh cong";
}
 else {
    mysqli_set_charset($dbc, 'utf8');
    
 }
?>

