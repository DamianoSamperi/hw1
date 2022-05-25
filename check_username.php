<?php
$conn=mysqli_connect('localhost','root','','login');
$username=mysqli_real_escape_string($conn,$_GET['q']);
$query = "SELECT username FROM utente WHERE username ='$username'";
$res= mysqli_query($conn,$query);
echo json_encode(mysqli_num_rows($res)>0 ? true : false); 
mysqli_close($conn);
?>