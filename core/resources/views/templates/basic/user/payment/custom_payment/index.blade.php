@php
    $user = Auth::user(); 
    $importentLinks = getContent('importent_links.content', true);
    $amount = $_GET['amount'];
@endphp

<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $general->sitename(__(@$pageTitle)) }}</title>

    <link rel="stylesheet" href="{{asset('assets/templates/basic/custom_payment/css/style2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/templates/basic/custom_payment/css/style2.css')}}">



    <link rel="icon" href="{{asset('assets/images/logoIcon/favicon.png')}}" type="image/gif">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        .bg-secondary{
            background-color: #adadad !important;
        }
        .active {
            border: 2px solid #f56d1b !important;
        }

        .flexer {
            margin-bottom: -20px;
            padding: 0;
        }

        @media screen and (max-width: 600px) {
            #cover_when_mobile_btn {
                margin-top: 0px;
                position: fixed;
                top: 215px;
                left: 0;
                width: 100%;
                z-index: 777;
                background-color: #FFFFFF;
            }
            .centerize .cover_ex .list_methods {
                margin-top: 290px;
            }
            .flexer {
                position: fixed;
                left: 0;
                width: 100%;
                bottom: 52px;
                margin: 0;
            }
            .d-none{
                display: none !important;
            }
        }
    </style>


    <style>
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: rgba(000, 000, 000, 0.6);
            display: none;
        }

        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3498db;
            -webkit-animation: spin 2s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 2s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
            z-index: 1001;
        }

        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #e74c3c;
            -webkit-animation: spin 3s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 3s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #f9c922;
            -webkit-animation: spin 1.5s linear infinite;
            /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 1.5s linear infinite;
            /* Chrome, Firefox 16+, IE 10+, Opera */
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera */
            }
        }

        @keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);
                /* IE 9 */
                transform: rotate(0deg);
                /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);
                /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);
                /* IE 9 */
                transform: rotate(360deg);
                /* Firefox 16+, IE 10+, Opera */
            }
        }

        #loader-wrapper .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            z-index: 1000;
            -webkit-transform: translateX(0);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateX(0);
            /* IE 9 */
            transform: translateX(0);
            /* Firefox 16+, IE 10+, Opera */
        }

        #loader-wrapper .loader-section.section-left {
            left: 0;
        }

        #loader-wrapper .loader-section.section-right {
            right: 0;
        }

        /* Loaded */

        .loaded #loader-wrapper .loader-section.section-left {
            -webkit-transform: translateX(-100%);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateX(-100%);
            /* IE 9 */
            transform: translateX(-100%);
            /* Firefox 16+, IE 10+, Opera */
            -webkit-transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .loaded #loader-wrapper .loader-section.section-right {
            -webkit-transform: translateX(100%);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateX(100%);
            /* IE 9 */
            transform: translateX(100%);
            /* Firefox 16+, IE 10+, Opera */
            -webkit-transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .loaded #loader {
            opacity: 0;
            -webkit-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
        }

        .loaded #loader-wrapper {
            visibility: hidden;
            -webkit-transform: translateY(-100%);
            /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: translateY(-100%);
            /* IE 9 */
            transform: translateY(-100%);
            /* Firefox 16+, IE 10+, Opera */
            -webkit-transition: all 0.3s 1s ease-out;
            transition: all 0.3s 1s ease-out;
        }
    </style>

</head>

