@extends('dashboard.layouts.default')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('contentdashboard')
<div class="d-flex justify-content-between align-items-center">
	<h5>Pencarian Disimpan</h5>
</div>
<hr class="my-2">
@if (session('notification')) {!! session('notification') !!} @endif
<div class="d-grid gap-3" id="container-items"><center><img src="<?php echo asset('assets/img/loading.gif') ?>" class="img-responsive"></center></div>
@endsection
@push('scripts')
<script>
	$(document).ready(function($) {
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		setTimeout(function(){
			$.post('<?php echo url('dashboard/search-saved') ?>', {}, function(html){
				$('#container-items').html(html);
			})
		}, 1000)
	});
</script>
@endpush