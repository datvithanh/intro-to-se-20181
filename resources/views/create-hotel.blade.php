@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Tạo khách sạn</h2></div>
                    </div>
                </div>
                <div class="card-body" style="padding-bottom: 0px">
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
                        
                        <select class="multipleSelect" multiple name="language">
                            @foreach($services as $service)
                                <option value="{{$service['id']}}">{{$service['name']}}</option>
                            @endforeach
                        </select>
                        
                        <div id="alert-modal" style="font-size: 14px"></div>

                        <button class="btn btn-success" style="width: 100%; margin: 10px; padding: 15px;" id="submit-modal">Đăng
                            kí
                        </button>
                    </div>
                </div>
            </div>
</div>

@endsection
@push('scripts')
<script>

    $('.multipleSelect').fastselect();
    $(document).ready(function () {
            $("#submit-modal").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                servicesArr = [];
                if($('.fstChoiceItem').length !== 0){
                    elem = $('.fstChoiceItem');
                    for(i=0; i<elem.length; ++i)
                        servicesArr.push(elem[i].getAttribute('data-value'));
                }
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
                var message = "Tạo khách sạn thành công";
                $("#alert-modal").html("<div class='alert alert-success'>" + message + "</div>");
                $("#submit-modal").css("display", "none");

                var url = "";
                var data = {
                    name: name,
                    address: address,
                    description: description,
                    services: servicesArr,
                    _token: "{{csrf_token()}}"
                };
                axios.post("/api/hotel", data)
                    .then(function () {
                        window.location = "/home";
                    }.bind(this))
                    .catch(function () {
                    }.bind(this));
            });
        });
</script>
@endpush
