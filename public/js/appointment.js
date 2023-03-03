 $( document ).ready(function() {
    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        //$('.datepicker').datepicker(); 
        $('#timezone').val(moment.tz.guess())

        $('.select2').select2();
        $( "#from_date" ).datetimepicker();

        $("#from_date").datetimepicker({
			format: 'yyyy-mm-dd hh:ii'
		});

		$("#to_date").datetimepicker({
			format: 'yyyy-mm-dd hh:ii'
		});
    });
    $(document).on('change','.show_reminder_list',function(){
        $(this).parents('form').submit();
    })

    $(document).on('change','#date',function(){
        var url= $(this).attr('attr_url');
        var date=$(this).val();
        var time_zone=$(document).find('.time_zone').val();

        var data={date:date,time_zone:time_zone};
        dynamic_content_ajax(url,data,'#dynamic_content');
	        
	}) 

    $(document).on('change','.time_zone',function(){
        var time_zone=$(this).val();
        var date=$(document).find('#date').val();
        var url=$(document).find('#date').attr('attr_url');
        if (date!='') {
        var data={date:date,time_zone:time_zone};
        dynamic_content_ajax(url,data,'#dynamic_content');    
        }
    })

    $(document).on('change','.short_code_type',function(){
        var con = $(this).val();
       changeTypeAttribute(con,'#short_code_value');
    })

    $(document).on('change','.short_code_type_edit',function(){
        var con = $(this).val();
       changeTypeAttribute(con,'#short_code_value_edit');
    })


    

     $(document).on('change','.change_phone',function(){
      var url=$(this).attr('attr_url');
      var country_code=$(document).find('.country_code').val();
      var phone=$(this).val();
      var data={phone:phone,country_code:country_code}    
      dynamic_content_ajax(url,data,'#dynamic_customer');   
    })
     $(document).on('click','.edit_short_code_ajax',function(){
        //alert(5)
        var url = $(this).attr('attr_url');
        var redirect_route = $(this).attr('attr_current_route');
        var data={redirect_route:redirect_route};
        dynamic_content_ajax(url,data,'#dynamic_content'); 
    })

     $(document).on('change','#parent_category',function(){
    
        var url=$(this).attr('attr_url');
        var parent_id=$(this).val();
        if (parent_id!='') {
        var data={parent_id:parent_id};
        dynamic_content_ajax(url,data,'#category_id');    
        }
    })

      $(document).on('click', 'small.note span.shortcode', function (e) {
        var $tempElement = $("<input>");
        $("body").append($tempElement);
        var text=$(this).text();
        $tempElement.val(text.trim()).select();
        document.execCommand("Copy");
        $tempElement.remove();
        $(this).append("<div class='copied'></div>");
        setTimeout(function(){
            $('small.note span.shortcode').children('div.copied').remove();
        }, 2000);
    });


    

    