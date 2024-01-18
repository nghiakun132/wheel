@extends('layouts')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                @if (auth()->user()->role == 'admin')
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('admin.export') }}" id="form-export">
                                            <div class="row">
                                                <div class="col-md-4 mt-2">
                                                    <select class="form-control" id="select" data-bs-toggle="tooltip"
                                                        name="store" data-bs-placement="top" title="Chọn store để export">
                                                        <option value="">Chọn store</option>
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->name }}">{{ $store->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <input type="date" class="form-control" id="date" name="date"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Chọn ngày để export">
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="mb-0 text-center">
                                                        <button type="submit" id="submit"
                                                            class="btn btn-success">Export</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
