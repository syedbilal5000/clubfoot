@extends('layouts.admin')

@section('content')
<style type="text/css">
  .fc-view>table {
    background-color: white;
  }
</style>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointment booking</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../registration">Registration</a></li>
            <li class="breadcrumb-item active">Appointment booking</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}
<div class="content">
<div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $('.patient_nav_add').addClass('active');
    
    /*
    //bilals show new appointment in the calender.
    $.ajax({
      url: main_url+'meetingS/getAllMeeting.php?empid='+empid,                        
      type: 'GET',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      dataType: "json",
      complete : function(response){
        var data = response.responseText; 
        // console.log(data);       
        var jsonR = JSON.parse(data);                
        // console.log(calendar)
        $('#calendar').fullCalendar('renderEvents', jsonR, true);
      },
      error: function (exception)
      {
        console.log(exception);
        //alert(exception.responseText);
      }
    });
    */
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear();
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        {
          title          : 'Long Event',
          start          : new Date(y, m, d, 10, 30),
          end            : new Date(y, m, d, 13, 30),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        }
        // {
        //   title          : 'Click for Google',
        //   start          : new Date(y, m, 28),
        //   end            : new Date(y, m, 29),
        //   url            : 'http://google.com/',
        //   backgroundColor: '#3c8dbc', //Primary (light-blue)
        //   borderColor    : '#3c8dbc' //Primary (light-blue)
        // }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      },
      eventDrop: function(event, delta, revertFunc) {

          if (!confirm("Are you sure about this change?")) {
            revertFunc();
          }
          else
          {
            edit_func(event);
          }
      },
      eventRender: function (event, element) {
        element.bind('mousedown', function (e) {
            if (e.which == 3) {
                if (!confirm("Are you sure you want to delete?")) {
                }
                else
                {
                  delete_func(event.id);
                }
            }
        });
      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
    function delete_func(id)
    {
      // bilals delete this appointment, but appointment should not be delete. :)
    }
    function edit_func(event) {
      // bilals change date for this appointment.
      /*
      var d = new Date(event.start.format());
      start_date = $.datepicker.formatDate('yy/mm/dd', d);
      // //alert(start_date);
      var post_data = "id=" + event.id + "&start_date=" + start_date;
      // //alert(post_data);
      $.ajax({
        url: main_url+'meetingS/EditMeetingDate.php?'+post_data, 
        type: 'GET',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        dataType: "json",
        success: function(response){
        },
        error: function (exception)
        {
          console.log(exception);
          //alert(exception.responseText);
        }
      });
      */
    }
  })
</script>
@endsection