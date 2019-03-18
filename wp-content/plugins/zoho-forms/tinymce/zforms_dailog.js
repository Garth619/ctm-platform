var a="";
var zForms=new Array();
				
if(window.tinyMCE){ 
	var url = tinyMCEPopup.getWindowArg("plugin_url");
}
				
				
function zf_submit()
{
	var perma_link = document.getElementById("permalink").value;
	if(perma_link.length==0)
	{
		document.getElementById("permaLinkError").style.display="block";
		document.getElementById("permaLinkError").innerHTML="Please enter your form's public link.";
		document.getElementById("permaContainer").classList.add("errorCont");
	}
	else
	{
		var permaLinkFormWidth = document.getElementById('iframeWidth');
		if(permaLinkFormWidth.value=="")
		{
			permaLinkFormWidth.value="100%";
		}
		var permaLinkFormHeight = document.getElementById('iframeHeight');
		if(permaLinkFormHeight.value=="")
		{
			permaLinkFormHeight.value="600px";
		}	
		insertContent(perma_link,permaLinkFormWidth.value,permaLinkFormHeight.value);
	}
}

function insertContent(src,width,height)
{
		
		var tag = '[zohoForms src=';
		tag += src;
		tag += ' width=';
		tag += width;
		tag += ' height=';
		tag += height;
		tag += '/]';		
		if(window.tinyMCE)
		{
			var tmce_ver=window.tinyMCE.majorVersion;
			if (tmce_ver>="4")
			{
				window.tinyMCE.execCommand('mceInsertContent', false, tag);
			}
			else
			{
				window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tag);
			}
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}	
}

function closePopUp(){
	if(window.tinyMCE)
	{
		tinyMCEPopup.close();
	}
}
			
	
function getForms()
{
	if(a!="")
	{
		var len = a.forms.length;
		formList = document.getElementById("formname");
		for(i = 0; i < len;i++)
		{
			var option = document.createElement("option");
			option.text = a.forms[i].display_name;
			option.value = a.forms[i].link_name;
			formList.options.add(option);
			var formAndPerma = new Array();
			formAndPerma[0] = a.forms[i].link_name;
			formAndPerma[1] = a.forms[i].public_url;
			zForms[option.value] = formAndPerma;

		}
	}
					
}
				

function zforms_submit()
{
	var formName = document.getElementById("formname").value;
	if(formName == "-Select-")
	{		
		document.getElementById("formSelectionError").style.display="block";		
		document.getElementById("formSelectionError").innerHTML="Please select a form.";
		document.getElementById("selctContainer").classList.add("errorCont");
	}
	else
	{
		var formWidth = document.getElementById('width');
		if(formWidth.value=="")
		{
			formWidth.value="100%";
		}
		var formHeight = document.getElementById('height');
		if(formHeight.value=="")
		{
			formHeight.value="600px";
		}
		var urlBuild = zForms[formName][1];	
		insertContent(urlBuild,formWidth.value,formHeight.value);
		
	}
}
				
			
function embedPerma()
{
	if(document.getElementById("permaContainer").classList.contains("errorCont"))
	{
		document.getElementById("permaContainer").classList.remove("errorCont");
		document.getElementById("permaLinkError").style.display="none";
	}
	document.getElementById("publicLink").className= "selected";
	document.getElementById("permaLinkDiv").style.display="block";
	document.getElementById("createFormDiv").style.display="none";
	document.getElementById("chooseFormDiv").style.display= "none";
	document.getElementById("signinDiv").style.display="none";
	document.getElementById("refreshDiv").style.display="none";
	document.getElementById("selectForm").classList.remove("selected");
	
}
		
function signin()
{				
	if(window.tinyMCE)
	{
		window.open("https://www.zoho.com/forms/login.html");
		document.getElementById("refreshDiv").style.display="block";
		document.getElementById("signinDiv").style.display="none";
	}				
}
function appendScript()
{
	var scriptToAppend = document.createElement("script");
	scriptToAppend.type = "text/javascript";
	scriptToAppend.id="api";
	scriptToAppend.src = url+"/dynamicScript.js";
	document.head.appendChild(scriptToAppend);
}
function chooseForm()
{
	if(!document.getElementById("api")||a=="")
	{
		appendScript();
	}
	else
	{
		selectForm();
	}
}

function hideError()
{
	if(document.getElementById("selctContainer").classList.contains("errorCont"))
	{
		document.getElementById("selctContainer").classList.remove("errorCont");
		document.getElementById("formSelectionError").style.display="none";
	}
	if(document.getElementById("permaContainer").classList.contains("errorCont"))
	{
		document.getElementById("permaContainer").classList.remove("errorCont");
		document.getElementById("permaLinkError").style.display="none";
	}
}

function selectForm()
{
	document.getElementById("selectForm").classList.add("selected");
	if(document.getElementById("selctContainer").classList.contains("errorCont"))
	{
		document.getElementById("selctContainer").classList.remove("errorCont");
		document.getElementById("formSelectionError").style.display="none";
	}
		
	if(a!="")
	{
		if(a.forms.length==0)
		{
			document.getElementById("createFormDiv").style.display="block";
			document.getElementById("chooseFormDiv").style.display="none";
			document.getElementById("signinDiv").style.display="none";
		}
		else
		{
			document.getElementById("chooseFormDiv").style.display="block";
			document.getElementById("signinDiv").style.display="none";
		}	
	}
	else
	{	
		
		document.getElementById("signinDiv").style.display="block";


				
	}
	document.getElementById("permaLinkDiv").style.display= "none";
	document.getElementById("refreshDiv").style.display="none";
	document.getElementById("publicLink").className= "none";
}
		
function refresh()
{
	
	if(document.getElementById("api"))
	{
		document.getElementById("api").remove();
	}
	chooseForm();
}

function createForm()
{
	window.open("https://forms.zoho.com/");	
	document.getElementById("refreshDiv").style.display="block";	
	document.getElementById("createFormDiv").style.display="none";
	document.getElementById("signinDiv").style.display="none";
}
