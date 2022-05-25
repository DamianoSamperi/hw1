<?php
$spotify_url="https://api.spotify.com/v1/browse/new-releases";
$spotify_token='https://accounts.spotify.com/api/token';
$client_id="dd29f8370e0d463c9b9f85f2753fc3a8";
$client_secret="d697efff6c854e128b796cf46962505c";
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $spotify_token );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
    $token=json_decode(curl_exec($ch), true);
    curl_close($ch);  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $spotify_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
    $res=curl_exec($ch);
    curl_close($ch);

    echo $res;
?>