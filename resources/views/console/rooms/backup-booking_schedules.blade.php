@extends('console.layouts.master')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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
            <li class=""><a href="#kalender_tab" data-toggle="tab" aria-expanded="false">Kalender</a></li>
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
            <div class="tab-pane" id="kalender_tab">
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

    function getWidth(){return '100%';}



    var appointments = new Array();

    var appointment1 = {
      id: "id1",
      description: "George brings projector for presentations.",
      location: "",
      subject: "Fashion Expo",
      calendar: "East Coast Events",
      start: new Date(2017, 10, 15, 9, 0, 0),
      end: new Date(2017, 10, 18, 16, 0, 0)
    }

    var appointment2 = {
      id: "id2",
      description: "",
      location: "",
      subject: "Cloud Data Expo",
      calendar: "Middle West Events",
      start: new Date(2017, 10, 20, 10, 0, 0),
      end: new Date(2017, 10, 22, 15, 0, 0)
    }

    var appointment3 = {
      id: "id3",
      description: "",
      location: "",
      subject: "Digital Media Conference",
      calendar: "West Coast Events",
      start: new Date(2017, 10, 23, 11, 0, 0),
      end: new Date(2017, 10, 28, 13, 0, 0)
    }

    var appointment4 = {
      id: "id4",
      description: "",
      location: "",
      subject: "Modern Software Development Conference",
      calendar: "West Coast Events",
      start: new Date(2017, 10, 10, 16, 0, 0),
      end: new Date(2017, 10, 12, 18, 0, 0)
    }

    var appointment5 = {
      id: "id5",
      description: "",
      location: "",
      subject: "Marketing Future Expo",
      calendar: "Middle West Events",
      start: new Date(2017, 10, 5, 15, 0, 0),
      end: new Date(2017, 10, 6, 17, 0, 0)
    }

    var appointment6 = {
      id: "id6",
      description: "",
      location: "",
      subject: "Future Computing",
      calendar: "East Coast Events",
      start: new Date(2017, 10, 13, 14, 0, 0),
      end: new Date(2017, 10, 20, 16, 0, 0)
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
      date: new $.jqx.date(),
      width: getWidth(),
      height: 600,
      source: adapter,
      showLegend: true,
      // called when the dialog is craeted.
      editDialogCreate: function (dialog, fields, editAppointment) {
        alert('editDialogCreateeditDialogCreate');
        myfield = $(`<div><div class="jqx-scheduler-edit-dialog-label">NIKKO</div><div class="jqx-scheduler-edit-dialog-field"><input type="text" role="textbox" aria-autocomplete="both" aria-disabled="false" aria-readonly="false" aria-multiline="false" class="jqx-widget-content jqx-input-widget jqx-input jqx-widget jqx-rc-all" placeholder="" style="width: 100%; height: 25px; box-sizing: border-box;" data-value="" data-label="" hint="true"></div></div>`);
        $(dialog).find('#dialogscheduler').append(myfield);

        
      },
      // *
      // * called when the dialog is opened. Returning true as a result disables the built-in handler.
      // * @param {Object} dialog - jqxWindow's jQuery object.
      // * @param {Object} fields - Object with all widgets inside the dialog.
      // * @param {Object} the selected appointment instance or NULL when the dialog is opened from cells selection.

      editDialogOpen: function (dialog, fields, editAppointment) {
        alert('editDialogOpen');
        // if (!editAppointment && printButton) {
        //  printButton.jqxButton({ disabled: true });
        // }
        // else if (editAppointment && printButton) {
        //  printButton.jqxButton({ disabled: false });
        // }
      },
      // *
      // * called when the dialog is closed.
      // * @param {Object} dialog - jqxWindow's jQuery object.
      // * @param {Object} fields - Object with all widgets inside the dialog.
      // * @param {Object} the selected appointment instance or NULL when the dialog is opened from cells selection.

      editDialogClose: function (dialog, fields, editAppointment) {
        alert('editDialogClose');
      },
      // *
      // * called when a key is pressed while the dialog is on focus. Returning true or false as a result disables the built-in keyDown handler.
      // * @param {Object} dialog - jqxWindow's jQuery object.
      // * @param {Object} fields - Object with all widgets inside the dialog.
      // * @param {Object} the selected appointment instance or NULL when the dialog is opened from cells selection.
      // * @param {jQuery.Event Object} the keyDown event.

      editDialogKeyDown: function (dialog, fields, editAppointment, event) {
        // alert('editDialogKeyDown');

      },
      resources:
      {
        colorScheme: "scheme01",
        dataField: "calendar",
        source: new $.jqx.dataAdapter(source)
      },
      appointmentDataFields:
      {
        from: "start",
        to: "end",
        id: "id",
        description: "description",
        location: "place",
        subject: "subject",
        resourceId: "calendar"
      },
      view: "monthView",
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