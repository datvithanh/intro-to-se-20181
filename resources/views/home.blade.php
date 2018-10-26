@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Danh sách khách sạn</h2></div>
                        <div class="col-md-4">
                            <button class="btn btn-success" onClick="openHotelModal();" style="float:right;">asd</button>
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
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td> {{$hotel['id']}}</td>
                                    <td> {{$hotel['name']}} </td>
                                    <td> {{$hotel['address']}} </td>
                                    <td> {{$hotel['description']}}</td>
                                    <td>
                                        <a href="/hotel" class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons" style="color:#FFC107">&#xE254;</i></a>
                                        <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons" style="color:#E34724">&#xE872;</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
<div id="hotel-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body" style="padding-bottom: 0px">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 10px 20px">
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" id="hotel-name" type="text"
                            placeholder="Tên" />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" type="text" id="hotel-address"
                            placeholder="Địa chỉ" />
                    </div>
                    <div class="form-group" style="width: 100%;">
                        <input class="form-control" style="height: 50px" width="100%" type="text" id="hotel-description"
                            placeholder="Mô tả" />
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

    function openHotelModal() {
            $('#hotel-modal').modal('show');
            $("#submit-modal").css("display", "");
            $("#alert-modal").html(
                ""
            );
        }

        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        $(document).ready(function () {
            $("#submit-modal").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                var name = $('#hotel-name').val();
                var address = $('#hotel-address').val();
                var description = $('#hotel-description').val();
                var ok = 0;
                if (name.trim() == "" || address.trim() == "" || description.trim() == "") ok = 1;

                if (!name || !address || !description || ok == 1) {
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
                    address: address,
                    description: description,
                    _token: "{{csrf_token()}}"
                };
                axios.post("/api/hotel", data)
                    .then(function () {
                        // window.location = "/home";
                    }.bind(this))
                    .catch(function () {
                    }.bind(this));
            });
        });
</script>
@endpush
