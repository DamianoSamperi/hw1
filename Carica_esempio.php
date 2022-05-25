<?php

$api_recipes="https://api.edamam.com/api/recipes/v2?type=public&";
$api_id_recipes="d683117b";
$api_key="2efd83bc8dd404aac01c8a2b391867e5";
$dati = array("q" => "Cioccolato", "app_id" => $api_id_recipes,"app_key" => $api_key);
$dati = http_build_query($dati);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$api_recipes.$dati);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
echo $result;
?>