<body>
    <div class="centerize">
        <div class="header">
            <div class="left">
                <div class="btn" onclick="location.href='{{route('home')}}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" preserveAspectRatio="xMidYMid meet" viewBox="0 0 15 15"><path fill="#7b7b7b" fill-rule="evenodd" d="M11.782 4.032a.575.575 0 1 0-.813-.814L7.5 6.687L4.032 3.218a.575.575 0 0 0-.814.814L6.687 7.5l-3.469 3.468a.575.575 0 0 0 .814.814L7.5 8.313l3.469 3.469a.575.575 0 0 0 .813-.814L8.313 7.5l3.469-3.468Z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <div class="right">
                <div class="btn" onclick="translate()">
                    <svg style="display:none" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#3f71e6" d="M240.7 96a19.7 19.7 0 0 0-5.9-14.1l-60.7-60.7a19.9 19.9 0 0 0-28.2 0l-57.1 57c-12.4-3.3-36.7-5.7-61.7 14.5a19.8 19.8 0 0 0-1.6 29.7L71 168l-31.5 31.5a12 12 0 0 0 0 17a12.1 12.1 0 0 0 17 0L88 185l45.4 45.3a19.7 19.7 0 0 0 14.1 5.9h1.4a19.8 19.8 0 0 0 14.6-7.9a88 88 0 0 0 14.4-27.9c3.4-11.7 3.5-22.9.2-33.4l56.7-56.8a19.7 19.7 0 0 0 5.9-14.2Zm-85.2 59.5a12.2 12.2 0 0 0-2.2 13.9c3.4 6.8 6.9 20.9-6.3 40.6l-50.5-50.5l-50.8-50.8c21.1-14.6 39.5-6.6 41-5.9a11.7 11.7 0 0 0 13.8-2.3L160 41l55 55Z"/></svg>
                </div>
            </div>
        </div>

        <span id="cover_when_mobile">

		<img src="{{asset('assets/images/logoIcon/favicon.png')}}" alt=""id="company_logo"style="object-fit: contain;">
		<h3 id="title">{{$general->sitename}}</h3>

        <div class="all_option">
			<div class="btn"onclick="show_wrapper(1)">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="#373d41" d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4c1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10z"/></svg>
				<p>Support</p>
			</div>
			<div class="btn"onclick="show_wrapper(6)">
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#373d41" d="M12 3C6.5 3 2 6.6 2 11c0 2.2 1.1 4.2 2.8 5.5c0 .6-.4 2.2-2.8 4.5c2.4-.1 4.6-1 6.5-2.5c1.1.3 2.3.5 3.5.5c5.5 0 10-3.6 10-8s-4.5-8-10-8m0 14c-4.4 0-8-2.7-8-6s3.6-6 8-6s8 2.7 8 6s-3.6 6-8 6m.2-10.5c-.9 0-1.6.2-2.1.5c-.6.4-.9 1-.8 1.7h2c0-.3.1-.5.3-.6c.2-.1.4-.2.7-.2c.3 0 .6.1.8.3c.2.2.3.4.3.7c0 .3-.1.5-.2.7c-.2.2-.4.4-.6.5c-.5.3-.9.6-1.1.8c-.4.3-.5.6-.5 1.1h2c0-.3.1-.5.1-.7c.1-.2.3-.3.5-.5c.5-.2.8-.5 1.1-.9c.3-.4.4-.8.4-1.2c0-.7-.3-1.3-.8-1.7c-.4-.3-1.2-.5-2.1-.5M11 13v2h2v-2h-2Z"/></svg>
				<p>FAQ</p>
			</div>
			<div class="btn"onclick="show_wrapper(2)">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="#373d41" d="M12 17q.425 0 .713-.288Q13 16.425 13 16v-4.025q0-.425-.287-.7Q12.425 11 12 11t-.712.287Q11 11.575 11 12v4.025q0 .425.288.7q.287.275.712.275Zm0-8q.425 0 .713-.288Q13 8.425 13 8t-.287-.713Q12.425 7 12 7t-.712.287Q11 7.575 11 8t.288.712Q11.575 9 12 9Zm0 13q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Zm0-10Zm0 8q3.325 0 5.663-2.337Q20 15.325 20 12t-2.337-5.663Q15.325 4 12 4T6.338 6.337Q4 8.675 4 12t2.338 5.663Q8.675 20 12 20Z"/></svg>
				<p>Details</p>
			</div>
        </div>
