<?php

require_once dirname(__FILE__).'/../zforms_config.php';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        
		<title>Zoho Forms</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script language="javascript" type="text/javascript" src="zforms_dailog.js"></script> 
		<link href="zforms_dailog.css" rel="stylesheet">		
     </head>
     <body style="margin:0;" >
	
		<div class="legendCont">
			<div class="legandTabCont">
				<a href="javascript:void(0);" class="selected" id="publicLink" onclick="embedPerma()" > <em>Use Public Link</em></a>
				<a class="lastTab" href="javascript:void(0);" id="selectForm" onclick="chooseForm()"><em>Select Your Form</em></a>
				<div class="clearBoth"></div>
			</div>
	
			<div class="popupOuterWrapper" id="permaLinkDiv">
	   			<div class="popupInnerWrapper">
				<label>Enter your form's public link<em>*</em></label>
				<div class="popupContainer" id="permaContainer">
					<textarea id="permalink" rows="4" style="width:100%" onchange="hideError()"></textarea>
					<p id="permaLinkError" style="display:none;"/>
				</div>
	   			</div>

	   			<div class="twoColumns">
	     				<div class="popupInnerWrapper flLeft">
						<label>Width </label>
						<div class="popupContainer">
						<input type="text" value="100%" id="iframeWidth">
						</div>
	    				</div>
 	  				<div class="popupInnerWrapper flRight">
						<label>Height </label>
						<div class="popupContainer">
						<input type="text" value ="600px" id="iframeHeight">
						</div>
	   				</div>
					<div class="clearBoth"></div>
				</div>	
	 			<div class="popupInnerWrapper popupContainer popupFotter">
					<input class="blue" type="submit" value="Embed"  onclick="zf_submit()">
					<input type="submit" value="Cancel" onclick="closePopUp();">
		
	   			</div>			
			</div>
	

			<div class="popupOuterWrapper" id="chooseFormDiv" style="display:none">
				 
	   			<div class="popupInnerWrapper">
					<label>Choose a form<em>*</em></label>
					<div class="popupContainer" id="selctContainer">
						<select id="formname" onchange="hideError()"; style="width: 100%">
							<option>-Select-</option>
						</select>
						<p id="formSelectionError" />
					</div>
				</div>
				<div class="twoColumns">
					<div class="popupInnerWrapper flLeft">
						<label>Width </label>
						<div class="popupContainer">
							<input type="text" value="100%" id="width">
						</div>
	   				</div>
 	  				<div class="popupInnerWrapper flRight" >
						<label>Height </label>
						<div class="popupContainer">
							<input type="text" value ="600px" id="height">
						</div>
	   				</div>
					<div class="clearBoth"></div>
				</div>
	 			<div class="popupInnerWrapper popupContainer popupFotter">
					
					<input class="blue" type="submit" value="Embed"  onclick="zforms_submit()">
					<input type="submit" value="Cancel" onclick="closePopUp();">
				
	   			</div>	
			</div>
			
			<div class="popupOuterWrapper" id="signinDiv" style="display:none">
				<div class="popupInnerWrapper">
					<div class="signWrapper">
						<p> Sign in to your Zoho Forms account to select a form. </p>
						<input class="blue" type="button" value="Sign In"  onclick="signin()">	
					</div>
				</div>	
			</div>
			<div class="popupOuterWrapper" id="createFormDiv" style="display:none">
				<div class="popupInnerWrapper">
					<div class="signWrapper">
						<p> You have not created any forms yet. Click on Create to build a new form. </p>
						<input class="blue" type="button" value="Create"  onclick="createForm()">	
					</div>
				</div>	
			</div>

			<div class="popupOuterWrapper" id="refreshDiv" style="display:none">
				<div class="popupInnerWrapper">
					<div class="signWrapper">
					<p> Please Refresh to view your forms. </p>
					<input class="blue" type="button" value="Refresh" id="button_refresh"  onclick="refresh()">	
					</div>
				</div>	
		
			</div>

			<div class="brandingFotterWrapper">
				<div class="flRight brandingFotterCont"> 
					<span class="flLeft">Powered by</span> 
					<img src="smallLogo.png">
					<div class="clearBoth"></div>
				</div>
			
				<div class="clearBoth"></div>	
			</div>
		
 		</div>
			
	</body>
</html>

