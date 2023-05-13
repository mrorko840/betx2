<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="depositModalLabel">Deposit Money</h5>
                <a href="javascript:void(0)" class="btn btn-danger btn-30 neo-shadow btn-link" id="closeDepositModal">
                    <span class="material-icons las la-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        @foreach ($DandW as $dw)
                            <div class="col-3 px-2 py-1 text-center">
                                <button type="button" class="btn btn-sm btn-info neo-shadow w-100 h-100 depositPreset" value="{{@$dw}}">
                                    {{@$dw}} {{@$general->cur_text}}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form id="customDepositForm" action="{{route('user.deposit.custom')}}" method="get">
                    <div class="row">
                        <div class="col pr-0">
                                <div class="form-group float-label mb-3">
                                <input type="number" class="form-control" name="amount" id="deposit_amount">
                                <label class="form-control-label " for="deposit_amount"><i class="las la-wallet"></i> Amount</label>
                            </div>
                        </div>
                        <div class="col-auto pl-0">
                            <span class="input-group-text mt-3" id="basic-addon2">{{$general->cur_text}}</span>
                        </div>
                    </div>

                    <div class="mb-1">
                        <button type="submit" class="btn btn-warning neo-shadow w-100 border-custom depositNextBtn">Next Step</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).on('click', '.depositPreset', function (e) {
            e.preventDefault();
            let dw = $(this).val()
            console.log(dw);
            $('.depositPreset').removeClass('btn-danger');
            $(this).addClass('btn-danger');
            $('#deposit_amount').focus().val(dw);

        });
        
        $(document).on('input', '#deposit_amount', function (e) {
            e.preventDefault();
            $('.depositPreset').removeClass('btn-danger');
        });


        $(document).on('click', '.OpenDepositModal', function (e) {
            e.preventDefault();
            $('#depositModal').modal('show');
            $('#deposit_amount').val('');
            $('.depositPreset').removeClass('btn-danger');
        });
        $(document).on('click', '#closeDepositModal', function (e) {
            e.preventDefault();
            $('#depositModal').modal('hide');
        });

        $(document).on('submit','#customDepositForm',function (e) { 
            e.preventDefault();
            $('.depositNextBtn').html('Processing...');
            let amount = $('#deposit_amount').val();

            if (amount == '') {
                notifyMsg('Amount field is required!', 'warning')
                $('#deposit_amount').focus();
                $('.depositNextBtn').html('Next Step');
            }else{
                if (amount == 0) {
                    notifyMsg('Amount must be greater than 0 (ZERO)!', 'warning')
                    $('#deposit_amount').focus();
                    $('.depositNextBtn').html('Next Step');
                } else {
                    setTimeout(() => {
                        location.href = "{{route('user.deposit.custom')}}?amount="+amount;
                    }, 700);
                }
            }
        });

    </script>
@endpush