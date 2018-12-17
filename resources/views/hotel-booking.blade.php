@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12"><h2>Khách sạn: {{$hotel->name}}</h2></div>
                        
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Danh sách đặt phòng</h2></div>
                        <div class="col-md-4">
                            <a class="btn btn-success" href='/room/create?hotel_id={{$hotel["id"]}}' style="float:right;">+ Tạo phòng</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Tên người đặt</th>
                                <th> Loại phòng</th>
                                <th> Giá</th>
                                <th> Ngày checkin</th>
                                <th> Ngày checkout</th>
                                <th> Ngày đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <th>{{$booking['id']}}</th>
                                <th>{{$booking['user_name']}}</th>
                                <th>{{$booking['room_name']}}</th>
                                <th>{{$booking['price']}}</th>
                                <th>{{$booking['start']}}</th>
                                <th>{{$booking['finish']}}</th>
                                <th>{{$booking['created_at']}}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
@endsection
@push('scripts')
<script>
    function deleteRoom(roomId){
        axios.delete('/api/room/'+roomId).then(function(){
            toastr.success('Xoá phòng thành công');
            window.location = '/hotel/';
        }).catch(function(){

        });
    }
</script>
@endpush
