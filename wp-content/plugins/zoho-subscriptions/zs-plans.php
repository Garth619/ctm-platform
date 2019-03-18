<?php
function zoho_subscriptions_plans_list(){
//Fetching the authtoken and organization id
$zs_api_key = get_option('zs_api_key');  
$authtoken = '';
$org_id = ''; 
$org_digest =  '';
$message  = '';
  //zs_api_key option value consists of authtoken, Organization ID and Organization digest
if($zs_api_key !='') {
  $domain = $zs_api_key['zs_domain'];
  $authtoken = $zs_api_key['zs_authtoken'];
  $org_id =  $zs_api_key['zs_org_id']; 
  $org_digest =  $zs_api_key['zs_org_digest'];
}

if ($domain === 'zoho.eu') {
  $json = wp_remote_get("https://subscriptions.zoho.eu/api/v1/plans?authtoken=".$authtoken."&organization_id=".$org_id."&filter_by=PlanStatus.ACTIVE",''); 
} else {
  $json = wp_remote_get("https://subscriptions.zoho.com/api/v1/plans?authtoken=".$authtoken."&organization_id=".$org_id."&filter_by=PlanStatus.ACTIVE",'');
}
$content = $json['body'];
$obj = json_decode($content,true);
$code = $obj['code'];
if($code == 0){ 
  $plans = $obj['plans'];
}
//Handling the API failure case
else{
  $message =  $obj["message"];
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        
		<title>Zoho Subscriptions</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        
		<script>
		
		function exit(){				
				if(window.tinyMCE){
					tinyMCEPopup.close();					
				}				
			}
          
         
              function embedCode(org_digest){
                var plan_code = this.document.getElementById("plan_code").value;
                var url  = "https://subscriptions.zoho.com/subscribe/"+org_digest+"/"+plan_code;
                <?php if ($domain === 'zoho.eu') { ?>
                  var url  = "https://subscriptions.zoho.eu/subscribe/"+org_digest+"/"+plan_code;
                <?php } ?>
                var html = '<iframe src="'+url+'" width="700" height="900" id="ZSubscriptions" style="border:none;"></iframe>';
                var ed   =  window.tinymce.activeEditor;
                ed.insertContent( html );
                var js = "\x3Cscript type='text/javascript' src='"+"<?php echo plugins_url("",__FILE__); ?>"+"/assets/js/zs-height-custom.js'>\x3C/script>";
                ed.insertContent(js);
                exit();
              }
          
          function embed_iframe(){
            jQuery.ajax({
            type: 'post',
            url: 'admin.php?zoho-subscriptions-settings/zs-embed-checkout.php&zs_action=zoho_subscriptions_embed_checkout',
            data: jQuery('form').serialize(),
            success: function (orgdigest) {
             embedCode(orgdigest);  
            }
          });
          }
           
        
	</script>
			<style type="text/css">
				.head1{padding-top:5px;padding-bottom:5px;color:#000;}
              .button-primary{background-color:#d64830;color:#fff;margin-right:5px;}
               .button{padding:7px 12px;box-shadow:none;background-image:none;border:1px solid rgba(0,0,0,.1);border-radius:2px;margin-top:10px;font-size:13px;}
              #failure_msg{
  padding:10px;
  background-color:#FFF1EC;
  color:#E65453;
}
              .forceColors{
                margin:0;
              }
		</style>

     </head>
     <body>
      
		
	    <form method="post" name="frm" id="frm">
          <?php 
if($message) {
       ?>
           <div id="failure_msg"><?php 
echo $message ?></div>
          <?php } ?>
          
			
              <?php  if(count($plans) == 0){
 
?>     <div style="padding:30px 20px 20px 20px;font-size:17px;">There are no plans configured in this organization. Please check the account details and continue.</div>
            <div style="margin-left:125px;"><input type="button" class="button button-primary" value="OK" onclick="exit();"></div>
           
          <?php } else{ ?>
				<table width="90%" cellspacing="5" cellpadding="3" border="0" style="padding:10px;">
				<tr>
                  <td> 
						
                    <div style="font-weight: 600;font-size: 12px;margin-bottom: 5px;margin-top: 10px;font-family:sans-serif;">CHOOSE THE PLAN</div>
                    <select id="plan_code" name="plan_code" style="height:40px;border-radius:5px;width:245px;font-size:14px;background-color:#fff;border-color:#EDEDED">
                    <?php 
foreach ($plans as $plan) {
       ?>
                      <option value="<?php echo $plan["plan_code"]?>"><?php echo $plan["name"]?> (<?php echo $plan["plan_code"]?>)</option>
 <?php } 
?>
                    
                    </select>
					</td>
				</tr>
              <tr>
                <td>
                  <div style="margin-top:10px;">
				<input type="button" onclick="embed_iframe()" value="OK" class="button button-primary">
                  <input type="button" style="background-color:#fff;" value="Cancel" onclick="exit()" class="button">
                    </div>
                  </td>
                </tr>
              <?php } ?>
			</table>
		</form>
	</body>
  
  
  
</html>
<?php } 
if(isset($_GET['zs_action']) && !empty($_GET['zs_action'])) {
  if($_GET['zs_action'] == 'zoho_subscriptions_plans_list'){
    zoho_subscriptions_plans_list();
  }
}?>