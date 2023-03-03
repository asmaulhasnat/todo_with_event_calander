$(document).ready(function () {

    var SITEURL = $(document).find('#calendar').attr('attr_site_url');;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: true,
        editable: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            //var title = prompt('Event Title:');
            // if (title) {
            //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD H:i");
            //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD H:i");
            //     $.ajax({
            //         url: SITEURL + "/fullcalenderAjax",
            //         data: {
            //             title: title,
            //             start: start,
            //             end: end,
            //             type: 'add'
            //         },
            //         type: "POST",
            //         success: function (data) {
            //             displayMessage("Event Created Successfully");

            //             calendar.fullCalendar('renderEvent',
            //                 {
            //                     id: data.id,
            //                     title: title,
            //                     start: start,
            //                     end: end,
            //                     allDay: allDay
            //                 },true);

            //             calendar.fullCalendar('unselect');
            //         }
            //     });
            // }
        },
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: end,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function (response) {
                    displayMessage("Event Updated Successfully");
                }
            });
        },
        eventClick: function (event) {
            //var deleteMsg = confirm("Do you really want to delete?");
            //if (deleteMsg) {
            $(document).find('.modal').show();
            //console.log(event.id);
            $.ajax({
                type: "get",
                url: SITEURL + '/todo/' + event.id,
                data: {
                    calander: 1,
                },
                success: function (response) {

                    $(document).find('#dynamic_form').html(response);
                    $(document).find('.select2').select2();
                    $(document).find("#date").datepicker({dateFormat: 'yy-mm-dd' });
                }
            });
            //}
        }

    });

});

$(document).on('click', '.close', function () {
    $(document).find('.modal').hide();
    //location.href='{{url('fullcalender')}}';
})

$(document).on('click', '.close_modal', function () {
    $(document).find('.modal').hide();
    //location.href='{{url('fullcalender')}}';
})

$(document).on('click', '.close_modal', function () {
    $(document).find('.modal').hide();
    //location.href='{{url('fullcalender')}}';
})


$(document).on('click','.reschedule',function(){
    var url=$(this).attr('attr_url')

    $.ajax({
        type: "get",
        url:url,
        data: {
            calander: 1,
        },
        success: function (response) {

            $(document).find('#dynamic_form').html(response);
            $(document).find('.select2').select2();
            $(document).find("#date").datepicker({dateFormat: 'yy-mm-dd' });

            //       $("#from_date").datetimepicker({
            //  format: 'yyyy-mm-dd hh:ii'
            // });
            //calendar.fullCalendar('removeEvents', event.id);
            //displayMessage("Event Deleted Successfully");
        }
    });

})


function displayMessage(message) {
    toastr.success(message, 'Event');
}

