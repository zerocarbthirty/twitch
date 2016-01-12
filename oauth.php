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
$code = $_GET['code'];
//set these values
$client_id = "Your twitch client id";
$client_secret = "Your twitch client secret";
$redirect_uri = "http://www.yourwebsite.com/oauth.php";

$url = "https://api.twitch.tv/kraken/oauth2/token";
$post_vars = array(
"client_id" => $client_id,
"client_secret" => $client_secret,
"grant_type" => "authorization_code",
"redirect_uri" => $redirect_uri,
"code" =>  $code,
"state" => "state");
$z = json_decode(httpPost($url,$post_vars));
$token_pfx = "oauth:";
$at = $z->access_token;
$token = "$token_pfx$at";
echo "Your oauth token is: $token";



