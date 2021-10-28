@extends('layouts.default')

@push('styles')
<link href="{{ asset('backend/plugins/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
@endpush
@section('content')
<section>
	<nav class="navbar navbar-expand-lg py-3" style="background-color: #d5ebed">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/" class="text-primary">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Facilities</a></li>
				</ol>
				<h4>Facilities</h4>
			</nav>
		</div>
	</nav>
</section>
<section class="mt-3">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="scheduler"></div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/moment/moment.js') }}"></script>
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
<script type="text/javascript">
	$(function () {
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
				// 	printButton.jqxButton({ disabled: true });
				// }
				// else if (editAppointment && printButton) {
				// 	printButton.jqxButton({ disabled: false });
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