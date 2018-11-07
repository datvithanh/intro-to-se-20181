@extends('layouts.master')

@section('content')
<div class="page-header" data-parallax="true" style="background-image: url('/assets/img/uriel-soberanes.jpg')">
    <div class="page">
		<input style="padding:10px; width: 30%" placeholder="Chọn ngày" type="text" id="input-id" value="">
		<input style="padding:10px; width: 30%" placeholder="Địa điểm" type="text" id="" value="">
		<button class="btn btn-default" id="search-button"> Submit </button>
    </div>
</div>
@push('scripts')
<script>
    var input = document.getElementById('input-id');
    var datepicker = new HotelDatepicker(input, {
        format: 'DD-MM-YYYY'
    });
	$('#search-button').click(function(){
		console.log($('#input-id').val());
	})
</script>
@endpush
@endsection
