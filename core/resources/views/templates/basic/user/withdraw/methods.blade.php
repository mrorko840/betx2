@extends($activeTemplate.'layouts.frontend')

@section('content')
<!-- App Capsule -->
<div id="appCapsule">

    <div class="bg-primary container pt-4 pb-3 mb-2">
        <div class="row">

            
            <div class="col-7 pt-1 ps-2">
                <h5 class="text-light"></h5>
                <h2 class="text-light">Withdraw</h2>
                <h6 class="text-light">You can <b> Withdraw</b> your</h6>
                <h6 class="text-light">earnings.</h6>
            </div>

            <div align="center" class="col-5"><img width="90px" src="https://i.ibb.co/9W8RJsF/2-C3-C64-AE-9627-4024-83-DB-3063-C3-A786-DE-1.png" /></div>

        </div>

    </div>
    
            <div class="container">
                
                <div class="col-md-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif
                </div>

                @foreach($withdrawMethod as $data)
                <div class="border-0 mb-4 bg-warning text-white rounded">
                    <div class="p-1">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-40 border-0 bg-white-light rounded-circle text-white">
                                    <ion-icon style="font-size: 20px;" class="align-middle" name="card-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="col-6 pl-0">
                                <p class="mb-1 text-white">Withdraw Money</p>
                                <h6 class="text-white">with {{$data->name}}</h6>
                            </div>
                            <div align="right" class="col right">
                                <img class="bg-white rounded-circle shadow" src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image)}}" width="50px" alt="deposit">
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
                                    
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#withdrawModal" class="cmn--btn text-center withdraw btn btn-light shadow w-100" 
                                        data-id="{{$data->id}}"
                                        data-resource="{{$data}}"
                                        data-min_amount="{{showAmount($data->min_limit)}}"
                                        data-max_amount="{{showAmount($data->max_limit)}}"
                                        data-delay="{{$data->delay}}"
                                        data-fix_charge="{{showAmount($data->fixed_charge)}}"
                                        data-percent_charge="{{showAmount($data->percent_charge)}}"
                                        data-base_symbol="{{__($general->cur_text)}}">
                                        @lang('Withdraw')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
</div>
    
    

    
    
    
    
    
    <!--<div class="col-md-12 mb-30">-->
    <!--    @if ($errors->any())-->
    <!--        @foreach ($errors->all() as $error)-->
    <!--            <div>{{$error}}</div>-->
    <!--        @endforeach-->
    <!--    @endif-->
    <!--</div>-->

    <!--<div class="container">-->
    <!--    @foreach($withdrawMethod as $data)-->
    <!--    <div class="credit-card bg-primary">-->

    <!--        <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image)}}" alt="{{$data->name}}" width="80px" class="logo" />-->
            
    <!--        <div class="numbers">{{__($data->name)}}</div>-->
            
    <!--        <div style="z-index: 9" class="row align-items-end  pt-2 pb-1">-->
                                                
    <!--            <div align="left" class="col-7"><h6 class="text-light">@lang('Limit')-->
    <!--                : {{showAmount($data->min_limit)}}-->
    <!--                - {{showAmount($data->max_limit)}} {{$general->cur_text}}</h6>-->
    <!--            </div>-->
                    
                <!--<div align="right" class="col-5 align-bottom">-->
                <!--    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#withdrawModal" class="btn--sm cmn--btn text-center withdraw btn-warning" data-id="{{$data->id}}"-->
                <!--                    data-resource="{{$data}}"-->
                <!--                    data-min_amount="{{showAmount($data->min_limit)}}"-->
                <!--                    data-max_amount="{{showAmount($data->max_limit)}}"-->
                <!--                    data-delay="{{$data->delay}}"-->
                <!--                    data-fix_charge="{{showAmount($data->fixed_charge)}}"-->
                <!--                    data-percent_charge="{{showAmount($data->percent_charge)}}"-->
                <!--                    data-base_symbol="{{__($general->cur_text)}}">-->
                <!--                    @lang('Withdraw')-->
                <!--                </a>-->
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
                    @foreach($withdrawMethod as $data)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="payment-card">
                                <h5 class="title">{{__($data->name)}}</h5>
                                <div class="payment-card__thumb my-3">
                                    <img src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image,imagePath()['withdraw']['method']['size'])}}" alt="payment">
                                </div>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#withdrawModal" class="btn--sm d-block cmn--btn text-center withdraw" data-id="{{$data->id}}"
                                    data-resource="{{$data}}"
                                    data-min_amount="{{showAmount($data->min_limit)}}"
                                    data-max_amount="{{showAmount($data->max_limit)}}"
                                    data-delay="{{$data->delay}}"
                                    data-fix_charge="{{showAmount($data->fixed_charge)}}"
                                    data-percent_charge="{{showAmount($data->percent_charge)}}"
                                    data-base_symbol="{{__($general->cur_text)}}">
                                    @lang('Withdraw Now')
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
--}}



    <!-- Modal -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title method-name text-white" id="withdrawModalLabel">@lang('Withdraw')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <form action="{{route('user.withdraw.money')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <p class="text-dark withdrawLimit"></p>
                        <p class="text-danger withdrawCharge"></p>
                        <p class="text-white">
                            Withdrawal will arrive within 5 Minutes due to busy schedule 
You have not bound a wallet address , please bind a wallet address for withdrawal.
                        </p>
                        <!--<p class="text-info delay"></p>-->

                        <div class="form-group">
                            <input type="hidden" name="currency"  class="edit-currency form-control">
                            <input type="hidden" name="method_code" class="edit-method-code  form-control">
                        </div>



                        <div class="form-group">
                            <label>@lang('Enter Amount'):</label>
                            <div class="input-group">
                                <input id="amount" type="text" class="form-control" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount" placeholder="0.00" required=""  value="{{old('amount')}}">

                                <div class="input-group-prepend">
                                    <span class="input-group-text addon-bg currency-addon bg-info rounded-end px-2">{{__($general->cur_text)}}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row-12 modal-footer">
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>--}}
                        <button type="submit" class="col-12 btn btn-success">@lang('Confirm')</button>
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
            $('.withdraw').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');
                var delay = $(this).data('delay');

                var withdrawLimit = `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{__($general->cur_text)}}`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge = `@lang('Charge'): ${fixCharge} {{__($general->cur_text)}} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.delay').text('@lang('Processing Time'): ' + delay);

                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>

@endpush

