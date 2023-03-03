function dynamic_content_ajax(url,data={},dynamic_id,method='get'){
	console.log(data);
	$.ajax({
	  url:url,
	  data:data,
	  method:method,
	  beforeSend: function( xhr ) {
	    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  }
	})
  .done(function( data ) {
  	$(document).find(dynamic_id).html(data);
    // if ( console && console.log ) {
    //   console.log( "Sample of data:", data.slice( 0, 100 ) );
    // }
  });
}

function changeTypeAttribute(con,dynamic_id){
	if (con=='file') {
		$(document).find(dynamic_id).attr('type','file');
	}else{
		$(document).find(dynamic_id).attr('type','text');
	}


}
function dynamic_content_blob(url,data={},dynamic_id,method='get'){
	console.log(data);
	$.ajax({
	  url:url,
	  data:data,
	  method:method,
	  xhrFields:{
      responseType: 'blob'
      },
	  beforeSend: function( xhr ) {
	    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  }
	})
  .done(function( data ) {
    var blob=new Blob([data], { type: 'application/pdf' });
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    $(document).find(dynamic_id).attr('src',link.href);
    $(document).find('#dynamic_content').show();
    $(document).find('.close_iframe').show();
    
  });
}

