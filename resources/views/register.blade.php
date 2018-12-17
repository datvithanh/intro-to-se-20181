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
                                            <input style="padding:10px; width: 250px" placeholder="Name" type="text" id="name" value="">
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
                                        <div class="form-group">
                                            <input style="padding:10px; width: 250px" placeholder="Xác nhận mật khẩu" type="password" id="confirm-password" value="">
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
@endsection 
 
@push('scripts')
<script>
    $("#login-btn").click(function(event){
        event.preventDefault();
        let email = $("#email").val();
        let name = $("#name").val();
        let password = $("#password").val();
        let confirmPassword = $("#confirm-password").val();
        console.log(confirmPassword);
        console.log(password);
        if(email == "" || email.trim() == "")
        {
            toastr.error("Please fill in email");
            return;
        }
        if(name == "" || name.trim() == "")
        {
            toastr.error("Please fill in name");
            return;
        }
        if(password == "" || password.trim() == ""){
            toastr.error("Please fill in password");
            return;
        }
        if(confirmPassword == "" || confirmPassword.trim() == ""){
            toastr.error("Please fill in confirm password");
            return;
        }
        // if(password != confirmPassword) {
        //     toastr.error("Password does not match");
        //     return;
        // }
        let data = {
            'name': name,
            'email': email,
            'password': password
        };
        let path = "{{$path}}";
        axios.post("/api/register", data)
            .then(function (response) {
                let status = response.status;
                window.location = path + "?start=" +start + "&end=" + end;
            })
            .catch(function (error) {
                toastr.error(error.response.data.message);
            });
    });
</script>
@endpush