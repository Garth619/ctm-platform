<?php

function zoho_subscriptions_embed_checkout($plan_code){
$zs_api_key = get_option('zs_api_key');  
$authtoken = '';
$org_id = ''; 
$org_digest =  '';
  //zs_api_key option value consists of authtoken, Organization ID and Organization digest
if($zs_api_key !=''){
  $domain = $zs_api_key['zs_domain'];
  $authtoken = $zs_api_key['zs_authtoken'];
  $org_id =  $zs_api_key['zs_org_id']; 
  $org_digest =  $zs_api_key['zs_org_digest']; 
  }
if($org_digest!=""){
echo $org_digest;
}else{
  if ($domain === 'zoho.eu') {
    $json = wp_remote_get("https://subscriptions.zoho.eu/api/v1/plans/".$plan_code."?authtoken=".$authtoken."&organization_id=".$orgid,'');
  } else {
    $json = wp_remote_get("https://subscriptions.zoho.com/api/v1/plans/".$plan_code."?authtoken=".$authtoken."&organization_id=".$orgid,'');
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
  update_option("zs_api_key['zs_org_digest']",$orgdigest);
  echo $orgdigest;
  }

//Handling the API failure case
else{
  $message =  $obj["message"];
}
}
}
if(isset($_GET['zs_action']) && !empty($_GET['zs_action'])) {
  if($_GET['zs_action'] == 'zoho_subscriptions_embed_checkout'){
    $plan_code =  $_POST['plan_code']; 
    zoho_subscriptions_embed_checkout($plan_code);
  }
}
?>
