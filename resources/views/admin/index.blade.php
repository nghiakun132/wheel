@extends('layouts')
@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-0 text-center">
                                    <button type="button" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-0 text-center">
                                    <a href="{{route('admin.export')}}" class="btn btn-success">Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection