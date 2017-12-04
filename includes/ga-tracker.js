
	
	jQuery(document).ready( function($) {

        //set our domain as a variable
        var domainString = document.domain;
        var webminiString = "webminis.tyndale.com";
		
		
        //select each anchor whose href begins "http://"
        $('a').each(function() {
			try {        
		
                //set url's href as a variable
                var url = $(this).attr('href');
                
                //if url does not contain our domain name
                if ( url.indexOf( domainString ) == -1 &&  url.indexOf( webminiString ) == -1  ) {
					
					//external link clicks
					$( this ).attr( 'onClick', '_gaq.push(["_trackEvent","Outbound Links","Click","'+url+'"])' );
			
                } 
				else {
					//internal link clicks
					 $( this ).attr( 'onClick', '_gaq.push(["_trackEvent","Internal Links","Click","'+url+'"])' );
				}
			} catch (e) {
				//this will tag "mailto:" and relative links
				//internal link clicks
					 $( this ).attr( 'onClick', '_gaq.push(["_trackEvent","Internal Links","Click","'+url+'"])' );
			}
        });
		
		
		//for input buttons
		$('input').each(function() {
        		//use value first
				var tag = $(this).val();
								
				//if no value try class
				if (tag === undefined) {
					tag = $(this).attr('class');
				}
				
				//if no class try id
				if (tag === undefined) {
					tag = $(this).attr('id');
				}
				
				//if its ajax or client generated HTML
				if (tag === undefined || tag == "") {
					tag = "Undefined button value. (AJAX / Client Generated HTML)"	
				}
				
				$( this ).attr( 'onSubmit', '_gaq.push(["_trackEvent","Input Buttons","Click","'+tag+'"])' );
        });		
	});
