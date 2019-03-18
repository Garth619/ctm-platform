<?php
function zoho_subscriptions_get_org_list($authtoken, $domain){
if ($domain === 'zoho.eu') {
  $json = wp_remote_get( "https://subscriptions.zoho.eu/api/v1/organizations?authtoken=".$authtoken, array(
    'timeout' => 1000
  ));
} else {
  $json = wp_remote_get( "https://subscriptions.zoho.com/api/v1/organizations?authtoken=".$authtoken, array(
    'timeout' => 1000
  ));
}
if (is_wp_error($json))
{
  var_dump($json);
}
$content =  $json['body'];

$obj = json_decode($content,true);
$organizations = [];

$code=$obj['code'];
$message = $obj['message'];

if($code == 0){
  $organizations = $obj['organizations'];
  if(count($organizations) == 0){
echo "Signup";
}

    $org_html="";
    $org_option="";
  //Listing organizations
foreach ($organizations as $organization) {
  $mode ="";
  if($organization["mode"] == "test"){
    $mode = "Test";
  }else if($organization["mode"] == "live"){
    $mode = "Live";
  }else if($organization["mode"] == "read_only"){
    $mode = "Read Only";
  }
   $org_option="<option value=".$organization["organization_id"].">".$organization["name"]." (".$mode.")</option>";
   $org_html.=$org_option;
}
echo $org_html;
}
else{
   echo $message;
}
}

if(isset($_POST['zs_action']) && !empty($_POST['zs_action'])) {
  $action = $_POST['zs_action'];
  $zs_api = $_POST['zs_api_key'];
  if($action == 'zoho_subscriptions_organizations_list'){
    $domain = 'zoho.com';
    $authtoken=$zs_api['zs_authtoken'];
    zoho_subscriptions_get_org_list($authtoken, $domain);
  } else if ($action == 'EU_zoho_subscriptions_organizations_list') {
    $domain = 'zoho.eu';
    $authtoken = $zs_api['zs_authtoken'];
    zoho_subscriptions_get_org_list($authtoken, $domain);
  }
}


?>
