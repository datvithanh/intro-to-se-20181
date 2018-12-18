@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Khách sạn: {{$hotel['name']}}</h2>
                            <h2>Địa chỉ: {{$hotel['address']}}</h2>
                            <h2>Mô tả: {{$hotel['description']}}</h2>
                            <hr width="50%">
                            <h2>Hình ảnh</h2>
                            <div style="display:flex; flex-wrap:wrap;">
                            @foreach($hotel['images'] as $image) 
                                <div style="width: 25%">
                                    <img src="{{$image->url}}" style="width: 250px; height: auto">
                                </div>
                            @endforeach
                            </div>
                            <hr width="50%">

                        </div>
                        

                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Danh sách phòng</h2></div>
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
                                <th> Tên </th>
                                <th> Giá</th>
                                <th> Số lượng</th>
                                <th> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <th><img src="{{$room['avatar']}}" style="width:100px; height:auto"></th>
                                <th>{{$room['name']}}</th>
                                <th>{{$room['price']}}</th>
                                <th>{{$room['total']}}</th>
                                <td width="15%">
                                        <a href="/room/{{$room['id']}}/edit" class="edit" title="Sửa" data-toggle="tooltip"><i class="material-icons" style="color:#FFC107">&#xE254;</i></a>
                                        &nbsp;
                                        <!-- <a class="delete" href="javascript:deleteRoom({{$room['id']}})" title="Xoá" data-toggle="tooltip"><i class="material-icons" style="color:#E34724">&#xE872;</i></a> -->
                                </td>
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
            window.location = '/hotel/{{$hotel["id"]}}';
        }).catch(function(){

        });
    }
</script>
@endpush