</span>

        <div class="cover_ex">
            <span id="cover_when_mobile_btn">
                <div class="menu">
                    <div class="box active_btn3wrap" onclick="show_wrapper(3)"id="active">
                        {{-- Mobile Banking --}}
                        Payment Methods
                    </div>
            
                    <div class="box active_btn4wrap" style="display: none;" onclick="show_wrapper(4)"id="">
                        Bank Transfer
                    </div>
            

                    <div class="box active_btn5wrap" style="display: none;" onclick="show_wrapper(5)"id="">
                        International
                    </div>
                </div>
			</span>

            <div class="list_methods" style="display:" id="wrapper3wrap">
                @foreach ($gatewayCurrency as $item)
                    <div class="row gateway" 
                        data-id="{{$item->id}}"
                        data-name="{{$item->name}}"
                        data-currency="{{$item->currency}}"
                        data-method_code="{{$item->method_code}}"
                        data-min_amount="{{showAmount($item->min_amount)}}"
                        data-max_amount="{{showAmount($item->max_amount)}}"
                        data-base_symbol="{{$item->baseSymbol()}}"
                        data-fix_charge="{{showAmount($item->fixed_charge)}}"
                        data-percent_charge="{{showAmount($item->percent_charge)}}"
                        >
                        <img src="{{$item->methodImage() }}" alt="">
                    </div>
                @endforeach

                <div id="oipurtrweptpertw"></div>
            </div>

            <div class="list_methods" style="display:none" id="wrapper4wrap">
                <div class="row" onclick="location.href='method/agrani/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/342523452345234532.png') }}" alt="" style="width: 100px;">
                </div>

                <div class="row" onclick="location.href='method/basicbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/3245234.jpg') }}" alt="" style="width: 130px;">
                </div>
                <div class="row" onclick="location.href='method/siblbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/sibl_bank_logo.jpg') }}" alt="" style="width: 90px;">
                </div>

                <div class="row" onclick="location.href='method/dutchbangla/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/dutch_bank_logo.jpg') }}" alt="" style="width: 70px;">
                </div>

                <div class="row" onclick="location.href='method/estern/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/eastern-bank-limited.jpg') }}" alt="" style="width: 130px;">
                </div>

                <div class="row" onclick="location.href='method/ificbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/ific_bank_logo.jpg') }}" alt="">
                </div>

                <div class="row" onclick="location.href='method/islamic/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/islamic_bank_logo.png') }}" alt="">
                </div>

                <div class="row" onclick="location.href='method/jamuna/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/jamuna_bank_logo.jpg') }}" alt="">
                </div>

                <div class="row" onclick="location.href='method/sbibank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/sbi_bank.png') }}" alt="" style="width: 70px;">
                </div>

                <div class="row" onclick="location.href='method/hdfcbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/hdfc_bank.png') }}" alt="" style="width: 110px;">
                </div>



                <div class="row" onclick="location.href='method/bankasia/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/bankasia.jpg') }}" alt="" style="width: 110px;">
                </div>

                <div class="row" onclick="location.href='method/bracbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/brac-bank.jpg') }}" alt="" style="width: 110px;">
                </div>

                <div class="row" onclick="location.href='method/maybank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/mybank.png') }}" alt="" style="width: 110px;">
                </div>

                <div class="row" onclick="location.href='method/rhbbank/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/rhbbank.png') }}" alt="" style="width: 110px;">
                </div>



                <div id="oipurtrweptpertw"></div>
            </div>

            <div class="list_methods" style="display:none" id="wrapper5wrap">
                <div class="row" onclick="location.href='method/perfectmoney/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/perfect.png') }}" alt="" style="height: 59px;width: auto;">
                </div>

                <div class="row" onclick="location.href='method/paypal/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/paypal_logo.png') }}" alt="">
                </div>

                <div class="row" onclick="location.href='method/payeer/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/payeer_logo.png') }}" alt="" style="width: 100px;">
                </div>

                <div class="row" onclick="location.href='method/skrill/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/skrill_logo.jpg') }}" alt="" style="width: 110px;">
                </div>

                <div class="row" onclick="location.href='method/payoneer/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/payoneer.png') }}" alt="" style="width: 110px;">
                </div>

                <div class="row" onclick="location.href='method/webmoney/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/wmlogo_vector_blue.png') }}" alt="" style="width: 160px;max-width: 116px;">
                </div>



                <div class="row" onclick="location.href='method/2checkout/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/visamastercard.jpg') }}" alt="" style="width: 160px;max-width: 56px;">
                </div>

                <div class="row" onclick="location.href='method/wise/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/wise.png') }}" alt="" style="width: 160px;max-width: 96px;">
                </div>

                <div class="row" onclick="location.href='method/pyypl/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/pyypl.png') }}" alt="" style="width: 160px;max-width: 96px;">
                </div>

                <div class="row" onclick="location.href='method/binance/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/Binance-logo.png') }}" alt="" style="width: 160px;max-width: 76px;">
                </div>



                <div class="row" onclick="location.href='method/neteller/81820264'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/neteller.png') }}" alt="" style="width: 160px;max-width: 86px;">
                </div>


                <div id="oipurtrweptpertw"></div>
            </div>

            <div class="transaction_details" style="display:none" id="wrapper2wrap">
                <p id="hd">Transaction Details</p>
                <div class="row">
                    <p id="ques">Name:</p>
                    <p id="ans">{{auth()->user()->firstname . ' ' . auth()->user()->lastname}}</p>
                </div>
                <div class="row">
                    <p id="ques">Username:</p>
                    <p id="ans">{{auth()->user()->username}}</p>
                </div>
                <div class="row">
                    <p id="ques">Amount:</p>
                    <p id="ans">{{showAmount($amount)}} {{$general->cur_text}}</p>
                </div>
                <div id="trxDetails"></div>
            </div>

            <div class="livechat" style="display:none" id="wrapper1wrap">
                <div class="row" onclick="window.open('{{ @$importentLinks->data_values->messenger }}', '_blank');">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/messenger.png') }}" alt="">

                    <p>Click here for live chat on Messenger</p>
                </div>

                <div class="row" onclick="window.open('{{ @$importentLinks->data_values->whatsapp }}', '_blank');">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/whatsapp.webp') }}" alt="">

                    <p>Click here for live chat on Whatsapp</p>
                </div>

                <div class="row" onclick="location.href='mailto:{{ @$importentLinks->data_values->gmail }}'">
                    <img src="{{asset('assets/templates/basic/custom_payment/image/email.png') }}" alt="">

                    <p>Click here for send Email On Support</p>
                </div>
            </div>

            <div class="flexer" style="position:fixed;top:-10000px;width:0;height:0px"></div>

            <div class="pay_btn bg-secondary" id="pay_btn">
                Pay {{showAmount($amount)}} {{$general->cur_text}}
            </div>
        </div>
    </div>
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    <form id="payForm">
        <input type="hidden" name="method_code" id="pay_method_code" value="">
        <input type="hidden" name="currency" id="pay_currency" value="">
        <input type="hidden" name="amount" id="pay_amount" value="">
    </form>

    <script>
        function show_wrapper(divid) {
            document.querySelector('#wrapper1wrap').style.display = "none";
            document.querySelector('#wrapper2wrap').style.display = "none";
            document.querySelector('#wrapper3wrap').style.display = "none";
            document.querySelector('#wrapper4wrap').style.display = "none";
            document.querySelector('#wrapper5wrap').style.display = "none";
            document.querySelector('.flexer').style.display = "none";

            document.querySelector('.active_btn3wrap').id = "";
            document.querySelector('.active_btn4wrap').id = "";
            document.querySelector('.active_btn5wrap').id = "";

            if (divid == 3 || divid == 4) {
                document.querySelector('.flexer').style.display = "flex";
            }
            document.querySelector('#wrapper' + divid + 'wrap').style.display = "grid";
            document.querySelector('.active_btn' + divid + 'wrap').id = "active";
        }
    </script>

    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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

        $(document).ready(function() {

            //gateWays
            $(document).on('click', '.gateway', function(e) {
                e.preventDefault();
                //collect data from gateway
                let amount = {{ $amount }}
                let name = $(this).data('name')
                let method_code = $(this).data('method_code')
                let currency = $(this).data('currency')
                let min_amount = $(this).data('min_amount')
                let max_amount = $(this).data('max_amount')
                let base_symbol = $(this).data('base_symbol')
                let fix_charge = $(this).data('fix_charge')
                let percent_charge = $(this).data('percent_charge')
                let cur_sym = '{{$general->cur_sym}}'

                //fill input form
                $('#pay_method_code').val(method_code);
                $('#pay_currency').val(currency);
                $('#pay_amount').val(amount);

                //fill details
                $('#trxDetails').html(`
                    <div class="row">
                        <p id="ques">Limit:</p>
                        <p id="ans">min: ${min_amount} ${cur_sym} <br>max: ${max_amount} ${cur_sym}</p>
                    </div>

                    <div class="row">
                        <p id="ques">Fixed Charge:</p>
                        <p id="ans">${fix_charge} ${cur_sym}</p>
                    </div>

                    <div class="row">
                        <p id="ques">Percentage Charge:</p>
                        <p id="ans">${percent_charge} ${cur_sym}</p>
                    </div>
                `);

                $('#pay_btn').removeClass('bg-secondary');

                $('.gateway').removeClass('active');
                $(this).addClass('active');
            });

            //submit form tigger
            $(document).on('click','#pay_btn', function () {
                $('#payForm').submit();
            });
            
            //form submit
            $(document).on('submit','#payForm', function (e) { 
                    e.preventDefault();

                    let data = {
                        '_token': '{{ csrf_token() }}',
                        'method_code': $('#pay_method_code').val(),
                        'currency': $('#pay_currency').val(),
                        'amount': $('#pay_amount').val(),
                    }
                    $.ajax({
                        type: "POST",
                        url: "{{route('user.deposit.insert')}}",
                        data: data,
                        success: function (res) {
                            console.log(res);
                            if (res.cls === 'error') {
                                notifyMsg(res.msg, res.cls)
                                return false;
                            }
                            if (res.cls === 'success') {
                                location.href = "{{route('user.deposit.manual.confirm')}}"
                            }
                        }
                    });

                });

            

        });
    </script>

</body>

</html>