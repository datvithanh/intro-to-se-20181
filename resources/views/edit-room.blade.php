@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Phòng {{$name}}</h2></div>
                    </div>
                </div>
                <div class="card-body" style="padding-bottom: 0px">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 10px 20px">
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%" id="hotel-name" type="text"
                                value="{{$name}}"/>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%" type="text" id="price"
                                value="{{$price}}"/>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%" type="text" id="hotel-description"
                                value="{{$description}}"/>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input class="form-control" style="height: 50px" width="100%" type="text" id="total"
                                value="{{$total}}"/>
                        </div>
                        
                        <select class="multipleSelect" multiple name="language">
                            @foreach($features as $feature)
                                @if($feature['selected'] == 1)
                                    <option value="{{$feature['id']}}" selected>{{$feature['name']}}</option>
                                @else 
                                    <option value="{{$feature['id']}}">{{$feature['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-group" style="width: 100%;">
                            <input type="button" class="btn btn-success" id="get_file" value="Grab file">
                            <input type="file" style="display: none;" id="my_file" multiple>
                            <table class="table table-striped table-bordered" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th width="15%">Ảnh</th>
                                        <th>Tên</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="image-table">
                                    @foreach($images as $image)
                                        <tr>
                                            <th><img id="blah" src="{{$image}}" style="width: 100px; height:auto;"/></th>
                                            <th>{{$image}}</th>
                                            <th><a href="#" onclick="deleteImg(this)" class="delete"><i class="material-icons" style="color:#E34724">&#xE872;</i></a></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="alert-modal" style="font-size: 14px"></div>

                        <button class="btn btn-success" style="width: 100%; margin: 10px; padding: 15px;" id="submit-modal">Lưu
                        </button>
                    </div>
                </div>
            </div>
</div>

@endsection
@push('scripts')
<script>
    document.getElementById('get_file').onclick = function() {
        document.getElementById('my_file').click();
    };

    $('input[type=file]').change(function (e) {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) 
            names.push($(this).get(0).files[i].name);
        var data = {
            image_names: JSON.stringify(names),
            _token: "{{csrf_token()}}"
        };
        axios.post('/api/upload', data)
            .then(function(response){
                var urls = response.data.urls;
                for(var i = 0; i < urls.length; ++i){
                    var ele = "<tr><th><img id=\"blah\" src=\"" + urls[i] + "\" style=\"width: 100px; height:auto;\"/></th><th>"+urls[i]+"</th><th><a href=\"#\" onclick=\"deleteImg(this)\" class=\"delete\" title=\"Xoá\" data-toggle=\"tooltip\"><i class=\"material-icons\" style=\"color:#E34724\">&#xE872;</i></a></th></tr>";
                    $(ele).appendTo("#image-table");
                }
            }).catch(function(response){

            })
    });

    function deleteImg(obj) {
        obj.parentElement.parentElement.remove();
    }

    $('.multipleSelect').fastselect();
    $(document).ready(function () {
            $("#submit-modal").click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                featuresArr = [];
                if($('.fstChoiceItem').length !== 0){
                    elem = $('.fstChoiceItem');
                    for(i=0; i<elem.length; ++i)
                        featuresArr.push(elem[i].getAttribute('data-value'));
                }
                let name = $('#hotel-name').val();
                let price = $('#price').val();
                let description = $('#hotel-description').val();
                let total = $("#total").val();
                var ok = 0;
                if (name.trim() == "" || price.trim() == "" || description.trim() == "" || total.trim() == "") ok = 1;

                if (!name || !price || !description || ok == 1) {
                    toastr.error("Vui lòng nhập đủ thông tin");
                    return;
                }
                if(isNaN(price)){
                    toastr.error("Giá phòng bắt buộc phải là số thực");
                    return;
                }
                var message = "Tạo khách sạn thành công";
                toastr.success("Sửa phòng thành công");
                $("#submit-modal").css("display", "none");
                var image_urls = [];
                var eles = $('#image-table tr th img');
                for(var i =0; i<eles.length; ++i){
                    image_urls.push(eles[i].src);
                }
                var url = "";
                var data = {
                    name: name,
                    price: price,
                    description: description,
                    features: featuresArr,
                    image_urls: JSON.stringify(image_urls),
                    hotel_id: {{$hotel_id}},
                    total: total,
                    _token: "{{csrf_token()}}"
                };
                axios.put("/api/room/{{$id}}", data)
                    .then(function () {
                        window.location = "/hotel/{{$hotel_id}}";
                    }.bind(this))
                    .catch(function () {
                    }.bind(this));
            });
        });
</script>
@endpush
