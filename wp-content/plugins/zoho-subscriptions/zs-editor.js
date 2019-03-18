(function() {  
    tinymce.create('tinymce.plugins.subscriptions', {  

	init : function(ed, url) {  
	    ed.addCommand('zs_embed_window',function(){
		ed.windowManager.open({
			file : 'admin.php?zoho-subscriptions-settings/zs-loading.php&load=true',
			title : 'Zoho Subscriptions',
			width : 350, 
			height : 200,
            inline :1
		},{plugin_url : url});
          
		});
		  
            ed.addButton('subscriptions', {  
                title : 'Zoho Subscriptions',
				cmd : 'zs_embed_window',  
                image : url+'/favicon.png' 				
            });
			return false;
        }
         
    });  
    tinymce.PluginManager.add('subscriptions', tinymce.plugins.subscriptions);  
	
    
})();  

