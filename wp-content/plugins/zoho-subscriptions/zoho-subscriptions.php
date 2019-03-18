<?php

/*
Plugin Name:Zoho-Subscriptions
Plugin URI: https://www.zoho.com/subscriptions/help/wordpress-integration.html
Description: Helpful in embedding Zoho Subscriptions checkout page into wordpress page.
Version: 1.1.1
Author:Zoho Subscriptions
Author URI: https://subscriptions.zoho.com
*/

function zsplugin_script() {
//To load the Zoho Subscriptions's CSS
wp_enqueue_style( 'zohosubscriptions_style', plugin_dir_url( __FILE__ ) . '/assets/css/zoho-subscriptions.css', false, '1.0.0' );
}

function zs_register_my_custom_menu_page() {
//To show the Zoho Subscriptions icon in the left side
add_menu_page( 'Zoho Subscriptions', 'Zoho Subscriptions', 'manage_options', 'zoho-subscriptions-settings', 'zs_init_home', plugins_url('assets/images/favicon.ico',__FILE__), 91 );
}

function zs_init_home() {
$zs_api_key = get_option('zs_api_key');
$domain = '';
$authtoken = '';
$org_id = ''; 
$org_digest =  '';   
$organizations = '';

//zs_api_key option value consists of authtoken, Organization ID and Organization digest
if($zs_api_key !=''){
  $domain = $zs_api_key['zs_domain'];
  $authtoken = $zs_api_key['zs_authtoken'];
  $org_id =  $zs_api_key['zs_org_id']; 
  $org_digest =  $zs_api_key['zs_org_digest'];
}

if ($domain === 'zoho.eu') {
  $general_data_center_selected=false;
  $eu_data_center_selected=true;
  $authtoken_url= 'https://accounts.zoho.eu/apiauthtoken/create?SCOPE=ZohoSubscriptions/subscriptionsapi';
} else {
  $general_data_center_selected=true;
  $eu_data_center_selected=false;
  $authtoken_url = 'https://accounts.zoho.com/apiauthtoken/create?SCOPE=ZohoSubscriptions/subscriptionsapi';
}

if($authtoken){
  //If the authtoken is already saved, then fetching the organizations list with that authtoken
  if ($general_data_center_selected) {
    $json = wp_remote_get( "https://subscriptions.zoho.com/api/v1/organizations?authtoken=".$authtoken,'');
  } else {
    $json = wp_remote_get( "https://subscriptions.zoho.eu/api/v1/organizations?authtoken=".$authtoken,'');
  }
  $content = $json['body'];
  $obj = json_decode($content,true);
  $code = $obj['code'];
  $message = $obj['message'];
  //If there is no error then the code will be "0"
  if($code == 0){
      $organizations = $obj['organizations'];
      }
  }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">      
      <style type="text/css">
        
        #wpcontent{
          background-color: #E9EEF2!important;
        }

        #wpbody-content{
          background-color: #E9EEF2!important;
        }

        #wpfooter{
          background-color: #E9EEF2!important;
        }
    </style>          

<script>
  
function showErrorMessage(message){
    jQuery("#failure_msg").html(message);
    jQuery("#failure_msg").css("display","block");
    }
  
