<?php
$api_recipes="https://api.edamam.com/api/recipes/v2?type=public&";
$api_id_recipes="d683117b";
$api_key="2efd83bc8dd404aac01c8a2b391867e5";
session_start();
$conn=mysqli_connect('localhost','root','','login');
$username=mysqli_real_escape_string($conn,$_GET['q']);
$username_corente=mysqli_real_escape_string($conn,$_SESSION['username']);
$query = "SELECT username FROM utente WHERE username ='$username' && username !='$username_corente'";
$res= mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
  $query= "SELECT label FROM labels WHERE username='$username' LIMIT 3";
  $res1=mysqli_query($conn,$query);
  if(mysqli_num_rows($res1)>0){
      foreach ($res1 as $ind => $value) {
        $api_recipes_url=$api_recipes.$value['label'].'?'."type=public&app_id=".$api_id_recipes."&app_key=". $api_key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$api_recipes.$dati);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $res=mysqli_query($conn,$query);
        $array[$ind]=[$result];
      }
    echo json_encode($array);
  }else
  echo json_encode($error=['0'=>false,'1'=>true]);
}else
echo json_encode($error=['0'=>true,'1'=>false]);
mysqli_close($conn);
?>