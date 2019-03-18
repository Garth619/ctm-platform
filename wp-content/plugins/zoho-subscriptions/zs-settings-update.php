<?php 

function zoho_subscriptions_settings_update($authtoken, $orgid, $domain){
$orgdigest="";
if ($domain === 'zoho.eu') {
  $json = wp_remote_get("https://subscriptions.zoho.eu/api/v1/plans?authtoken=".$authtoken."&organization_id=".$orgid,'');  
} else {
  $json = wp_remote_get("https://subscriptions.zoho.com/api/v1/plans?authtoken=".$authtoken."&organization_id=".$orgid,'');
}
$content = $json['body'];
$obj = json_decode($content,true);
$code = $obj['code'];
if($code == 0){ 
  
  $plans = $obj['plans'];
  $plan_code = $plans{0}["plan_code"];
  if ($domain === 'zoho.eu') {
    $json = wp_remote_get('https://subscriptions.zoho.eu/api/v1/plans/' . $plan_code.'?authtoken='.$authtoken.'&organization_id='.$orgid,'');
  } else {
    $json = wp_remote_get('https://subscriptions.zoho.com/api/v1/plans/' . $plan_code.'?authtoken='.$authtoken.'&organization_id='.$orgid,'');
  }
  $content = $json['body'];
  $obj = json_decode($content,true);
  $code = $obj['code'];
  
  if($code == 0){
      $plan = $obj['plan'];
      $url = $plan['url'];
      $first_index = strpos($url,"subscribe/");
      $last_index = strrpos($url,"/");
      $orgdigest = substr($url,$first_index+10,$last_index-($first_index+10));  
      echo 'digest'.$orgdigest;
  }
  else{
    $message = $obj['message'];
    echo $message; 
}
}
else{
  $message = $obj['message'];
  echo $message;
}
}


if(isset($_POST['zs_action']) && !empty($_POST['zs_action'])) {
    $action = $_POST['zs_action'];
    if($action == 'zoho_subscriptions_settings_update'){
        $api_key =  $_POST['zs_api_key'];
        $domain = $api_key['zs_domain'];
        $authtoken = $api_key['zs_authtoken'];
        $orgid = $api_key['zs_org_id'];
        zoho_subscriptions_settings_update($authtoken,$orgid,$domain);
  }
}
?>