jQuery(function () {
    jQuery('#submit').on('click', function (e) {
    e.preventDefault();
    jQuery("#failure_msg").css("display","none");
  
    var authtoken = document.getElementById("authtoken").value;
    var orgid = document.getElementById("orgid").value;
    if(authtoken =="" || authtoken==undefined){
        showErrorMessage("Please enter the authtoken");
        return;
        }
  
    jQuery("#submit_loading").css("display","inline-block");
    jQuery("#zs_action").val("zoho_subscriptions_settings_update");
    jQuery.ajax({
    type: 'post',
    url: 'admin.php?zoho-subscriptions-settings/zs-settings-update.php',
    data: jQuery('form').serialize(),
    success: function (html) {
    
    if(html.indexOf('digest') == -1){
    showErrorMessage(html);
    }else{
    html = html.substring(6);
    jQuery("#org_digest").val(html);  
    jQuery.ajax({
    type: 'post',
    url: 'options.php',
    data: jQuery('form').serialize(),
    success: function () {
    jQuery("#submit_loading").css("display","none");
    jQuery('#status_msg').slideDown('slow').delay(1500).fadeOut('slow');
    }
    });
    }
    },
    failure:function(){
    showErrorMessage("There is an error in processing your request. Please try again later.");
    }
    });
});

  var computedOrganizationList = function() {
    jQuery("#failure_msg").css("display","none");
    jQuery("#loading").css("display","block");
    jQuery("#orgid").html("");
    jQuery("#zs_action").val("zoho_subscriptions_organizations_list");
    jQuery.ajax({
      type: 'post',
      url: 'admin.php?zoho-subscriptions-settings/zs-organizations.php',
      data: jQuery('form').serialize(),
      success: function (org_html) {
        jQuery("#loading").css("display","none");
        //If there is no org created in Zoho Subscriptions, a link to signup will be shown
        if(org_html == "Signup"){
          jQuery("#orgid").css("display","none");
          jQuery("#orglabel").css("display","none");
          jQuery("#submit").css("display","none");
          jQuery("#signup").css("display","block");
        } else {
          if(org_html.indexOf("option")!=-1){
            jQuery("#orgid").html(org_html);
            jQuery("#general_domain").prop("checked", true);
            jQuery("#eu_domain").prop("checked", false);            
          } else{
            /* Runs the second API to ensure the account is in EU*/
            jQuery("#zs_action").val("EU_zoho_subscriptions_organizations_list");
            jQuery.ajax({
              type: 'post',
              url: 'admin.php?zoho-subscriptions-settings/zs-organizations.php',
              data: jQuery('form').serialize(),
              success: function (org_html) {
                jQuery("#loading").css("display","none");
                //If there is no org created in Zoho Subscriptions, a link to signup will be shown
                if(org_html == "Signup"){
                  jQuery("#orgid").css("display","none");
                  jQuery("#orglabel").css("display","none");
                  jQuery("#submit").css("display","none");
                  jQuery("#signup").css("display","block");
                } else {
                  if(org_html.indexOf("option")!=-1){
                    jQuery("#orgid").html(org_html);
                    jQuery("#general_domain").prop("checked", false);
                    jQuery("#eu_domain").prop("checked", true);

                  } else{
                    showErrorMessage(org_html);
                  }
                }

            },
            failure : function() {
              showErrorMessage("There is an error in processing your request. Please try again later.");
            }
          });
        }
       }
      },
      failure : function() {
        showErrorMessage("There is an error in processing your request. Please try again later.");
      }        
    });
  };
  
    jQuery("#authtoken").change(function() {
      computedOrganizationList();
    });
  });
  </script>
          
        </head>
        <body >
          <div id="status_msg" align="center" style="display:none">
            <div>Account details updated successfully</div>
          </div>
            <form method="post" action="options.php">
               <?php settings_fields( 'zs_settings_group' ); ?>
               <?php do_settings_sections( 'zs_settings_group' ); ?>
              <input type="hidden" name="zs_api_key[zs_org_digest]" id="org_digest"/>
              <input type="hidden" name="zs_action" id="zs_action"/>
                <div class="zswelcomepanouter" id="api_key_div">
                    <div class="zswelcomepan">
                        
                        <div class="zswelheading" style="margin-top: 20px;text-align:center;">
                            Zoho Subscriptions Account Details
                        </div>
                      <div id="failure_msg" style="display:none;"></div>
                        <div style="margin-top:40px;padding-left:40px;">
                            <table width="100%" border="0" cellspacing="10" cellpadding="0" style="font-size:14px!important">
                              
                                <tr style="display: none;">
                                  <td height="45" width="40%"> 
                                    <div class="label">WHERE ARE YOU ARE FROM?</div>
                                    <label style="margin-right: 20px;"> 
                                      <input type="radio" name="zs_api_key[zs_domain]" id="general_domain" value="zoho.com" <?php if($general_data_center_selected) { ?> checked=true <?php } ?> /> subscriptions.zoho.com
                                    </label>
                                    <label>
                                      <input type="radio" name="zs_api_key[zs_domain]" id="eu_domain" value="zoho.eu" <?php if($eu_data_center_selected) { ?> checked=true <?php } ?> />
                                      subscriptions.zoho.eu
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                   
                                    <td height="45" width="40%"> 
                                       <div class="label">AUTHTOKEN</div>
                                        <input type="password" id="authtoken" name="zs_api_key[zs_authtoken]" value="<?php echo $authtoken ?>" style="font-size:14px!important;padding:10px;height:40px;width:100%"/>
                                      <div class="zslink" style="padding-top:5px;">
                                            <a class="zssmallink" style="text-decoration:none;font-size:12px;" href="<?php echo $authtoken_url ?>" id="help_link" target="_blank">
                                                click to generate the authtoken
                                            </a>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        
                                    </td> 
                                </tr>
                                
                               <tr>
                                    
                                    <td height="45" width="40%"> 
                                      <div style="margin-top:30px;" class="label" id="orglabel">CHOOSE THE ORGANIZATION</div>
                                      
                                      <div id="loading" style="display:none;font-style:italic;position:absolute;margin-top:12px;padding-left:10px;"> <img src="<?php echo plugins_url('assets/images/loading.gif',__FILE__); ?>" style="height:20px;"/><div style="padding-left:5px;position: absolute;width: 200px;display:inline-block;">Fetching Organizations</div></div>
                                      
                                      
                                      <?php if($organizations){ ?>
                                       <select id="orgid" value="<?php echo esc_attr( $orgid ); ?>" name="zs_api_key[zs_org_id]" style="height:40px;border-radius:5px;width:445px;font-size:14px;">
                                          
                    <?php 
foreach ($organizations as $organization) {
  $mode ="";
  $selected = "";
  if($organization["mode"] == "test"){
    $mode = "Test";
  }else if($organization["mode"] == "live"){
    $mode = "Live";
  }else if($organization["mode"] == "read_only"){
    $mode = "Read Only";
  }
  if($org_id == $organization["organization_id"]){
    $selected = "selected";
  }
       ?>
                                         
                      <option value="<?php echo $organization["organization_id"]?>" <?php echo $selected ?>><?php echo $organization["name"]?>  (<?php echo $mode ?>)</option>
 <?php } 
?>
                    
                    </select>
                                      <?php } else{ ?> <select id="orgid" name="zs_api_key[zs_org_id]" style="height:40px;border-radius:5px;width:445px;font-size:14px;"> <option id="prompt">Please provide the authtoken</option></select>   
                              <?php } ?>
                                      <button type="button" id="signup" class="button button-primary" style="display:none;box-shadow:none;margin-top: 10px;height: 35px;font-weight: 600;font-size: 15px;border-radius:2px;background-color:#168BCC"><a href="https://www.zoho.com/subscriptions/signup/" target="_blank" style="text-decoration:none;color:#fff;">START A TEST ACCOUNT</a></button>
                                    </td>
                               
                                    <td>
                                        &nbsp;
                                       
                                    </td>
                                </tr>
                              <tr><td>
                              <div style="margin-top:15px;">
                                            <button id="submit" class="button button-primary" style="box-shadow:none;margin-top: 10px;width: 105px;height: 35px;font-weight: 600;font-size: 15px;border-radius:2px;background-color:#168BCC">
                                              <div style="padding-left:20px;display:none" id="submit_loading"><img  src="<?php echo plugins_url('assets/images/ajax-loader.gif',__FILE__); ?>" style="height:20px;margin:-15px 0 0 -25px;position:absolute"/></div> SAVE
                                            </button>
                                        </div>
                                </td></tr>
                            </table>
                        </div>
                        <br />
                    </div>
                </div>
               
    
            </form>
            <br/>
        </body>
    </html>
