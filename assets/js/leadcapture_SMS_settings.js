(function( $ ) {
	'use strict';
$( document ).on('click','#delete_message',function() {
		if (confirm("Are you sure want to delete?")) {
        	var id = $(this).data('id');
			$.ajax({
				// url:zohoajax.ajaxurl,
				url:ajaxurl,
				data:{'action':'delete_message','id':id},
				method:'POST',
				success:function(result){
					 // location.reload();
					var r = JSON.parse(result);
					if( r["code"] == 200 ){
						location.reload();
					}
					else{
						alert("Error on deletion");
					}
				}
			});
    	}
    	else{
    		return false;
    	}
		
	});
})( jQuery );