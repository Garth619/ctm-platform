<?php
if(isset($_GET['load'])) {
    zoho_subscriptions_loading_indicator();
}
function zoho_subscriptions_loading_indicator(){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
		<title>Zoho Subscriptions</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="<?php echo includes_url("",__FILE__); ?>/js/jquery/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo includes_url("",__FILE__); ?>/js/tinymce/tiny_mce_popup.js"></script>
      	</head>	
	<body>
      <div id="content">
		<div style="position:absolute;top:30%;left:35%;font-size : 16px;">Loading ...</div>
		<div style="position:absolute;top:45%;left:35%"><img id ="image" src="<?php echo plugins_url("",__FILE__); ?>/loader.gif"></div>
        
		</div>
	</body>
     <script language="javascript" type="text/javascript">
		    jQuery(document).ready(function(){
              jQuery.ajax({        // call php script
                      url: 'admin.php?zoho-subscriptions-settings/zs-plans.php&zs_action=zoho_subscriptions_plans_list',
                      contentType: 'html',
              }).success(function(data){
            // remove loading image and add content received from php 
              jQuery('#content').html(data);

                }).error(function(jqXHR, textStatus, errorThrown){
                  // in case something went wrong, show error
             jQuery('div#error_msg').append('Sorry, something went wrong: ' + textStatus + ' (' + errorThrown + ')');
    });
});
		</script>
	</html>
<?php } 


?>