<?php
$api_recipes="https://api.edamam.com/api/recipes/v2/";
$api_id_recipes="d683117b";
$api_key="2efd83bc8dd404aac01c8a2b391867e5";
  session_start();
  $array=array();
  $conn=mysqli_connect('localhost','root','','login');
  $username =mysqli_real_escape_string($conn,$_SESSION['username']);
  $query= "SELECT label FROM labels WHERE username='$username' LIMIT 3";
  $res= mysqli_query($conn,$query);
  if($num=mysqli_num_rows($res)>0){
      foreach ($res as $ind =>$value) {
        $curl = curl_init();
        $api_recipes_url=$api_recipes.$value['label'].'?'."type=public&app_id=".$api_id_recipes."&app_key=". $api_key;
        curl_setopt($curl, CURLOPT_URL,$api_recipes_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $array[$ind]=[$result];
      }
      echo json_encode($array);
  }
  else
  echo json_encode(false);
  mysqli_close($conn);
?>