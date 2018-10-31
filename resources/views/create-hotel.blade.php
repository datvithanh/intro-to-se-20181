@extends('layouts.owner')

@section('content')
<div class="container">
        <div class="table-wrapper">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8"><h2>Tạo khách sạn</h2></div>
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
                                <th width="15%"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush
