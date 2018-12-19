@extends('layouts.master')

@section('content')
<div class="background-image"></div>
<div class="container" style="margin-top: 85px">
    <div class="card card-raised card-form-horizontal no-transition mb-2">
        <div class="card-block">
            <div class="row">
                <div class="col-md-3">
                    <h4>
                        Search for hotel name:
                    </h4>
                </div>
                <div class="col-md-3">
                    <h4>
                        Sort:
                    </h4>
                </div>
                <div class="col-md-3">
                    <h4>
                        Location:
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input class="form-control" placeholder="Tên khách sạn" type="text" id="filter-search" value="{{$search}}">
                </div>
                <div class="col-md-3">
                    <select class="mx-1 form-control" id="filter-sort">
                        @if($sort == 0)
                        <option value="0" selected>Không</option>
                        @else                        
                        <option value="0">Không</option>
                        @endif
                        @if($sort == 1)
                        <option value="1" selected>Giá giảm</option>
                        @else                        
                        <option value="1">Giá giảm</option>
                        @endif
                        @if($sort == 2)
                        <option value="2" selected>Giá tăng</option>
                        @else                        
                        <option value="2">Giá tăng</option>
                        @endif
                        @if($sort == 3)
                        <option value="3" selected>Rate giảm</option>
                        @else                        
                        <option value="3">Rate giảm</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="mx-1 form-control" id="filter-location" value="{{$location}}">
                        @if($location == 0)
                        <option value="0" selected>Tất cả</option>
                        @else
                        <option value="0">Tất cả</option>
                        @endif
                        @if($location == 1)
                        <option value="1" selected>Hà Nội</option>
                        @else
                        <option value="1">Hà Nội</option>
                        @endif
                        @if($location == 2)
                        <option value="2" selected>TPHCM</option>
                        @else
                        <option value="2">TPHCM</option>
                        @endif
                        @if($location == 3)
                        <option value="3" selected>Hải Phòng</option>
                        @else
                        <option value="3">Hải Phòng</option>
                        @endif
                        @if($location == 4)
                        <option value="4" selected>Đà Nẵng</option>
                        @else
                        <option value="4">Đà Nẵng</option>
                        @endif
                        @if($location == 5)
                        <option value="5" selected>Cần thơ</option>
                        @else
                        <option value="5">Cần thơ</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success" id="filter-btn">
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
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
                                <h6 class="title" style="color: #333333">
                                    <p>Name: {{$hotel['name']}}</p>
                                    <p>Address: {{$hotel['address']}} </p>
                                    <p>Price range: {{$hotel['price_min']}} - {{$hotel['price_max']}}</p>
                                    <p>Total rooms: {{$hotel['total']}}</p>

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
                                </h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="title" style="color: #333333">
                                    <p>
                                        Services:
                                    </p>
                                @foreach($hotel['services'] as $service)
                                    <p>
                                        &bull; {{$service['name']}}
                                    </p>
                                @endforeach
                                </h6>
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

    $('#filter-btn').click(function(){
        let search = $('#filter-search').val();
        let location = $('#filter-location').val();
        let sort = $('#filter-sort').val();
        window.location = '/search' + "?start=" + "{{$start}}" + "&end=" + "{{$end}}" + "&search=" + search + "&location=" +location + "&sort=" +sort;
    })

</script>
@endpush