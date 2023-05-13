@extends($activeTemplate.'layouts.frontend')

@section('content')



    <div class="bg-primary container pt-4 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div class="col-7 pt-1 ps-2">
                
                <h2 class="text-light">Deposit</h2>
                <h6 class="text-light">You can <b> Diposit</b> here</h6>
                <h6 class="text-light">for<b> Beting</b></h6>
            </div>

            <div align="center" class="col-5"><img width="90px" src="https://i.ibb.co/L1HScH9/5-F867-FDB-41-C9-488-D-913-C-16-FDDD5-BDFF0-1.png" /></div>

        </div>

    </div>
    
    
            <div class="container">
                
                <div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif
                </div>
                
            
                @foreach($gatewayCurrency as $data)
                <div class="border-0 mb-4 bg-warning text-white rounded">
                    <div class="p-1">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-40 border-0 bg-white-light rounded-circle text-white">
                                    <ion-icon style="font-size: 20px;" class="align-middle" name="card-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="col-6 pl-0">
                                <p class="mb-1 text-white">Add Money</p>
                                <h6 class="text-white">with {{$data->name}}</h6>
                            </div>
                            <div align="right" class="col right">
                                <img class="bg-white rounded-circle shadow" src="{{$data->methodImage()}}" width="50px" alt="deposit">
                            </div>
                        </div>
                    </div>
                    <div class="row card-body">
                        <h4 class="mb-0 mt-3 mb-3 text-white card-num">
                            <!--4654 {{ rand(3000,5000) }} {{ rand(3000,5000) }} {{ rand(3000,5000) }}-->
                        </h4>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <h6 class="mb-0 text-white">
                                    {{showAmount($data->min_amount)}} 
                                    - {{showAmount($data->max_amount)}} {{$general->cur_text}}
                                </h6>
                                <h6 class="small text-white">Limits</h6>
                            </div>
                            <div class="col-auto align-self-center text-right">
                                <p class="mb-0">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depositModal" class="cmn--btn text-center deposit btn btn-light shadow w-100" data-id="{{$data->id}}"
                                        data-name="{{$data->name}}"
                                        data-currency="{{$data->currency}}"
                                        data-method_code="{{$data->method_code}}"
                                        data-min_amount="{{showAmount($data->min_amount)}}"
                                        data-max_amount="{{showAmount($data->max_amount)}}"
                                        data-base_symbol="{{$data->baseSymbol()}}"
                                        data-fix_charge="{{showAmount($data->fixed_charge)}}"
                                        data-percent_charge="{{showAmount($data->percent_charge)}}">
                                        @lang('Deposit')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    
    
<!--<section class="cmn-section">-->
<!--    <div class="container">-->
        
<!--            <div class="col-md-12">-->
<!--                @if ($errors->any())-->
<!--                    @foreach ($errors->all() as $error)-->
<!--                        <div>{{$error}}</div>-->
<!--                    @endforeach-->
<!--                @endif-->
<!--            </div>-->


<!--            @foreach($gatewayCurrency as $data)-->
<!--                <div class="container bg-img-deposit mb-2 pb-2">-->
                            
                            
<!--                            <div class="row align-items-start pb-2 pt-1"> -->
                   
<!--                                    <div align="left" class="col-4"><img src="{{$data->methodImage()}}" alt="{{$data->name}}"width="80px"></div>-->
                                
<!--                                    <div align="right" class="col-8"><h3 class="text-light"><b>-->
<!--                                            {{__($data->name)}}</b></h3></div>-->
                                            
<!--                            </div>-->
                                            
                         
                        
                    
<!--                        <div class="row align-items-end  pt-2 pb-1">-->
                            
                            
<!--                                        <div align="left" class="col-8"><h6 class="text-light">@lang('Limit')-->
<!--                                            : {{showAmount($data->min_amount)}}-->
<!--                                            - {{showAmount($data->max_amount)}} {{$general->cur_text}}</h6>-->
<!--                                        </div>-->
                                        
<!--                                        <div align="right" class="col-4 align-bottom">-->
<!--                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depositModal" class="btn btn-primary cmn--btn text-center deposit" data-id="{{$data->id}}"-->
<!--                                                data-name="{{$data->name}}"-->
<!--                                                data-currency="{{$data->currency}}"-->
<!--                                                data-method_code="{{$data->method_code}}"-->
<!--                                                data-min_amount="{{showAmount($data->min_amount)}}"-->
<!--                                                data-max_amount="{{showAmount($data->max_amount)}}"-->
<!--                                                data-base_symbol="{{$data->baseSymbol()}}"-->
<!--                                                data-fix_charge="{{showAmount($data->fixed_charge)}}"-->
<!--                                                data-percent_charge="{{showAmount($data->percent_charge)}}">-->
<!--                                                @lang('Deposit')-->
<!--                                            </a>-->
<!--                                        </div>-->
                                            
                                            

                                    
<!--                        </div> -->
<!--                </div>-->
                
