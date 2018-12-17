@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Danh sách khách sạn</h2></div>
                        <div class="col-md-4">
                            <a class="btn btn-success" href='/hotel/create' style="float:right;">+ Tạo khách sạn</a>
                            <!-- <button class="btn btn-success" onClick="openHotelModal();" style="float:right;">+ Tạo khách sạn</button> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Tên </th>
                                <th> Địa chỉ</th>
                                <th> Mô tả</th>
                                <th width="15%"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td> {{$hotel['id']}}</td>
                                    <td> {{$hotel['name']}} </td>
                                    <td> {{$hotel['address']}} </td>
                                    <td> {{$hotel['description']}}</td>
                                    <td width="15%">
                                        <a href="/hotel/{{$hotel['id']}}" class="add" title="Thông tin chi tiết" data-toggle="tooltip"><i class="material-icons">&#xe3c8;</i></a>
                                        &nbsp;
                                        <a href="/hotel/{{$hotel['id']}}/booking" class="format_list_bulleted" title="Danh sách đặt phòng" data-toggle="tooltip"><i class="material-icons">&#xe241;</i></a>
                                        &nbsp;
                                        <a href="/hotel/{{$hotel['id']}}/edit" class="edit" title="Sửa" data-toggle="tooltip"><i class="material-icons" style="color:#FFC107">&#xE254;</i></a>
                                        &nbsp;
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
@endsection
