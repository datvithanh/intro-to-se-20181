@extends('layouts.master')

@section('content')

<div class="page-header" data-parallax="true" style="background-image: url('/assets/img/uriel-soberanes.jpg')">
    <div class="page">
		
    <div class="content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input style="padding:10px; width: 250px" placeholder="Email" type="text" id="email" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input style="padding:10px; width: 250px" placeholder="Mật khẩu" type="password" id="password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <button class="btn btn-primary" id="login-btn">
                                                Đăng nhập
                                            </button>
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
@push('scripts')
<script>
    $("#login-btn").click(function(event){
        event.preventDefault();
        let email = $("#email").val();
        let password = $("#password").val();
        if(email == "" || email.trim() == "" || password == "" || password.trim() == ""){
            toastr.error("Please fill both email and password");
            return;
        }
        let data = {
            'email': email,
            'password': password
        };
        axios.post("/api/login", data)
            .then(function (response) {
                console.log(response);
                let status = response.status;
                window.location = "/";
            })
            .catch(function (error) {
                toastr.error(error.response.data.message);
            });
    });
</script>
@endpush
@endsection 
 