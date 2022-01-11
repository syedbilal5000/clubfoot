@extends('layouts.admin')

@section('content')
<style type="text/css">
  .fc-view>table {
    background-color: white;
  }
  .select2-selection {
    height: unset !important;
    border: 1px solid #ced4da !important;
    border-radius: unset !important;
    padding: 0.375rem .75rem !important;
  }
</style>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointments</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Appointment Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
<!-- BilalS - filter for different status like pending, done -->
<!-- BilalS - different filters like patients, status, etc - need to think -->
{{-- Main Content --}}
<div class="content">
<div class="container-fluid">
  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Patient: </label>
          <select id="patients" class="form-control select2" style="width: 100%;">            
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Status: </label>
          <select id="status_drop" class="form-control select2" style="width: 100%;">
            <option value="Pending">Pending</option>
            <option value="Done">Done</option>
            <option value="Reject">Reject</option>
            <option value="Extend">Extend</option>
          </select>
        </div>
      </div>
    </div>
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
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<!-- Page specific script -->
<script>
  var jsonArrPending = [];
  var jsonArrDone = [];
  var jsonArrExtend = [];
  var jsonArrReject = [];
  $(function () {
    $('.appointment_nav').addClass('active');
    $('.appointments_nav').addClass('active');
    renderNewCalender();
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
    function renderNewCalender()
    {
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear();
      $('#calendar').fullCalendar('destroy');
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
          // $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

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
    }

    function delete_func(id)
    {
      // bilals delete this appointment, but appointment should not be delete. :)
    }
    function edit_func(event) {
      // bilals change date for this appointment.
    }
    var patients_appoint = {!! json_encode($patients_appoint) !!};
  
    fill_data(patients_appoint);

    function fill_data(patients_appoint) {
    output = '<option value="">Select Patient</option>';
    
    if (patients_appoint.length > 0) {
      var patientCheck = {};
        for (i = 0; i < patients_appoint.length; i++) {
          // console.log(patients_appoint[i])
          if(patientCheck[patients_appoint[i]['patient_id']] == true)
          {

          }
          else {
            patientCheck[patients_appoint[i]['patient_id']] = true;
            output += `<option value="${patients_appoint[i]['patient_id']}">${patients_appoint[i]['patient_name']},${patients_appoint[i]['guardian_number']},${patients_appoint[i]['guardian_cnic']}</option>`;
          }
            
            if(patients_appoint[i]['status'] == "Pending")
            {
              backgroundColor = "#f7bd1b";
              jsonArrPending.push({
                title          : patients_appoint[i]['patient_name'],
                start          : patients_appoint[i]['appointment_date'],
                end          : patients_appoint[i]['appointment_date'],
                backgroundColor: backgroundColor, //yellow
                borderColor    : backgroundColor, //yellow
              });
            }
            else if(patients_appoint[i]['status'] == "Extend")
            {
              backgroundColor = "#851608";
              jsonArrExtend.push({
                title          : patients_appoint[i]['patient_name'],
                start          : patients_appoint[i]['appointment_date'],
                end          : patients_appoint[i]['appointment_date'],
                backgroundColor: backgroundColor, //yellow
                borderColor    : backgroundColor, //yellow
              });
            }
            else if(patients_appoint[i]['status'] == "Done")
            {
              backgroundColor = "#298200";
              jsonArrDone.push({
                title          : patients_appoint[i]['patient_name'],
                start          : patients_appoint[i]['appointment_date'],
                end          : patients_appoint[i]['appointment_date'],
                backgroundColor: backgroundColor, //yellow
                borderColor    : backgroundColor, //yellow
              });
            }
            else if(patients_appoint[i]['status'] != null)
            {
              backgroundColor = "#4846c7";
              jsonArrReject.push({
                title          : patients_appoint[i]['patient_name'],
                start          : patients_appoint[i]['appointment_date'],
                end          : patients_appoint[i]['appointment_date'],
                backgroundColor: backgroundColor, //yellow
                borderColor    : backgroundColor, //yellow
              });
            }
            
        }
        $("#status_drop").on("change", function() {
          filterDataCalender(patients_appoint);
        });
        $('#patients').on("change", function() {
          filterDataCalender(patients_appoint);
        });
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#calendar').fullCalendar('renderEvents', jsonArrPending, true);    
    $('#patients').append(output);
    $('.select2').select2();
  }
  function filterDataCalender(patients_appoint)
  {
    var jsonArr = [];
    if($("#status_drop").val() != "" && $("#patients").val() != "")
    {
      var tupleFound = false;
      for (i = 0; i < patients_appoint.length; i++) {
        if(patients_appoint[i]['patient_id'] == $("#patients").val()
           && patients_appoint[i]['status'] == $("#status_drop").val())
        {
          jsonArr = [];
          backgroundColor = "#4846c7";
          if(patients_appoint[i]['status'] == "Pending")
          {
            backgroundColor = "#f7bd1b";
          }
          else if(patients_appoint[i]['status'] == "Extend")
          {
            backgroundColor = "#851608";
          }
          else if(patients_appoint[i]['status'] == "Done")
          {
            backgroundColor = "#298200";
          }
          jsonArr.push({
            title          : patients_appoint[i]['patient_name'],
            start          : patients_appoint[i]['appointment_date'],
            end          : patients_appoint[i]['appointment_date'],
            backgroundColor: backgroundColor, //yellow
            borderColor    : backgroundColor, //yellow
          });
          renderNewCalender();
          $('#calendar').fullCalendar('renderEvents', jsonArr, true);
          tupleFound = true;
          break;
        }
      }
      if(!tupleFound)
      {
        renderNewCalender();
        $('#calendar').fullCalendar('renderEvents', jsonArr, true);
      }
    }
    else if($("#status_drop").val() != "" )
    {
      if($("#status_drop").val() == "Pending")
      {
        renderNewCalender();
        $('#calendar').fullCalendar('renderEvents', jsonArrPending, true);
      }
      else if($("#status_drop").val() == "Done")
      {
        renderNewCalender();
        $('#calendar').fullCalendar('renderEvents', jsonArrDone, true);
      }
      else if($("#status_drop").val() == "Extend")
      {
        renderNewCalender();
        $('#calendar').fullCalendar('renderEvents', jsonArrExtend, true);
      }
      else if($("#status_drop").val() == "Reject")
      {
        renderNewCalender();
        $('#calendar').fullCalendar('renderEvents', jsonArrReject, true);
      }
    }
    else if($("#patients").val() != "" )
    {
      for (i = 0; i < patients_appoint.length; i++) {
        if(patients_appoint[i]['patient_id'] == $("#patients").val())
        {
          jsonArr = [];
          backgroundColor = "#4846c7";
          if(patients_appoint[i]['status'] == "Pending")
          {
            backgroundColor = "#f7bd1b";
          }
          else if(patients_appoint[i]['status'] == "Extend")
          {
            backgroundColor = "#851608";
          }
          else if(patients_appoint[i]['status'] == "Done")
          {
            backgroundColor = "#298200";
          }
          jsonArr.push({
            title          : patients_appoint[i]['patient_name'],
            start          : patients_appoint[i]['appointment_date'],
            end          : patients_appoint[i]['appointment_date'],
            backgroundColor: backgroundColor, //yellow
            borderColor    : backgroundColor, //yellow
          });
          renderNewCalender();
          $('#calendar').fullCalendar('renderEvents', jsonArr, true);
          break;
        }
      }
    }

  }
  })
</script>
@endsection