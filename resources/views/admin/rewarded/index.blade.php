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
                        {{-- filter --}}
                        <form action="">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <input type="date" class="form-control" id="date" name="date"
                                        placeholder="dd/mm/yyyy" autocomplete="off" value="{{request()->get('date')}}">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <a href="{{ route('admin.rewarded') }}" class="btn btn-secondary">Reset</a>
                                    <button type="submit" class="btn btn-primary" id="btn-search">Search</button>
                                </div>
                            </div>
                        </form>
                        <hr class="mt-4">
                        <div class="row">

                            @foreach ($rewards as $key => $group)
                                <h3>
                                    Tên shop: <b>{{ $key }}</b>
                                </h3>
                                @foreach ($group as $item)
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="mb-0 text-center">
                                                    <img src="{{ asset($item->images) }}" height="100">
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center mt-3">
                                                    <span style="font-size: 16px" class="badge bg-success">{{ $item->rewarded_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <a href="{{ route('admin.index') }}" class="btn btn-info" style="border-radius: 10px">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
