@extends('dashboard.layouts.default')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	.select2-container {
		margin-bottom: 5px;
	}
</style>
@endpush
@section('contentdashboard')
<div class="d-flex justify-content-between align-items-center">
	<h5>Barang Hilang Anda</h5>
	<a href="{{ url('dashboard/lost-item/create') }}"class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Buat Kehilangan</a>
</div>
<hr class="my-2">
@if (session('notification')) {!! session('notification') !!} @endif
<div class="d-flex flex-row-reverse mb-1">
	<select id="select-sort-by" class="form-select" style="max-width: 230px;">
		<option value="">- Urutkan Berdasarkan -</option>
		<option value="desc">Terbaru</option>
		<option value="asc">Terlama</option>
	</select>
</div>
<div class="d-grid gap-3" id="container-items"><center><img src="<?php echo asset('assets/img/loading.gif') ?>" class="img-responsive"></center></div>
<br>
<center><button id="btn-load-more" class="btn btn-primary text-white">Muat Lainnya</button></center>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		var sortSearch = [];
		var initialLimitItem = 2;
		var initialOffsetItem = 0;
		var incrementLoadMore = 2;

		var firstSearchData = {'search_type': 'lost_date', 'keyword': $("#filter-search input[name=name]").val(), 'date': $("#filter-search input[name=date]").val(), 'province_id': $('#select-province').val(), 'regency_id': $('#select-regency').val(), 'district_id': $('#select-district').val(), 'village_id': $('#select-village').val()};
		
		function filterSearch(data, offset, limit, append = false) {
			$.post('<?php echo url('dashboard/ajax_search_my_items') ?>/' + offset +'/'+ limit, data, function(res){
				if (res.success) {
					append ? $('#container-items').append(res.html) : $('#container-items').html(res.html);
				} else {
					alert('error fetch items');
				}
			});
		}
		console.log(firstSearchData);
		filterSearch(firstSearchData, initialOffsetItem, initialLimitItem);

		$("#filter-search").on("submit", function(e){
			$('#container-items').html(`<center><img src="<?php echo asset('assets/img/loading.gif') ?>" class="img-responsive"></center>`);
			e.preventDefault();
			sortSearch = $("#filter-search").serializeArray();
			sortSearch.push({name: 'sort_by', value: $('#select-sort-by').val()});
			sortSearch.push({name: 'search_type', value: 'lost_date'});
			filterSearch(sortSearch, initialOffsetItem, initialLimitItem);
			incrementLoadMore = 2;
		});

		$("#select-sort-by").on("change", function(){
			$('#container-items').html(`<center><img src="<?php echo asset('assets/img/loading.gif') ?>" class="img-responsive"></center>`);
			sortSearch = $("#filter-search").serializeArray();
			sortSearch.push({name: 'sort_by', value: $(this).val()});
			sortSearch.push({name: 'search_type', value: 'lost_date'});
			filterSearch(sortSearch, initialOffsetItem, initialLimitItem);
			incrementLoadMore = 2;
		});

		$("#btn-load-more").on("click", function(){
			sortSearch = $("#filter-search").serializeArray();
			sortSearch.push({name: 'sort_by', value: $('#select-sort-by').val()});
			sortSearch.push({name: 'search_type', value: 'lost_date'});
			filterSearch(sortSearch, incrementLoadMore, initialLimitItem, true);
			incrementLoadMore = incrementLoadMore + 2;
		});
	});
</script>
@endpush