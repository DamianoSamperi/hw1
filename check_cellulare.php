<?php
$conn=mysqli_connect('localhost','root','','login');
$cellulare=mysqli_real_escape_string($conn,$_GET['q']);
$query = "SELECT email FROM utente WHERE cellulare ='$cellulare'";
$res= mysqli_query($conn,$query);
echo json_encode(mysqli_num_rows($res)>0 ? true : false); 
mysqli_close($conn);
?>