<?php
}
// Adding filters for the external plugins.

function zs_plugin_initial_tasks() { 
     add_filter('mce_external_plugins', 'add_zsplugin');  
     add_filter('mce_buttons', 'register_zsbutton');  
  
     //Creating the option:  zs_api_key contains - authtoken, organization_id, org digest
     register_setting( 'zs_settings_group', 'zs_api_key' );
     include( plugin_dir_path( __FILE__ ) . '/zs-organizations.php'); 
     include( plugin_dir_path( __FILE__ ) . '/zs-settings-update.php'); 
     include( plugin_dir_path( __FILE__ ) . '/zs-loading.php'); 
     include( plugin_dir_path( __FILE__ ) . '/zs-plans.php'); 
     include( plugin_dir_path( __FILE__ ) . '/zs-embed-checkout.php'); 
}
    
// Registering the TinyMCE button.

function register_zsbutton($buttons) {  
   array_push($buttons, "subscriptions");  
   return $buttons;  
}  

function add_zsplugin($plugin_array) {  
   $plugin_array['subscriptions'] = plugin_dir_url( __FILE__ ) . 'zs-editor.js'; 
   return $plugin_array;  
}  

function zoho_subscriptions_deactivate(){
  delete_option('zs_api_key');
}

    add_action( 'admin_init', 'zs_plugin_initial_tasks' );
    add_action( 'admin_menu', 'zs_register_my_custom_menu_page' );
    add_action( 'admin_enqueue_scripts', 'zsplugin_script' );
    register_deactivation_hook( __FILE__, 'zoho_subscriptions_deactivate' );
?>