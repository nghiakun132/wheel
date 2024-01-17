@extends('layouts')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <h4>
                        Cửa hàng
                    </h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-0">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#add-store">
                                            Thêm mới
                                        </button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover my-0">
                                            <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th class="">Email</th>
                                                    <th>
                                                        <div class="text-center">Action</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($stores as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a href="{{ route('admin.store.delete', $item->id) }}"
                                                                    class="btn btn-danger btn-sm">Xóa</a>
                                                            </div>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="3">Không có dữ liệu</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add-store" tabindex="-1" aria-labelledby="add-storeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-storeLabel">Thêm cửa hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.store.store') }}" method="POST" id="form-add-store">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên cửa hàng</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    oninput="onChange('name')" />
                                <p class="invalid-feedback text-danger" id="err-name"></p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    oninput="onChange('email')">
                                <p class="invalid-feedback text-danger" id="err-email"></p>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    oninput="onChange('password')">
                                <p class="invalid-feedback text-danger" id="err-password"></p>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    oninput="onChange('password_confirmation')" name="password_confirmation">
                                <p class="invalid-feedback text-danger" id="err-password_confirmation"></p>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button type="button" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const formAddStore = document.querySelector('#form-add-store');
        const btnAddStore = document.querySelector('#add-store .btn-primary');
        btnAddStore.addEventListener('click', function() {
            $.ajax({
                url: formAddStore.action,
                method: formAddStore.method,
                data: $(formAddStore).serialize(),
                success: function(data) {
                    if (data.status) {
                        window.location.reload();
                    }
                },
                error: function(error) {
                    let message = error.responseJSON.message;


                    Object.keys(message).forEach(function(key) {
                        $("#" + key).addClass('is-invalid');

                        $("#err-" + key).text(message[key].toString());
                    })

                }
            })
        })


    })

</script>
