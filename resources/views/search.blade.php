@extends('layouts.master')

@section('content')
<div class="background-image"></div>
<div class="container" style="margin-top: 85px">
    <div class="row">
        <div class="col-md-12">
            @foreach($hotels as $hotel)
            <div class="card card-raised card-form-horizontal no-transition mb-2">
                <div class="card-block">
                    <form method="" action="">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{$hotel['avatar']}}">
                            </div>
                            <div class="col-md-3">
                                <h5 class="title" style="color: #333333">
                                    <p>Name: {{$hotel['name']}}. </p>
                                    <p>Price range: {{$hotel['price_min']}} - {{$hotel['price_max']}}.</p>
                                    <p>Total: {{$hotel['total']}}.</p>
                                    <span class="rating-content" title="{{$hotel['stars']}}">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span style="width: {{$hotel['stars']/5*100}}%;">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </span>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="title" style="color: #333333">
                                    <p>
                                        Services:
                                    </p>
                                @foreach($hotel['services'] as $service)
                                    <p>
                                        &bull; {{$service['name']}}
                                    </p>
                                @endforeach
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="hotelRoom({{$hotel['id']}})" class="btn btn-danger btn-block">
                                    <i class="nc-icon nc-zoom-split"></i>
                                    &nbsp; Xem phòng
                                </button></div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function hotelRoom(hotelId) {
        window.location = '/hotel/' + hotelId + "?start=" + "{{$start}}" + "&end=" + "{{$end}}";
    }
</script>
@endpush