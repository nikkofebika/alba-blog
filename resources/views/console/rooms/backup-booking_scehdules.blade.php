@extends('console.layouts.master')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/plugins/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{$page_title}}</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-users"></i> {{ $page_title }}</a></li>
			<li class="active">All</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#table_tab" data-toggle="tab" aria-expanded="true">Tabel</a></li>
						<li class=""><a href="#calendar_tab" data-toggle="tab" aria-expanded="false">Kalender</a></li>
						<li class=""><a href="#jqwidget_tab" data-toggle="tab" aria-expanded="false">Jq Widget</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="table_tab">
							<?php if(session('notification')){echo session('notification');} ?>
							<div class="text-right">
								<a href="{{ url('console/rooms/create_booking_schedules') }}" title="Tambah Data" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
							</div>
							<div class="table-responsive mt-4">
								<table id="datatable" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Ruangan</th>
											<th>User</th>
											<th>Mulai</th>
											<th>Selesai</th>
											<th>Dibuat Oleh</th>
											<th></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="calendar_tab">
							<div class="row">
								<div class="col-md-3">
									<div class="box box-solid">
										<div class="box-header with-border">
											<h4 class="box-title">Draggable Events</h4>
										</div>
										<div class="box-body">
											<!-- the events -->
											<div id="external-events">
												<div class="external-event bg-green">Lunch</div>
												<div class="external-event bg-yellow">Go home</div>
												<div class="external-event bg-aqua">Do homework</div>
												<div class="external-event bg-light-blue">Work on UI design</div>
												<div class="external-event bg-red">Sleep tight</div>
												<div class="checkbox">
													<label for="drop-remove">
														<input type="checkbox" id="drop-remove">
														remove after drop
													</label>
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</div>
									<!-- /. box -->
									<div class="box box-solid">
										<div class="box-header with-border">
											<h3 class="box-title">Create Event</h3>
										</div>
										<div class="box-body">
											<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
												<!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
												<ul class="fc-color-picker" id="color-chooser">
													<li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
													<li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
												</ul>
											</div>
											<!-- /btn-group -->
											<div class="input-group">
												<input id="new-event" type="text" class="form-control" placeholder="Event Title">

												<div class="input-group-btn">
													<button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
												</div>
												<!-- /btn-group -->
											</div>
											<!-- /input-group -->
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<div class="box box-primary">
										<div class="box-body no-padding">
											<!-- THE CALENDAR -->
											<div id="calendar"></div>
										</div>
										<!-- /.box-body -->
									</div>
									<!-- /. box -->
								</div>
							</div>
						</div>

						<div class="tab-pane" id="jqwidget_tab">
							<div id="scheduler"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxcore.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxbuttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxscrollbar.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxdata.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxdate.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxscheduler.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxscheduler.api.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxdatetimeinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxcalendar.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxtooltip.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxwindow.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxcheckbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxlistbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxdropdownlist.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxnumberinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxradiobutton.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/jqxinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/globalization/globalize.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jqwidgets/globalization/globalize.culture.de-DE.js') }}"></script>

