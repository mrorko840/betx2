<div class="modal fade" id="WithdrawModal" tabindex="-1" aria-labelledby="WithdrawModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="WithdrawModalLabel">Withdraw Money</h5>
                <a href="javascript:void(0)" class="btn btn-danger btn-30 neo-shadow btn-link" id="closeWithdrawModal">
                    <span class="material-icons las la-times"></span>
                </a>
            </div>
            
            <div class="modal-body">
                <div id="modalBody">
                    <div class="container">
                        <div class="row">
                            @foreach ($DandW as $dw)
                                <div class="col-3 px-2 py-1 text-center">
                                    <button type="button" class="btn btn-sm btn-info neo-shadow w-100 h-100 withdrawPreset" value="{{@$dw}}">
                                        {{@$dw}} {{@$general->cur_text}}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <form id="customWithdrawForm" action="{{route('user.withdraw.money')}}" method="POST">
                        @csrf
                        <input type="hidden" name="currency" id="withdraw_cur"  class="edit-currency form-control">
                        <input type="hidden" name="method_code" id="withdraw_method_code" class="edit-method-code  form-control">

                        <div class="row">
                            <div class="col pr-0">
                                <div class="form-group float-label mb-3">
                                    <input type="number" class="form-control" name="amount" id="withdraw_amount">
                                    <label class="form-control-label " for="withdraw_amount"><i class="las la-wallet"></i> Amount</label>
                                </div>
                            </div>
                            <div class="col-auto pl-0">
                                <span class="input-group-text mt-3" id="basic-addon2">{{$general->cur_text}}</span>
                            </div>
                        </div>

                        <div class="mb-2 withdrawDetails d-none">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Limit:
                                  <span class="badge badge-primary badge-pill withdraw_limit">min: 5.00, max: 500.00</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Charge:
                                  <span class="badge badge-danger badge-pill withdraw_charge">2.00 USDT</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  Processing Time
                                  <span class="badge badge-warning badge-pill withdraw_time">30min</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="container">
                            <div class="row mb-3">
                                @foreach ($withdrawMethod as $data)
                                    <div class="col-4 px-2 py-1">
                                        <div class="gatewayItem text-center"
                                            data-id="{{$data->id}}"
                                            data-resource="{{$data}}"
                                            data-min_amount="{{showAmount($data->min_limit)}}"
                                            data-max_amount="{{showAmount($data->max_limit)}}"
                                            data-delay="{{$data->delay}}"
                                            data-fix_charge="{{showAmount($data->fixed_charge)}}"
                                            data-percent_charge="{{showAmount($data->percent_charge)}}"
                                            data-base_symbol="{{__($general->cur_text)}}"
                                        >
                                            <img class="w-100 p-2" src="{{asset('assets/images/withdraw/method/' . $data->image)}}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="mb-1">
                            <button type="submit" class="btn btn-warning btn-sm w-100 border-custom neo-shadow withdrawNextBtn">Next Step</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        //withdraw Details Function
        const withdrawDetailsShow = (amount) => {
            if(amount!='' && $('.gatewayItem').hasClass('gatewayActive')){
                $('.withdrawDetails').removeClass('d-none');
            }else{
                $('.withdrawDetails').addClass('d-none');
            }
        }

        //withdraw preset
        $(document).on('click', '.withdrawPreset', function (e) {
            e.preventDefault();
            let dw = $(this).val()
            console.log(dw);
            $('.withdrawPreset').removeClass('btn-danger');
            $(this).addClass('btn-danger');
            $('#withdraw_amount').focus().val(dw);

            withdrawDetailsShow(dw)
        });
        
        $(document).on('keyup', '#withdraw_amount', function (e) {
            e.preventDefault();
            $('.withdrawPreset').removeClass('btn-danger');
            let amount = $(this).val();
            withdrawDetailsShow(amount)
        });

        //getway Item
        $(document).on('click', '.gatewayItem', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var result = $(this).data('resource');
            var minAmount = $(this).data('min_amount');
            var maxAmount = $(this).data('max_amount');
            var fixCharge = $(this).data('fix_charge');
            var percentCharge = $(this).data('percent_charge');
            var delay = $(this).data('delay');
            
            $('#withdraw_amount').focus();
            
            $('.withdraw_limit').html(`min: ${minAmount} {{$general->cur_sym}}, max: ${maxAmount} {{$general->cur_sym}}`);
            $('.withdraw_charge').html(`Fixed: ${fixCharge} {{$general->cur_sym}}, Percent: ${percentCharge} %`);
            $('.withdraw_time').html(delay);

            $('#withdraw_cur').val(result.currency);
            $('#withdraw_method_code').val(result.id);
            $('.gatewayItem').removeClass('gatewayActive');
            $(this).addClass('gatewayActive');

            withdrawDetailsShow($('#withdraw_amount').val())

        });
        

        //open modal
        $(document).on('click', '.OpenWithdrawModal', function (e) {
            e.preventDefault();
            $('#WithdrawModal').modal('show');
            $('#withdraw_amount').val('');
            $('.withdrawPreset').removeClass('btn-danger');
        });
        //close modal
        $(document).on('click', '#closeWithdrawModal', function (e) {
            e.preventDefault();
            $('#WithdrawModal').modal('hide');
        });

        //formSubmit
        $(document).on('submit','#customWithdrawForm',function (e) { 
            e.preventDefault();
            $('.withdrawNextBtn').html('Processing...');
            let amount = $('#withdraw_amount').val();

            let withdraw_cur = $('#withdraw_cur').val();
            let method_code = $('#withdraw_method_code').val();

            if (withdraw_cur == '' && method_code == '') {
                notifyMsg('Select any payment method!', 'warning');
                $('.withdrawNextBtn').html('Next Step');
                return false;
            }

            if (amount == '') {
                notifyMsg('Amount field is required!', 'warning')
                $('#withdraw_amount').focus();
                $('.withdrawNextBtn').html('Next Step');
                return false;
            }

            if (amount == 0) {
                notifyMsg('Amount must be greater than 0 (ZERO)!', 'warning')
                $('#withdraw_amount').focus();
                $('.withdrawNextBtn').html('Next Step');
                return false;
            }
            let formData = new FormData($('#customWithdrawForm')[0]);

            $.ajax({
                type: "POST",
                url: "{{route('user.withdraw.money')}}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.cls == 'error') {
                        $('.withdrawNextBtn').html('Next Step');
                        notifyMsg(res.msg, res.cls)
                        return false;
                    }
                    if (res.cls == 'success') {
                        $('.withdrawNextBtn').html('Next Step');

                        $('#modalBody').html(res.view);
                    }
                }
            });

            //confirmWitdraw
            $(document).on('submit', '#withdrawPreviewForm',function (e) { 
            e.preventDefault();
            $('.withdrawSubmit').html('Processing...');
            let formData = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('user.withdraw.submit') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (res) {

                    if(res.cls == 'error'){
                        notifyMsg(res.msg, res.cls)
                        $('.withdrawSubmit').html('Withdraw Now');
                        return false;
                    }
                    if(res.cls == 'success'){
                        $('.withdrawSubmit').html('Withdraw Now');
                        notifyMsg(res.msg, res.cls)
                        $('#WithdrawModal').modal('hide');
                        $('#withdrawPreviewForm')[0].reset();
                        $("#modalBody").load(location.href+" #modalBody");
                    }
                }
            });
            
        });


        });

    </script>
@endpush