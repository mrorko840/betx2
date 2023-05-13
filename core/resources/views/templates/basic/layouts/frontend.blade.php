<!doctype html>
<?php
$user = auth()->user();

$yourLinks = getContent('your_links.content', true);
?>

<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>

    @include('partials.seo')


    <!-- Custom Css -->

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset($activeTemplateTrue . 'assets/manifest.json') }}" />
    
    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset($activeTemplateTrue . 'assets/css/style.css') }}" rel="stylesheet" id="style">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    
    <!-- line-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>

    <style>
        a {
            text-decoration: none;
        }

        .bg-gradiant {
            background-image: linear-gradient(to bottom right, #ffffff36, #00000081) !important;
            color: #FFF;
        }

        .bg-gradiant-alt {
            background-image: linear-gradient(to bottom right, #00000081, #ffffff36) !important;
            color: #FFF;
        }

        .bg-purple {
            background: #560087 !important;
            color: #FFF;
        }

        .bg-orange {
            background: #f76000 !important;
            color: #FFF;
        }

        .btn-mini {
            font-size: 0.6rem;
            line-height: 1;
            border-radius: 80.19999999999999rem;
        }

        .btn-mini2 {
            font-size: 0.7rem;
            line-height: 1.7;
            border-radius: 80.19999999999999rem;
        }

        .border-custom {
            border-radius: 1.3rem !important;
        }

        .avatar.avatar-200 {
            height: 200px;
            line-height: 200px;
            width: 200px;
        }

        /* custom */

        .single-select.active {
            position: relative;
            border-color: #e6a25d;
        }

        .single-select {
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            border-radius: 8px;
        }
    </style>
    

    <!--js new-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    @stack('style-lib')

    @stack('style')

    <!-- custom css -->
    @include('templates.basic.layouts.custom.custom_css')

</head>

<body>

    <!-- Language -->
    {{-- <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="left d-flex align-items-center">
                            <div class="language">
                                <i class="las la-globe-europe"></i>
                                <select id="langSel" class="nic-select">
                                    @php
                                        $langs = App\Models\Language::all();
                                    @endphp
                                    @foreach ($langs as $lang)
                                        <option value="{{ $lang->code }}"
                                            @if (Session::get('lang') === $lang->code) selected @endif>{{ __($lang->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header> --}}

    <!-- screen loader -->
    {{-- <div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon icon-100 mb-4 rounded-circle shadow-sm">
                        <img src="{{ asset('assets/images/logoIcon/favicon.png') }}" alt="" class="w-100">
                    </div>
                    <h4 class="text-primary">{{ $general->sitename }}</h4>
                    <p class="text-secondary">{{ __($pageTitle) }}</p>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @yield('content')

    @php
        $DandW = json_decode($general->d_and_w_preset, true);
    @endphp

    <!-- Deposit Modal -->
    @include('templates.basic.modals.deposit')
    <!-- Withdraw Modal -->
    @include('templates.basic.modals.withdraw')
    
    <!-- Prediction Modal -->
    @include('templates.basic.modals.prediction')
    


    {{-- <div class="modal cmn--modal fade" id="loginModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col text-center">@lang('Login Required')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="predict-content">
                        <h6 class="subtitle">
                            @lang('Placing Bet Requires Login')
                        </h6>
                        <div class="be-in-limit">
                            <span>@lang('If you are already with us then please ')</span> <span><a href="{{ route('user.login') }}"
                                    class="text--base">@lang('login')</a></span> <span>@lang('otherwisw')</span>
                            <span>
                                <a href="{{ route('user.register') }}" class="text--base">@lang('register')</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm bg-danger text--white border-0 fz--16"
                        data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}"
                        class="btn btn-sm btn--success border-0 fz--16">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div> --}}

    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp

    @if (@$cookie->data_values->status && !session('cookie_accepted'))
        <div class="cookie-remove">
            <div class="cookie__wrapper bg--section">
                <div class="container">
                    <div class="flex-wrap align-items-center justify-content-between">
                        <h4 class="title">@lang('Cookie Policy')</h4>
                        <div class="txt my-2">
                            @php echo @$cookie->data_values->description @endphp
                        </div>
                        <div class="button-wrapper">
                            <button class="cmn--btn policy cookie">@lang('Accept')</button>
                            <a class="cmn--btn" href="{{ @$cookie->data_values->link }}" target="_blank"
                                class=" mt-2">@lang('Read Policy')</a>
                            <a href="javascript:void(0)" class="btn--close cookie-close"><i
                                    class="las la-times"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>


    <!--**** custom script start ****-->
    <!-- Required jquery and libraries -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/popper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>

    
    <!-- chart js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/utils.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/chart-js-data.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/color-scheme-demo.js') }}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/pwa-services.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/app.js') }}"></script>
    <!--***** custom script end *****-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')


    <script type="text/javascript">
        (function($, document) {
            "use strict";
            $(document).on('change', '#langSel', function() {
                var code = $(this).val();
                window.location.href = "{{ url('/') }}/change-lang/" + code;
            });

        })(jQuery, document);
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //-- Notify --//
        const notifyMsg = (msg,cls) => {
            Swal.fire({
                position: 'top-end',
                icon: cls,
                title: msg,
                toast:true,
                showConfirmButton: false,
                timer: 2100
            })
        }
        //sidebar Back Function
        const sideBarBack = () => {
            $('.backdrop').click()
        }
        const darkModeChange = () => {
            if($('body').hasClass('darkmode')){
                $('.darkIconChange').html('light_mode');
            }else{
                $('.darkIconChange').html('mode_night');
            }
        }

        $(window).on('load', function () {
            darkModeChange()
        });

        $(document).on('click', '#darklayout', function () {
            darkModeChange()
        });


        (function($) {
            "use strict";

            @if (Request::routeIs('home'))
                var s = 0;

                function getClock(diff) {
                    var hours = Math.floor(diff / 3600);
                    diff -= hours * 3600
                    var minutes = Math.floor(diff / 60);
                    diff -= minutes * 60;
                    var seconds = diff % 60;
                    return ("0" + hours).slice(-2) + ":" + ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2);
                }

                function set_timer() {

                    $('.mtime').each(function() {
                        var t = $(this).attr('data-date');
                        var start = new Date('{{ date('Y-m-d H:i:s') }}');
                        var end = new Date(t);
                        var diff = Math.round((end.getTime() - start.getTime()) / 1000);
                        diff = diff - s;
                        $(this).html(getClock(diff));
                    });

                    s++;

                }

                setInterval(function() {
                    set_timer();
                }, 1000);

            @endif

            //global variable
            var investRate = 0;
            var returnRate = 0;
            var investAmount = 0;
            // var tax = 1;
            var pc = 0;
            var score = '';
            var mid = 0;
            var oid = 0;

            let min_bet_limit = {{@$general->min_limit}};



            $(".bet-info").click(function() {
                var id = $(this).attr('data-id');

                score = '';
                pc = 0;
                oid = 0;
                mid = id;


                $.get('{{ route('bet.info') }}',

                    {
                        id: id
                    },

                    function(response) {

                        $('#predict-modal').html(response);
                        $('#msg').html("");
                        $('#predictModal').modal('show');

                    });



            });


            $(document).on('click', 'body .pf', function() {
                $(this).parent().siblings().find('.pf').removeClass('active');
                $(this).addClass('active');
                var p = $(this).attr('data-profit');
                pc = parseFloat(p).toFixed(2);
                $('#ppf').html(p);
                score = $(this).attr('data-score');
                var i = $(this).attr('data-id');
                oid = i;
                returnAmount();
            });

            $(document).on('click', 'td .cfc', function() {
                $('.cfc').removeClass('btn-danger');
                $(this).addClass('btn-danger');

                //$(this).parent().siblings().find('.cfc').removeClass('active');

                var p = $(this).attr('data-profit');
                pc = parseFloat(p).toFixed(2);
                $('#ppf').html(p);
                score = $(this).attr('data-score');
                var i = $(this).attr('data-id');
                oid = i;
                returnAmount();
            });




            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            $('.cookie').on('click', function() {
                var url = "{{ route('cookie.accept') }}";

                $.get(url, function(response) {

                    if (response.success) {
                        notify('success', response.success);
                        $('.cookie-remove').html('');
                    }
                });
            });

            $('.cookie-close').on('click', function() {
                $('.cookie-remove').html('');
            });


            $(document).on("input", "#invest-amount", function() {
                investAmount = $(this).val();
                returnAmount();
            });

            function returnAmount() {

                var investAmount = $(document).find('#invest-amount').val();
                console.log(investAmount);

                if (score == '') {
                    $('#return-amount').html('0.00 {{ __($general->cur_text) }}');
                    $('#invest-amount').val('');
                    //alert
                    notifyMsg('Please select a score first','warning');
                    return false;
                }

                if (parseFloat(investAmount) < min_bet_limit) {
                    $("#min-bet").show();
                } else {
                    $("#min-bet").hide();
                }

                var p = pc;

                var r = 0.01 * p;

                var m = r * investAmount;

                var mm = parseFloat(investAmount) + parseFloat(m);

                if (mm > 0) {

                    $('#return-amount').html(parseFloat(mm).toFixed(2) + ' {{ __($general->cur_text) }}');
                } else {

                    $('#return-amount').html('0.00 {{ __($general->cur_text) }}');
                }


            }

            //place bet
            $(document).on('click', 'body #place-bet', function() {

                if (investAmount < min_bet_limit) {
                    $('#min-bet').show();
                    notifyMsg('Check minimum Bet limit!', 'warning')
                    return false;
                }

                // Ajax
                $.ajax({
                    type: 'POST',
                    dataType: "JSON",
                    url: "{{ route('user.place-bet') }}",
                    data: {
                        _token: '{!! csrf_token() !!}',
                        id: mid,
                        option: oid,
                        amount: investAmount,
                    },
                    beforeSend: function() {
                        // $('#msg').show();
                        // $('#msg').html('<div class="alert alert-info"> Please wait.. </div>');
                        $('#place-bet').html('Please wait..');
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#place-bet').html('Proceed');
                            $('#predictModal').modal('hide');
                            //alert
                            notifyMsg('Place Bet Successfully!', 'success')
                        } else {
                            show_error(data.error);
                        }
                    }


                }); // Ajax





            });



            function show_error(msg) {
                $('#msg').html('<div class="alert alert-danger">' + msg + '</div>');
                $('#msg').show();

            }


            $(document).on("click", ".bet-info", function() {
                var modal = $('#predictModal');
                var resource = $(this).data('resource');
                var question = $(this).data('question');
                var matchName = $(this).data('match');
                var betDetails =
                    `<span class="text--base">${question}</span> <br><small>@lang('You are betting for ')${resource.name}</small>`;
                modal.find("input[name='option_id']").val(resource.id);
                investRate = resource.dividend;
                returnRate = resource.divisor;
                investAmount = modal.find('#invest-amount').val();
                returnAmount(investAmount);
                modal.find('.betting-details').html(betDetails);
                modal.find('.match-name').text(matchName);
            });


        })(jQuery);


        function myFunction() {

            var copyText = document.getElementById("myTRX");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied address: " + copyText.value);
        }
    </script>

</body>

</html>
