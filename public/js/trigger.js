$(document).on('click','.add_more_trigger',function(){

	var dynamic_field=$(this).attr('attr_card_class');
	var url=$(this).attr('attr_url');
	var trigger_type=$(this).attr('attr_trigger_type');
	var category_id=$(this).attr('attr_category');
	var data={
		category_id:category_id,
		trigger_type:trigger_type
	}

	$.ajax({
	  url:url,
	  data:data,
	  method:'get',
	  beforeSend: function( xhr ) {
	    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  }
	})
  .done(function( data ) {
  	$(document).find('.'+dynamic_field+' .trigger-fields-box').append(data);
    // if ( console && console.log ) {
    //   console.log( "Sample of data:", data.slice( 0, 100 ) );
    // }

    $(document).find(".select2_dynamic").select2();
  });





})


$(document).on('click','.remove-trigger-settings',function(){

	var confirmation=confirm('Are you want to sure remove ?')
	if (confirmation) {

		var url=$(this).attr('attr_url');
		var id=$(this).attr('attr_id');
		var data={id:id};

		if (id!='') {
			$.ajax({
			  url:url,
			  data:data,
			  method:'get',
			  beforeSend: function( xhr ) {
			    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			  }
			})
		  	.done(function( data ) {
		  		
		  	});
		}
		$(this).parent().parent().remove()

	}
	

})