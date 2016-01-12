<?php
function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v) 
   { 
      $postData .= $k . '='.$v.'&'; 
   }
   $postData = rtrim($postData, '&');
 
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
 
}
//set these values
$client_id = "Your twitch client id";
$client_secret = "Your twitch client secret";
$code = "The code from step 1";

$url = "https://api.twitch.tv/kraken/oauth2/token";
$post_vars = array(
"client_id" => $client_id;
"client_secret" => $client_secret;
"grant_type" => "authorization_code",
"redirect_uri" => "http://localhost",
"code" =>  $code,
"state" => "state");

echo httpPost($url,$post_vars);



