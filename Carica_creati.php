<?php
  session_start();
  $array=array();
  $conn=mysqli_connect('localhost','root','','login');
  $result=$_GET['q'];
  if($result=='true'){
    $username =mysqli_real_escape_string($conn,$_SESSION['username']);
  }else{
    $username=mysqli_real_escape_string($conn,$result);
  }
  $query= "SELECT * FROM creations WHERE username='$username' LIMIT 3";
  $res=mysqli_query($conn,$query);
  if($num=mysqli_num_rows($res)>0){
      foreach ($res as $ind =>$value) {
        $array[$ind]=['label'=>$value['label'],'box'=>$value['preparazione'],'img'=>$value['img']];
    }
      echo json_encode($array);
  }
  else
  echo json_encode(false);
  mysqli_close($conn);
?>