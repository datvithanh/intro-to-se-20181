@extends('layouts.master')

@section('content')
<div class="page-header" data-parallax="true" style="background-image: url('/assets/img/uriel-soberanes.jpg')" style="position:fixed">
    <div class="content-center" style="top:20%; margin-top:150px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($hotels as $hotel)
                    <div class="card card-raised card-form-horizontal no-transition">
                        <div class="card-block">
                            <form method="" action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{$hotel['avatar']}}">
                                    </div>
                                    <div class="col-md-3">
                                        <h3 class="title" style="color: #333333">
                                            {{$hotel['name']}}
                                        </h3>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" value="" placeholder="Date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-danger btn-block"><i class="nc-icon nc-zoom-split"></i>
                                            &nbsp; {{$hotel['name']}}
                                        </button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
@endpush
@endsection
