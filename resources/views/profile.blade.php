@extends('layouts.master')

@section('content')
<div class="background-image"></div>

<div class="container" style="margin-top: 85px">
    <div class="content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form>
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom:30px">
                                        <h5>Người dùng: {{$user->name}}</h5>
                                        <h5>Email: {{$user->email}}</h5>
                                        <hr>
                                        <h5>Danh sách đặt phòng:</h5>
                                        <hr style="width: 30%">
                                        <div class="col-md-12">
                                        @foreach($bookings as $booking) 
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="{{$booking['image_url']}}" style="width: 100px; border-radius:5%"/>
                                            </div>
                                            <div class="col-md-3">
                                                <span>
                                                    <h5>{{$booking['hotel_name']}}</h5>
                                                </span>
                                            </div>
                                            <div class="col-md-3">
                                                <span>
                                                    <h6>{{$booking['room_name']}}</h6>
                                                </span>
                                            </div>
                                            <div class="col-md-3">
                                                <span>
                                                    <h6>{{$booking['start']}}</h6>
                                                    <h6>{{$booking['finish']}}</h6>
                                                </span>
                                            </div>
                                        </div>
                                        <hr style="width: 30%">
                                        @endforeach
                                        </div>
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
@endsection 
 

@push('scripts')
@endpush