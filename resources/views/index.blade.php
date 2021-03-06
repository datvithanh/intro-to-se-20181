@extends('layouts.master')

@section('content')
<div class="background-image"></div>
<div class="page">
    <div class="card card-raised card-form-horizontal no-transition">
        <div class="card-block">
            <form method="" action="" style="display: flex">
                <!-- <button class="btn btn-default" id="search-button"> Submit </button> -->
                <input style="padding:10px;flex:2" placeholder="Chọn ngày" type="text" id="input-id" value="">
                <!-- <input style="padding:10px;flex:2" class="mx-1" placeholder="Địa điểm" type="text" id="" value=""> -->
                <select style="padding:10px;flex:2" class="mx-1" id="location-id">
                    <option value="0">Tất cả</option>
                    <option value="1">Hà Nội</option>
                    <option value="2">TPHCM</option>
                    <option value="3">Hải Phòng</option>
                    <option value="4">Đà Nẵng</option>
                    <option value="5">Cần thơ</option>
                </select>
                <button style="flex:1" id="search-button" type="button" class="btn btn-success btn-block">
                    <i class="nc-icon nc-zoom-split"></i>&nbsp;Search
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    var input = document.getElementById('input-id');
    var datepicker = new HotelDatepicker(input, {
        format: 'YYYY-MM-DD'
    });
	
    $('#search-button').click(function(){
        let date = $("#input-id").val();
        if(date == ""){
            toastr.error("Please pick the date");
            return;
        }
        window.location = "/search?start=" + date.substr(0,10) + "&end=" + date.substr(13,21) + "&location=" + $("#location-id").val();
	});
</script>
@endpush