<!--            @endforeach-->


        
<!--    </div>-->
<!--</section>-->
    
    
    
    
    
    
    
    
    


    <!--<div class="col-md-12">-->
    <!--    @if ($errors->any())-->
    <!--        @foreach ($errors->all() as $error)-->
    <!--            <div>{{$error}}</div>-->
    <!--        @endforeach-->
    <!--    @endif-->
    <!--</div>-->

    <!--<div class="container">-->
    <!--    @foreach($gatewayCurrency as $data)-->
    <!--    <div class="credit-card bg-primary">-->

    <!--        <img src="{{$data->methodImage()}}" alt="{{$data->name}}"width="80px" align="right" class="logo">-->
            
    <!--        <div class="numbers">{{__($data->name)}}</div>-->
            
    <!--        <div style="z-index: 9" class="row align-items-end  pt-2 pb-1">-->
                                                
    <!--            <div align="left" class="col-6"><h6 class="text-light">@lang('Limit')-->
    <!--                : {{showAmount($data->min_amount)}}-->
    <!--                - {{showAmount($data->max_amount)}} {{$general->cur_text}}</h6>-->
    <!--            </div>-->
                    
                <!--<div align="right" class="col-6 align-bottom">-->
                <!--    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depositModal" class="btn btn-warning cmn--btn text-center deposit" data-id="{{$data->id}}"-->
                <!--        data-name="{{$data->name}}"-->
                <!--        data-currency="{{$data->currency}}"-->
                <!--        data-method_code="{{$data->method_code}}"-->
                <!--        data-min_amount="{{showAmount($data->min_amount)}}"-->
                <!--        data-max_amount="{{showAmount($data->max_amount)}}"-->
                <!--        data-base_symbol="{{$data->baseSymbol()}}"-->
                <!--        data-fix_charge="{{showAmount($data->fixed_charge)}}"-->
                <!--        data-percent_charge="{{showAmount($data->percent_charge)}}">-->
                <!--        @lang('Deposit')-->
                <!--    </a>-->
                <!--</div>-->
    <!--        </div> -->
    <!--    </div>-->
    <!--    @endforeach-->
    <!--</div>-->
    
    
    
    
    
    
    
    
    
    {{--
    
    <section class="dashboard-section bg--section pt-120">
        <div class="container">
            <div class="pb-120">
                <div class="row g-4 justify-content-center">
                    @foreach($gatewayCurrency as $data)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="payment-card">
                                <h6 class="title">{{__($data->name)}}</h6>
                                <div class="payment-card__thumb my-3">
                                    <img src="{{$data->methodImage()}}" alt="payment">
                                </div>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depositModal" class="btn--sm d-block cmn--btn text-center deposit" data-id="{{$data->id}}"
                                    data-name="{{$data->name}}"
                                    data-currency="{{$data->currency}}"
                                    data-method_code="{{$data->method_code}}"
                                    data-min_amount="{{showAmount($data->min_amount)}}"
                                    data-max_amount="{{showAmount($data->max_amount)}}"
                                    data-base_symbol="{{$data->baseSymbol()}}"
                                    data-fix_charge="{{showAmount($data->fixed_charge)}}"
                                    data-percent_charge="{{showAmount($data->percent_charge)}}">
                                    @lang('Deposit Now')
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    --}}

    <div class="modal fade cmn-modal" id="depositModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header bg-primary">
                    <strong class="modal-title method-name" id="depositModalLabel"></strong>
                    <span  data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <form action="{{route('user.deposit.new')}}" method="post">
                    @csrf
                    <div class="modal-body pt-4 pb-3">
                        <p class="text-dark depositLimit"></p>
                        <p class="text-danger depositCharge"></p>
                        <div class="form-group">
                            <input type="hidden" name="currency" class="edit-currency">
                            <input type="hidden" name="method_code" class="edit-method-code">
                        </div>
                        <div class="form-group">
                            <label class="mb-2">@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control" name="amount" placeholder="@lang('Amount')" required  value="{{old('amount')}}">
                                <span class="input-group-text bg-info text-white rounded-end"><p class="text-info">  , , </p>{{__($general->cur_text)}}</span>
                            </div>
                        </div>
                    </div>
                    <div align="center" class="row-12 container mb-2">
                        <button align="center" type="button" class="col-6 w-100 btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                        <div align="center" class=" prevent-double-click mt-1 mb-1">
                            <button type="submit" class="col-6 w-100 btn btn-success confirm-btn">@lang('Confirm')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    
@endsection



@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.deposit').on('click', function () {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{$general->cur_text}}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });

            // $('.prevent-double-click').on('click',function(){
            //     $(this).addClass('button-none');
            //     $(this).html('<i class="fas fa-spinner fa-spin"></i> @lang('Processing')...');
            // });
        })(jQuery);
    </script>
@endpush


@push('style')
<style type="text/css">

</style>
@endpush
