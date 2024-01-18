<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'> --}}
    @if(config('app.https') == true)
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <link rel="stylesheet" href="{{ asset('wheel/css/sweetalert2.min.css') }}"> 
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <link rel="stylesheet" href="{{ asset('wheel/css/style.css') }}">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-130950821-1');
    </script>

    <title>
        {{config('app.name')}}
    </title>
</head>

<style>
    .step {
        display: none;
    }

    #next-btn,
    #btn-spin {
        border-radius: 38px;
        width: 98%;
        padding: 5px;
        font-size: 35px;
        bottom: 10px;
        position: fixed;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <form id="form-register">
                    <div class="step">
                        @include('home.register')
                    </div>
                    <div class="step">
                        @include('home.question')
                    </div>
                    <div class="step">
                        @include('home.wheel')
                    </div>
                </form>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-primary" id="next-btn" onclick="nextPrev(1)">Next</button>

                    <button class="btn btn-primary" type="button" id="btn-spin" style="display:none" onclick="">
                        SPIN
                    </button>
                </div>

            </div>

        </div>

        <!-- cd-main-content -->
        <script src="{{ asset('wheel/js/jquery-2.1.1.js') }}"></script>
        <!-- <script src="{{ asset('wheel/js/jquery.superwheel.min.js') }}"></script>  -->
        <!-- superWheel -->
        <script src="{{ asset('wheel/js/sweetalert2.min.js') }}"></script> <!-- sweetalert2 -->
        <script>
            var currentTab = 0;
            showTab(currentTab);

            function showTab(n) {
                var x = document.getElementsByClassName("step");
                x[n].style.display = "block";

                if (n == 0) {
                    $("#prev-btn").hide();
                    $("#form-footer").removeClass("justify-content-between").addClass("justify-content-end");

                } else {
                    $("#prev-btn").css("display", "inline");
                    $('.d-flex').css('position', 'relative!important');
                    $("#form-footer").removeClass("justify-content-end").addClass("justify-content-between");
                }

                if (n == (x.length - 1)) {
                    $('#next-btn').hide();
                    $('#btn-spin').show();
                } else {
                    $('#next-btn').show();
                    $('#btn-spin').hide();
                }

            }

            function nextPrev(n) {
                if (currentTab == 0) {
                    if (!validateFormRegister()) {
                        return false;
                    }
                }

                if (currentTab == 1) {
                    let count = 0;
                    $(".form-check-input").each(function () {
                        if ($(this).is(":checked")) {
                            count++;
                        }
                    });

                    if (count < 5) {
                        swal({
                            type: 'error',
                            title: "Oops!",
                            html: "Bạn phải chọn đủ 5 câu trả lời!"
                        })

                        return false;
                    }
                }

                let x = document.getElementsByClassName("step");

                x[currentTab].style.display = "none";
                currentTab = currentTab + n;

                showTab(currentTab);
            }

            function validateFormRegister() {
                const name = $('#name').val();
                const email = $('#email').val();
                const phone = $('#phone').val();

                if (name == '') {
                    $('#name').addClass('is-invalid');

                    return false;
                }

                if (email == '') {
                    $('#email').addClass('is-invalid');

                    return false;
                }

                if (phone == '') {
                    $('#phone').addClass('is-invalid');

                    return false;
                }

                return true;
            }
        </script>
        <script>
            $("#btn-spin").on("click", function () {
                // Xoay Circle-01
                gif = {{$randomProduct}}
                row = (7200 + (gif * 90)) - (getRandomNumber(25, 65));
                $("#Circle-row").css("transform", "rotate(" + row + "deg)");
                // Cập nhật tên của nút


                $(this).text("Spiniing...");
            });

            $("#Circle-row").one("transitionend", function () {
                //     const listImage = {
                //     1: "{{ asset('image/voucher.png') }}",
                //     2:"{{ asset('image/sticker.png') }}",
                //     3:"{{ asset('image/mockhoa.png') }}",
                //     4:"{{ asset('image/pin.png') }}",
                // }

                //     const listName = {
                //         1: "Voucher",
                //         2: "Sticker",
                //         3: "Móc khóa",
                //         4: "Pin"
                //     }

                    const data = $("#form-register").serializeArray();

                    data.push({
                        name: 'reward',
                        value: gif
                    });

                    const image = "{{ $image}}";
                    const name = "{{ $name }}";
                    swal({
                        type: 'success',
                        title: "Congratulations!",
                        'html': name + ' <br><br><b><img src="' +  image +
                            '"" width="100px" height="100px" /></b>'
                        
                    })
                    .then((result) => {
                        if (result.value) {
                            callAjax(data);
                        }
                    })
                });

            function callAjax(data) {

                $.ajax({
                    url: "{{ route('submit') }}",
                    type: "POST",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            window.location.href = "{{route('dashboard')}}"
                        }
                    },
                    error: function (response) {
                        window.location.href = "{{route('dashboard')}}"
                    }
                });
            }

            function getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
        </script>
</body>

</html>