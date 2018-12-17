@extends('layouts.master')

@section('content')
<div class="background-image"></div>

<div class="container" style="margin-top: 85px">
    <div class="content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form>
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom:30px">
                                        <h4>Bạn đang tiến hành đặt phòng: {{$name}}</h4>
                                        <h4>Tại khách sạn: {{$hotel_name}}</h4>
                                        <hr>
                                        <h5>Vui lòng kiểm tra lại thông tin phòng trước khi xác nhận:</h5>
                                        <h6>Ngày checkin: {{$start}}</h6>
                                        <h6>Ngày checkout: {{$end}}</h6>
                                        <h6>Giá phòng: {{$price}}</h6>
                                        <h6>
                                            <p>
                                                Features:
                                            </p>
                                        @foreach($features as $feature)
                                            <p>
                                                -{{$feature['name']}}
                                            </p>
                                        @endforeach
                                        </h6>
                                        <hr>
                                        <h5>Thông tin cá nhân: </h5>
                                        <h6>Tên: {{$user->name}}</h6>
                                        <h6>Email: {{$user->email}}</h6>
                                        <hr>
                                        <h5>Thông tin thanh toán:</h5>
                                        <label for="fname">Accepted Cards</label>
                                                <div class="icon-container">
                                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div>
                                                <label for="cname">Name on Card</label>
                                                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                                </div>
                                                <div>
                                                <label for="ccnum">Credit card number</label>
                                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                <label for="expmonth">Exp Month</label>
                                                <input type="text" id="expmonth" name="expmonth" placeholder="07">
                                                </div>
                                                <div>
                                                    <label for="expyear">Exp Year</label>
                                                    <input type="text" id="expyear" name="expyear" placeholder="2023">
                                                </div>
                                                <div>
                                                    <label for="cvv">CVV</label>
                                                    <input type="password" id="cvv" name="cvv" placeholder="352">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align:center; width: 100%">
                                        <button class="btn btn-primary" id="booking-btn" >Xác nhận</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
 

@push('scripts')
<script>
    $("#booking-btn").click(function(event){
        if(start == "" || end == "") {
            toastr.error("Không tồn tại ngày đặt phòng");
            return false;
        }
        let roomId = "{{$room_id}}";
        console.log(new Date(start.replace('-', '/').replace('-', '/')));
        console.log(new Date(end.replace('-', '/').replace('-', '/')));
        let data = {
            start: new Date(start),
            end: new Date(end),
        };
        
        axios.post("/api/booking/" + roomId, data)
            .then(function(response){
                toastr.success("Đặt phòng thành công");
                window.location = "/";
                return false;
            }).catch(function(response){
                console.log(response);
                return false;
            });
        return false;
    });
</script>
@endpush