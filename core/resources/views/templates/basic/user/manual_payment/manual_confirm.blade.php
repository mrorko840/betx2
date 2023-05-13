<!DOCTYPE html>

<html>

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B19X2YFQ69"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-B19X2YFQ69');
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $general->sitename(__(@$pageTitle)) }}</title>

    <link rel="stylesheet" href="{{asset('assets/templates/basic/custom_payment/css/style2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/templates/basic/custom_payment/css/style2.css')}}">
    <link rel="icon" href="{{asset('assets/images/logoIcon/favicon.png')}}" type="image/gif">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <style>
        .toast .failed_progress::before {
            background-color: #ad152c;
        }
        a{
            text-decoration: none;
            color: #{{$data->gateway->theme_color}};
        }
        .centerize .payment_ty .flex_info {
            border-top: 7px solid #{{$data->gateway->theme_color}};
        }
        .centerize .btn_action {
            background-color: #{{$data->gateway->theme_color}};
        }
    </style>
</head>

<body>
    <div class="toast" id="copied_tost">
        <div class="toast-content">
            <i class="fas fa-solid fa-exchange check"></i>

            <div class="message">
                <span class="text text-1" id="popup_title"></span>
                <span class="text text-2" id="popup_des"></span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close" id="copied_close"></i>

        <div class="progress" id="copied_progress"></div>
    </div>

    <div class="centerize" style="max-width: 450px">
        <div class="payment_ty">
            <img src="{{asset('assets/images/gateway/' . $data->gateway->image)}}" alt="" id="acc">

            <div class="flex_info">
                <img src="{{asset('assets/images/logoIcon/favicon.png')}}" alt="">

                <div class="info">
                    <h3>{{ $general->sitename }}</h3>
                    <p id="trans">TRXID: {{$data->trx}}</p>
                </div>

                <h3 id="am">{{$data->gateway->cur_sym .' '. showAmount($data['final_amo']) }}</h3>
            </div>
        </div>

        <div class="input_step_confirm" 
            @if (@$data->gateway->theme_color)
                style="background-color:#{{$data->gateway->theme_color}}"
            @else
                style="background-color:#c90008"
            @endif
            >
            <ul class="all_step">
                <li class="li_row">
                    <p>{{$data->gateway->dial_code}} ডায়াল করে আপনার {{strtoupper($data->gateway->name)}} মোবাইল মেনুতে যান অথবা {{strtoupper($data->gateway->name)}} অ্যাপে যান।</p>
                </li>
                <hr>
                <li class="li_row">
                    <p>
                        <span class="marked_text">@if($data->gateway->number_type == 'personal') "Send Money" @elseif($data->gateway->number_type == 'agent') "Cash Out" @endif</span> -এ ক্লিক করুন।
                    </p>
                </li>
                <hr>
                <li class="li_row">
                    <p>
                        এই নম্বরটি প্রাপক নম্বর হিসেবে লিখুনঃ
                        <span class="marked_text">{{$data->gateway->phone_number}}</span>
                        <a href="{{$data->gateway->phone_number}}" onclick="copyURI(event)" id='reply_copy'> <i class="las la-copy"></i> Copy</a>
                    </p>
                </li>
                <hr>
                <li class="li_row">
                    <p>
                        টাকার পরিমাণঃ <span class="marked_text">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }}</span>
                    </p>
                </li>
                <hr>
                <li class="li_row">
                    <p>
                        নিশ্চিত করতে এখন আপনার {{strtoupper($data->gateway->name)}} পিন লিখুন।
                    </p>
                </li>
            </ul>

            <form class="row mt-4" id="depositUpdateForm" action="{{ route('user.deposit.manual.update') }}" method="POST">
                @csrf
                <p id="titless">নিচে আপনার ট্রান্সজেকশন আইডি দিন</p>
                <div id="flexs">
                    <input type="text" placeholder="ট্রান্সজেকশন আইডি দিন" name="transaction_id" id="transaction_id" autocomplete="off" maxlength="10" required>
                </div>
            </form>
        </div>


        <div class="btn_action">
            <button onclick="history.back()">CANCEL</button>
            <button id="submit_done">CONFIRM</button>
        </div>

        <div class="footer_text">
            HelpLine - <a href="#"> <i class="lab la-telegram"></i> Telegram</a> 
        </div>
    </div>

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

        function copyURI(evt) {
            evt.preventDefault();
            navigator.clipboard.writeText(evt.target.getAttribute('href')).then(() => {
                /* clipboard successfully set */

                document.querySelector("#reply_copy").innerHTML = '<i class="las la-clipboard"></i> Copied';
                setTimeout(() => {
                    document.querySelector("#reply_copy").innerHTML = '<i class="las la-copy"></i> Copy';
                }, 900);
            }, () => {
                /* clipboard write failed */
            });
        }

        //submit form
        $(document).on('click', '#submit_done', function () {
            $('#submit_done').html('Loading...');
            $('#depositUpdateForm').submit();
        });

        $(document).on('submit', '#depositUpdateForm', function (e) {
            e.preventDefault();
            let data = {
                '_token': '{{ csrf_token() }}',
                'transaction_id': $('#transaction_id').val(),
            }
            $.ajax({
                type: "POST",
                url: "{{ route('user.deposit.manual.update') }}",
                data: data,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg, res.cls)
                    $('#submit_done').html('Submited');
                    setTimeout(() => {
                        location.href = "{{route('home')}}"
                    }, 2300);
                },
                error: function (err) {
                    let errors = err.responseJSON.errors
                    let trx_msg = errors['transaction_id'][0]
                    notifyMsg(trx_msg, 'error');
                    $('#submit_done').html('Confirm');
                }
            });
            
        });
    </script>

</body>

</html>