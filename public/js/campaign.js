$(document).ready(function(){
	indexing();
})

$(document).on('click','.add_message_button',function(){
	
	url=$(this).attr('attr_url')
	$.ajax({
	  url:url,
	  method:'get',
	  context:this,
	  beforeSend: function( xhr ) {
	    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  }
	})
  .done(function( data ) {
  	//console.log(data)
  	$(this).parents('.add_message').before(data);
  	indexing();
  
  });

})


$(document).on('click','.add_rule_button',function(e){
	e.preventDefault();
	var url=$(this).attr('href');
	var campaign_id=$(this).attr('attr_campaign_id');
	$.ajax({
	  url:url,
	  method:'get',
	  data:{campaign_id:campaign_id},
	  context:this,
	  beforeSend: function( xhr ) {
	    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  }
	})
  .done(function( data ) {
  	$(this).parents('.add_rule').before(data);
  	indexing();
  
  });

})

$(document).on('change','.execution_rule',function(){
	var execution_rule=$(this).val();
	var attr_time=$(this).attr('attr_time');
	$(this).parent().parent().parent().find('.rule_badge').html(execution_rule);
	if (execution_rule=='expression') {
		$(this).parents('.card_time'+attr_time).find('.expression_message').show();
		$(this).parents('.card_time'+attr_time).find('.expression_value').attr('required',true);
	}else{
		$(this).parents('.card_time'+attr_time).find('.expression_message').hide();
		$(this).parents('.card_time'+attr_time).find('.expression_value').attr('required',false);
	}
	if (execution_rule=='category') {
		$(this).parents('.card_time'+attr_time).find('.category_message').show();
		$(this).parents('.card_time'+attr_time).find('.category_value').attr('required',true);
	}else{
		$(this).parents('.card_time'+attr_time).find('.category_message').hide();
		$(this).parents('.card_time'+attr_time).find('.category_value').attr('required',false);
	}

})



$(document).on('click','.collapse_icon',function(e){
	e.preventDefault();
	var attr_time=$(this).attr('attr_time');
	var is_collapse=$(this).attr('attr_collapse');
	if (is_collapse=='yes') {
		$(this).parents('.card_time'+attr_time).find('.rule_body').hide();

		$(this).removeClass('fa-angle-right');
		$(this).addClass('fa-angle-down');
		$(this).attr('attr_collapse','no');
	}else{
	
		$(this).removeClass('fa-angle-down');
			$(this).addClass('fa-angle-right');
		$(this).attr('attr_collapse','yes');
		$(this).parents('.card_time'+attr_time).find('.rule_body').show();
	}
})

$(document).on('click','.collapse_message_icon',function(e){
	e.preventDefault();
	var attr_time=$(this).attr('attr_time');
	var is_collapse=$(this).attr('attr_collapse');
	if (is_collapse=='yes') {
		$(this).parents('.card_time'+attr_time).find('.card_message_body').hide();

		$(this).removeClass('fa-angle-right');
		$(this).addClass('fa-angle-down');
		$(this).attr('attr_collapse','no');
	}else{
	
		$(this).removeClass('fa-angle-down');
			$(this).addClass('fa-angle-right');
		$(this).attr('attr_collapse','yes');
		$(this).parents('.card_time'+attr_time).find('.card_message_body').show();
	}
})


$(document).on('click','.remove_message',function(e){
e.preventDefault();
var confirmation =confirm("Are you want to sure delete");
if (confirmation) {
	var attr_time=$(this).attr('attr_time');
	$(this).parents('.card_time'+attr_time).remove();
	var id=$(this).attr('attr_id');
	var url=$(this).attr('href');
	if (id !='') {
		$.ajax({
			  url:url,
			  method:'get',
			  data:{id:id},
			  beforeSend: function( xhr ) {
			    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			  }
			})
		  .done(function( data ) {
		  console.log(data);
		  });
	}
	indexing();
}

})


$(document).on('click','.remove_rules',function(e){
e.preventDefault();
var confirmation =confirm("Are you want to sure delete");
if (confirmation) {
	var attr_time=$(this).attr('attr_time');
	$(this).parents('.card_time'+attr_time).remove();
	var id=$(this).attr('attr_id');
	var url=$(this).attr('href');
	if (id !='') {
		$.ajax({
			  url:url,
			  method:'get',
			  data:{id:id},
			  beforeSend: function( xhr ) {
			    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
			  }
			})
		  .done(function( data ) {
		  console.log(data);
		  });
	}
	indexing();
}

})

$(document).on('change','#is_remind_campaign',function(){
	if($(this).is(":checked")){
		$(document).find('.is_reminder_hide').show();
		$(document).find('.before_reminder_hour').attr('required',true);
	}else{
		$(document).find('.is_reminder_hide').hide();
		$(document).find('.before_reminder_hour').attr('required',false);

	}
})
// $(document).on('change','#is_remind_campaign',function(){
// 	if($(this).is(":checked")){
// 		$(document).find('.is_reminder_hide').show();
// 	}else{
// 		$(document).find('.is_reminder_hide').hide();
// 	}
// })

$(document).on('change','.campaign_waiting_type',function(){
	var attr_time=$(this).attr('attr_time');
	$(this).parents('.card_time'+attr_time).find('.campaign_waiting_type_hidden').val($(this).val());
	if ($(this).val()==1) {
		
		$(this).parents('.card_time'+attr_time).find('.day_show').show();
		$(this).parents('.card_time'+attr_time).find('.day_hide').hide();
		$(this).parents('.card_time'+attr_time).find('.day_show').attr('required',true);
		$(this).parents('.card_time'+attr_time).find('.day_hide').attr('required',false);
	}else{
		$(this).parents('.card_time'+attr_time).find('.day_show').hide();
		$(this).parents('.card_time'+attr_time).find('.day_hide').show();
		$(this).parents('.card_time'+attr_time).find('.day_show').attr('required',false);
		$(this).parents('.card_time'+attr_time).find('.day_hide').attr('required',true);
	}
	
})

$(document).on('change','.is_remove_contact',function(){
	var attr_time=$(this).attr('attr_time');
	console.log(attr_time)
	console.log(1);
	if($(this).is(":checked")){
		$(this).parents('.card_time'+attr_time).find('.is_remove_contact_hidden').val(1);
	}else{
		$(this).parents('.card_time'+attr_time).find('.is_remove_contact_hidden').val(0);
	}
	
	

	
})




function indexing(){
var i=0;
$(document).find('.card_message_body').each(function(){
	$(this).find('.message_field').each(function(){
	var name=$(this).attr('attr_name')
	$(this).attr('name',name+'[]');
	})
	$(this).find('.rule_field').each(function(){
		var name=$(this).attr('attr_name')
		$(this).attr('name',name+'['+i+'][]');
	})

	console.log(i);
	i++;
})
}









