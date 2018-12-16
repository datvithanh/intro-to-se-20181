@extends('layouts.master')

@section('content')
<div class="page-header" data-parallax="true" style="background-image: url('/assets/img/uriel-soberanes.jpg')">
    <div class="page">
		
    <div class="content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form method="" action="">
                                <div class="row">
                                    <!-- <button class="btn btn-default" id="search-button"> Submit </button> -->
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input style="padding:10px; width: 250px" placeholder="Chọn ngày" type="text" id="input-id" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input style="padding:10px; width: 250px" placeholder="Địa điểm" type="text" id="" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="search-button" type="button" class="btn btn-danger btn-block"><i class="nc-icon nc-zoom-split"></i>
                                            &nbsp; Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    var input = document.getElementById('input-id');
    var datepicker = new HotelDatepicker(input, {
        format: 'DD-MM-YYYY'
    });
	
    $('#search-button').click(function(){
        let date = $("#input-id").val();
        if(date == ""){
            toastr.error("Please pick the date");
            return;
        }
        window.location = "/search?date=" + date;
	});
</script>
@endpush
@endsection
