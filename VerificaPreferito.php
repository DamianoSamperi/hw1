<?php
session_start();
$conn=mysqli_connect('localhost','root','','login');
$label=mysqli_real_escape_string($conn,$_GET['titolo']);
$username=mysqli_real_escape_string($conn,$_SESSION['username']);
$query = "SELECT label FROM labels WHERE username ='$username' && label ='$label'";
$res= mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
    $entry= true ;
}else
{
    $entry=false;
}
$preferito=$_GET['preferito'];
echo json_encode($array = ['entry' => $entry, 'preferito' => $preferito]);

mysqli_close($conn);
?>