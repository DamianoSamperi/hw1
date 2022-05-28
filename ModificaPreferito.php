<?php
session_start();
$conn=mysqli_connect('localhost','root','','login');
$label=mysqli_real_escape_string($conn,$_GET['id']);
$username=mysqli_real_escape_string($conn,$_SESSION['username']);
$user=mysqli_real_escape_string($conn,$_SESSION['user_id']);
$query = "SELECT label FROM labels WHERE user_id ='$user' && label ='$label'";
$res= mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
    $query1="DELETE FROM labels WHERE username ='$username' && label ='$label'";
    $res1=mysqli_query($conn,$query1);
    $entry =true;
}
else{
    $query1 = "SELECT username FROM utente WHERE username ='$username'";
    $res1= mysqli_query($conn,$query1);     
    if(mysqli_num_rows($res1)>0){
    $query2="INSERT INTO labels(label,username,user_id) VALUES('$label','$username','$user')";
    $res1=mysqli_query($conn,$query2);
    $entry =false;
    }
}
$preferito=$_GET['preferito'];
echo json_encode($array = ['entry' => $entry, 'preferito' => $preferito]);
mysqli_close($conn);
?>