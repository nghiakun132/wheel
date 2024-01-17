<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('wheel/css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('wheel/css/sweetalert2.min.css') }}"> <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('wheel/css/superwheel.min.css') }}"> <!-- superWheel -->
    <link rel="stylesheet" href="{{ asset('wheel/css/style.css') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130950821-1"></script>
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

    <title>Super Wheel | Standard</title>
</head>

<style>
    .step {
        display: none;
    }

    #next-btn,
    #btn-spin {
        border-radius: 20px;
        width: 50%;
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
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" id="next-btn" onclick="nextPrev(1)">Next</button>

                        <button class="btn btn-danger" type="button" id="btn-spin" style="display:none"
                            onclick="">
                            Xoay
                        </button>
                    </div>

            </div>

        </div>

        <!-- cd-main-content -->
        <script src="{{ asset('wheel/js/jquery-2.1.1.js') }}"></script>
        <script src="{{ asset('wheel/js/jquery.superwheel.min.js') }}"></script> <!-- superWheel -->
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
                    $(".form-check-input").each(function() {
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
            jQuery(document).ready(function($) {

                $('.wheel-standard').superWheel({
                    slices: [
                        @foreach ($rewards as $reward)
                            {
                                text: '<img src="{{ asset("$reward->images") }}" />',
                                message: "{{ $reward->reward_name }}",
                                background: '{{ $reward->background }}',
                                color: "#fff",
                                image: '{{ asset("$reward->images") }}',
                                value: {{ $reward->id }},
                                quantity: {{ $reward->reward_quantity }}
                            },
                        @endforeach
                    ],
                    text: {
                        color: '#CFD8DC',
                    },
                    line: {
                        width: 10,
                        color: "#78909C"
                    },
                    outer: {
                        width: 14,
                        color: "#78909C"
                    },
                    inner: {
                        width: 15,
                        color: "#78909C"
                    },
                    marker: {
                        background: "#00BCD4",
                        animate: 1
                    },

                    selector: "value",
                });

                var tick = new Audio('{{ asset('wheel/media/tick.mp3') }}');

                $("#btn-spin").on('click', function() {
                    $('.wheel-standard').superWheel('start', 'value', {{ $randomProduct }});
                    $(this).prop('disabled', true);
                });

                $('.wheel-standard').superWheel('onStart', function(results) {
                    $('#btn-spin').text('Đang quay...');

                });
                $('.wheel-standard').superWheel('onStep', function(results) {

                    if (typeof tick.currentTime !== 'undefined')
                        tick.currentTime = 0;

                    tick.play();

                });


                $('.wheel-standard').superWheel('onComplete', function(results) {
                    const data = $("#form-register").serializeArray();
                    data.push({
                        name: 'reward',
                        value: results.message
                    });
                    swal({
                        type: 'success',
                        title: "Congratulations!",
                        html: results.message + ' <br><br><b><img src="' + results.image +
                            '"" width="100px" height="100px" /></b>',
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "{{ route('submit') }}",
                                type: "POST",
                                data: data,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.message == 'success') {
                                        window.location.reload();
                                    }
                                },
                            });
                        }
                    })


                    $('#btn-spin:disabled').prop('disabled', false).text('Xoay');

                });
            });
        </script>
</body>

</html>
