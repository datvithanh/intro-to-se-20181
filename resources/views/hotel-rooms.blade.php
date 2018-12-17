@extends('layouts.master')

@section('content')
<div class="background-image"></div>
<div class="content-center" style="margin-top:85px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($rooms as $room)
                <div class="card card-raised card-form-horizontal no-transition mb-2">
                    <div class="card-block">
                        <form method="" action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{$room['avatar']}}">
                                </div>
                                <div class="col-md-3">
                                    <p class="title" style="color: #333333">
                                        <p>Name: {{$room['name']}}. </p>
                                        <p>Price: {{$room['price']}}</p>
                                        <p>Total: {{$room['total']}}.</p>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="title" style="color: #333333">
                                        <p>
                                            Features:
                                        </p>
                                    @foreach($room['features'] as $feature)
                                        <p>
                                            -{{$feature['name']}}
                                        </p>
                                    @endforeach
                                    </h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" onclick="book({{$room['id']}})" class="btn btn-danger btn-block">
                                        <i class="nc-icon nc-zoom-split"></i>
                                        &nbsp; Đặt phòng
                                </button></div>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form>
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom:30px">
                                        <h4>Bạn đang tiến hành đặt phòng:asdsad</h4>
                                        <h4>Tại khách sạn: adssad</h4>
                                        <hr>
                                        <h5>Vui lòng kiểm tra lại thông tin phòng trước khi xác nhận:</h5>
                                        <h6>Ngày checkin: asdad</h6>
                                        <h6>Ngày checkout: easd</h6>
                                        <h6>Giá phòng: asdsda</h6>
                                        <h6>
                                            <p>
                                                Features:
                                            </p>
                                        </h6>
                                        <hr>
                                        <h5>Thông tin cá nhân: </h5>
                                        
                                        <hr>
                                        <h4>Đánh giá:</h4>

                                        <div class="col-md-12">
                                        @foreach($rates as $rate) 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="http://farm9.staticflickr.com/8130/29541772703_6ed8b50c47_b.jpg" style="width: 50px; border-radius:50%"/>
                                                <span class="rating-content" title="{{$rate['stars']}}">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <span style="width: {{$rate['stars']/5*100}}%;">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-md-6" style="white-space:normal; overflow: hidden">
                                                <span>
                                                    <h5>{{$rate['name']}}</h5>
                                                    <h6>{{$rate['content']}}</h6>
                                                </span>
                                            </div>
                                            <hr style="width: 30%">
                                        </div>
                                        @endforeach
                                        </div>
                                </div>
                                <div style="text-align:center; width: 100%">
                                    <button class="btn btn-primary" id="rate-btn">Đánh giá</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
    </div>
</div>

<div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form đánh giá khách sạn</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Đánh giá:
            <div class="rating-group">
                <input disabled checked class="rating__input rating__input--none" name="rating" id="rating-none" value="0" type="radio">
                <label aria-label="1 star" class="rating__label" for="rating-1">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </label>
                <input class="rating__input" id="rating-1" name="rating" value="1" type="radio">
                <label aria-label="2 stars" class="rating__label" for="rating-2">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </label>
                <input class="rating__input" id="rating-2" name="rating" value="2" type="radio">
                <label aria-label="3 stars" class="rating__label" for="rating-3">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </label>
                <input class="rating__input" id="rating-3" name="rating" value="3" type="radio">
                <label aria-label="4 stars" class="rating__label" for="rating-4">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </label>
                <input class="rating__input" id="rating-4" name="rating" value="4" type="radio">
                <label aria-label="5 stars" class="rating__label" for="rating-5">
                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                </label>
                <input class="rating__input" id="rating-5" name="rating" value="5" type="radio">
            </div>
            <div class="form-group">
                <label for="content">Nhận xét của bạn:</label>
                <textarea class="form-control" rows="5" id="content"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" id="send">Gửi đánh giá</button>
        </div>
        </div>
    </div>
</div>
            
@endsection

@push('scripts')
<script>
    function book(roomId) {
        if(isLogin == "1") {
            toastr.error("Đăng nhập để tiếp tục đặt phòng");
            return;
        }
        window.location = '/booking/' + roomId + "?start=" + "{{$start}}" + "&end=" + "{{$end}}";
    }
    $("#rate-btn").click(function(){
        if(isLogin == "1") {
            toastr.error("Đăng nhập để đánh giá");
            return false;
        }
        $("#rate-modal").modal("show");
        return false;
    });
    $("#send").click(function(){
        let stars = +$('input[name=rating]:checked').val();

        let content = $("#content").val();
        let data = {
            stars: stars,
            content: content
        };
        axios.post('/api/rate/{{$hotel_id}}', data).then(function(response){
            toastr.success('Gửi đánh giá khách sạn thành công');
            window.location = window.location.href;
        }).catch(function(error){

        });
        return false;
    });
</script>
@endpush