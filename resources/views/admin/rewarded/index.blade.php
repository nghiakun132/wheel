@extends('layouts')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <h4>
                    Số lượng quà đã sử dụng
                </h4>
                <div class="row">
                    @foreach ($rewards as $key => $group)
                    <h4>
                        {{ $key }}
                    </h4>
                        @foreach ($group as $item)
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-0 text-center">
                                        <img src="{{ asset($item->images) }}" width="150" height="150">
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-3">
                                        <span class="badge bg-success">{{ $item->rewarded_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>

                <div class="row">
                    <a href="{{ route('admin.index') }}" class="btn btn-info" style="border-radius: 10px">Return</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection