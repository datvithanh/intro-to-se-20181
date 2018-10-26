@extends('layouts.owner')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Danh sách khách sạn
                    <button class="btn btn-success" onClick="openHotelModal();" style="float:right;">asd</button>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th> Mã phòng</th>
                                <th> Tên</th>
                                <th> Loại phòng</th>
                                <th> Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> adksk </td>
                                <td> asdjj </td>
                                <td>asjdk</td>
                                <td> asdkk</td>
                                <td> askdk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