<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('console.rooms.booking_schedule_list') }}",
			columns: [
			{data: 'id', sortable: 'false',
			render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{data: 'room_id', name: 'room_id'},
			{data: 'user_id', name: 'user_id'},
			{data: 'start', name: 'start'},
			{data: 'end', name: 'end'},
			{data: 'created_by', name: 'created_by'},
			{
				data: 'action', 
				name: 'action',
				orderable: false, 
				searchable: false
			},
			]
		});

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
    y    = date.getFullYear()
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
      	title          : 'All Day Event',
      	start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
      },
      {
      	title          : 'Long Event',
      	start          : new Date(y, m, d - 5),
      	end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
      },
      {
      	title          : 'Meeting',
      	start          : new Date(y, m, d, 10, 30),
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
      },
      {
      	title          : 'Lunch',
      	start          : new Date(y, m, d, 12, 0),
      	end            : new Date(y, m, d, 14, 0),
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
      },
      {
      	title          : 'Birthday Party',
      	start          : new Date(y, m, d + 1, 19, 0),
      	end            : new Date(y, m, d + 1, 22, 30),
      	allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
      },
      {
      	title          : 'Click for Google',
      	start          : new Date(y, m, 28),
      	end            : new Date(y, m, 29),
      	url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
      }
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


    function getWidth(name) {
    	InitResponse();
    	var response = new $.jqx.response();

    	// name = name.toLowerCase();
    	if (response.device.type === "Phone") {
            var scheduler = document.getElementById('scheduler');
            if (scheduler) {
                scheduler.style.marginLeft = '5%';
            }
            return '90%'
        }
        else if (response.device.type === "Tablet") {
            var windowWidth = document.body.offsetWidth - 50;
            if (windowWidth > 850) {
                windowWidth = 850;
            }
            var scheduler = document.getElementById('scheduler');
            if (scheduler) {
                scheduler.style.marginLeft = 'auto';
                scheduler.style.marginRight = 'auto';
            }

            return windowWidth;
        }
        return 850;	
    }

    var appointments = new Array();

    var appointment1 = {
    	id: "id1",
    	description: "George brings projector for presentations.",
    	location: "",
    	subject: "Quarterly Project Review Meeting",
    	calendar: "Room 1",
    	start: new Date(2017, 10, 23, 9, 0, 0),
    	end: new Date(2017, 10, 23, 16, 0, 0)
    }

    var appointment2 = {
    	id: "id2",
    	description: "",
    	location: "",
    	subject: "IT Group Mtg.",
    	calendar: "Room 2",
    	start: new Date(2017, 10, 24, 10, 0, 0),
    	end: new Date(2017, 10, 24, 15, 0, 0)
    }

    var appointment3 = {
    	id: "id3",
    	description: "",
    	location: "",
    	subject: "Course Social Media",
    	calendar: "Room 3",
    	start: new Date(2017, 10, 27, 11, 0, 0),
    	end: new Date(2017, 10, 27, 13, 0, 0)
    }

    var appointment4 = {
    	id: "id4",
    	description: "",
    	location: "",
    	subject: "New Projects Planning",
    	calendar: "Room 2",
    	start: new Date(2017, 10, 23, 16, 0, 0),
    	end: new Date(2017, 10, 23, 18, 0, 0)
    }

    var appointment5 = {
    	id: "id5",
    	description: "",
    	location: "",
    	subject: "Interview with James",
    	calendar: "Room 1",
    	start: new Date(2017, 10, 25, 15, 0, 0),
    	end: new Date(2017, 10, 25, 17, 0, 0)
    }

    var appointment6 = {
    	id: "id6",
    	description: "",
    	location: "",
    	subject: "Interview with Nancy",
    	calendar: "Room 4",
    	start: new Date(2017, 10, 26, 14, 0, 0),
    	end: new Date(2017, 10, 26, 16, 0, 0)
    }
    appointments.push(appointment1);
    appointments.push(appointment2);
    appointments.push(appointment3);
    appointments.push(appointment4);
    appointments.push(appointment5);
    appointments.push(appointment6);

            // prepare the data
            var source =
            {
            	dataType: "array",
            	dataFields: [
            	{ name: 'id', type: 'string' },
            	{ name: 'description', type: 'string' },
            	{ name: 'location', type: 'string' },
            	{ name: 'subject', type: 'string' },
            	{ name: 'calendar', type: 'string' },
            	{ name: 'start', type: 'date' },
            	{ name: 'end', type: 'date' }
            	],
            	id: 'id',
            	localData: appointments
            };
            var adapter = new $.jqx.dataAdapter(source);
            $("#scheduler").jqxScheduler({
            	date: new $.jqx.date(2017, 11, 23),
            	width: 850,
            	height: 600,
            	source: adapter,
            	view: 'weekView',
            	showLegend: true,
            	ready: function () {
            		$("#scheduler").jqxScheduler('ensureAppointmentVisible', 'id1');
            	},
            	resources:
            	{
            		colorScheme: "scheme05",
            		dataField: "calendar",
            		source:  new $.jqx.dataAdapter(source)
            	},
            	appointmentDataFields:
            	{
            		from: "start",
            		to: "end",
            		id: "id",
            		description: "description",
            		location: "location",
            		subject: "subject",
            		resourceId: "calendar"
            	},
            	views:
            	[
            	'dayView',
            	'weekView',
            	'monthView'
            	]
            });
        });
    </script>
    @endpush