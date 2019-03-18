 (function() {
                var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                var eventer = window[eventMethod];
                var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
                eventer(messageEvent,function(e) {
                    document.getElementById('ZSubscriptions').height=e.data;
                },false); 
            }).call(window);     