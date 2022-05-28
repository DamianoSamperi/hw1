<?php
session_start();
$conn=mysqli_connect('localhost','root','','login');
$label=mysqli_real_escape_string($conn,$_GET['id']);
$username=mysqli_real_escape_string($conn,$_SESSION['username']);
$user=mysqli_real_escape_string($conn,$_SESSION['user_id']);
$query = "SELECT label FROM creations WHERE user_id ='$user' && label ='$label'";
$res= mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
    $query1="DELETE FROM creations WHERE username ='$username' && label ='$label'";
    $res1=mysqli_query($conn,$query1);
}
mysqli_close($conn);
?>