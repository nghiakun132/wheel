<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="canonical" href="{{ config('app.url') }}" />

    <title>
        {{ config('app.name', 'Laravel') }}
    </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.index') }}">
                    <span class="align-middle">
                        {{ config('app.name', 'Laravel') }}
                    </span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="{{ route('admin.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->role == 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.reward.index') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">
                                Quà tặng
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.rewarded') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">
                                Quà đã sử dụng
                            </span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.store') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">
                                Store
                            </span>
                        </a>
                    </li>
                    @endif

                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change-password">Đổi
                                    mật khẩu</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-start">
                            <p class="mb-0">

                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="modal fade" id="change-password" tabindex="-1" aria-labelledby="change-passwordLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-passwordLabel">Thêm cửa hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.changePassword') }}" method="POST" id="form-change-password">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="old_password" name="old_password"
                                oninput="onChange('old_password')">
                            <p class="invalid-feedback text-danger" id="err-old_password"></p>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới </label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                oninput="onChange('new_password')">
                            <p class="invalid-feedback text-danger" id="err-new_password"></p>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                oninput="onChange('new_password_confirmation')" name="new_password_confirmation">
                            <p class="invalid-feedback text-danger" id="err-new_password_confirmation"></p>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const formChangePassword = document.querySelector('#form-change-password');
            const btnChangePass = document.querySelector('#change-password .btn-primary');
            btnChangePass.addEventListener('click', function () {
                $.ajax({
                    url: formChangePassword.action,
                    method: formChangePassword.method,
                    data: $(formChangePassword).serialize(),
                    success: function (data) {
                        if (data.status) {
                            window.location.reload();
                        }
                    },
                    error: function (error) {
                        let message = error.responseJSON.message;


                        Object.keys(message).forEach(function (key) {
                            $("#" + key).addClass('is-invalid');

                            $("#err-" + key).text(message[key].toString());
                        })

                    }
                });
            });
        });
    </script>
    <script>
        function onChange(field) {
            $("#" + field).removeClass('is-invalid');
            $("#err-" + field).text('');
        }
    </script>
</body>

</html>