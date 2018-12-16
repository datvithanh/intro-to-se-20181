@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12"><h2>Khách sạn: {{$hotel['name']}}</h2></div>
                        
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
                                <th> Mô tả</th>
                                <th> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <th>{{$room['id']}}</th>
                                <th>{{$room['name']}}</th>
                                <th>{{$room['price']}}</th>
                                <th>{{$room['total']}}</th>
                                <td width="15%">
                                        <a href="/room/{{$room['id']}}/edit" class="edit" title="Sửa" data-toggle="tooltip"><i class="material-icons" style="color:#FFC107">&#xE254;</i></a>
                                        &nbsp;
                                        <a class="delete" href="javascript:deleteRoom({{$room['id']}})" title="Xoá" data-toggle="tooltip"><i class="material-icons" style="color:#E34724">&#xE872;</i></a>
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
