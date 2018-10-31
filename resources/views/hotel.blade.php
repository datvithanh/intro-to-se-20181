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
                            <button class="btn btn-success" onClick="openHotelModal();" style="float:right;">+ Tạo phòng</button>
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
                                        <a href="/hotel/{{$hotel['id']}}" class="add" title="Thông tin chi tiết" data-toggle="tooltip"><i class="material-icons">&#xe3c8;</i></a>
                                        &nbsp;
                                        <a class="format_list_bulleted" title="Danh sách đặt phòng" data-toggle="tooltip"><i class="material-icons">&#xe241;</i></a>
                                        &nbsp;
                                        <a class="edit" title="Sửa" data-toggle="tooltip"><i class="material-icons" style="color:#FFC107">&#xE254;</i></a>
                                        &nbsp;
                                        <a class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons" style="color:#E34724">&#xE872;</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
<div id="room-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="padding-bottom: 0px">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 10px 20px">
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" id="room-name" type="text"
                            placeholder="Tên" />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" type="text" id="room-price"
                            placeholder="Giá/đêm" />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" type="text" id="room-description"
                            placeholder="Mô tả" />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" type="text" id="room-total"
                            placeholder="Số phòng" />
                    </div>
                    <div id="alert-modal" style="font-size: 14px"></div>
                    <button class="btn btn-success" style="width: 100%; margin: 10px; padding: 15px;" id="submit-modal">Đăng
                        kí
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('.multipleSelect').fastselect();
    function openHotelModal() {
            $('#room-modal').modal('show');
            $("#submit-modal").css("display", "");
            $("#alert-modal").html(
                ""
            );
        }

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function validateNumber(number) {
            var re = /^[0-9]+$/;
            return re.test(String(number));
        }

        $(document).ready(function () {
            $("#submit-modal").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                var name = $('#room-name').val();
                var price = $('#room-price').val();
                var description = $('#room-description').val();
                var total = $('#room-total').val();
                console.log(name + price+description+total);
                var ok = 0;
                if (name.trim() == "" || price.trim() == "" || description.trim() == "" || total.trim() == "") ok = 1;

                if (!name || !price || !description || !total || ok == 1) {
                    $("#alert-modal").html(
                        "<div class='alert alert-danger'>Vui lòng nhập đủ thông tin</div>"
                    );
                    return;
                }
                var message = "Tạo phòng thành công";
                $("#alert-modal").html("<div class='alert alert-success'>" + message + "</div>");
                $("#submit-modal").css("display", "none");

                var url = "";
                var data = {
                    name: name,
                    price: price,
                    description: description,
                    total: total,
                    _token: "{{csrf_token()}}"
                };
                axios.post("/api/hotel/{{$hotel['id']}}/room", data)
                    .then(function () {
                        // window.location = "/home";
                    }.bind(this))
                    .catch(function () {
                    }.bind(this));
            });
        });
</script>
@endpush
