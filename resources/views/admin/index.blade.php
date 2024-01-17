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
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">
                                            Import
                                        </h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="upload"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0 text-center">
                                    <button type="button" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">
                                            Export
                                        </h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="download"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0 text-center">
                                    <a href="{{route('admin.export')}}" class="btn btn-success">Export</button>
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