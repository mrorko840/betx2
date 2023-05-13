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




<section class="cmn-section">

    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group text-center">

                            <p class="list-group-item border border-primary">
                                @lang('Amount'):
                                <strong>{{showAmount($data->amount)}} </strong> {{$general->cur_text}}
                            </p>
                            
                            <p class="list-group-item border border-danger">
                                @lang('Charge'):
                                <strong>{{showAmount($data->charge)}}</strong> {{$general->cur_text}}
                            </p>
                            
                            <p class="list-group-item border border-success">
                                @lang('Total') {{$data->baseCurrency()}}:
                                <strong>{{showAmount($data->final_amo)}}</strong>
                            </p>
                            @if($data->gateway->crypto==1)
                                <p class="list-group-item">
                                    @lang('Conversion with')
                                    <b> {{ $data->method_currency }}</b> @lang('and final value will Show on next step')
                                </p>
                            @endif
                        </ul>

                        @if($data->method_code<1000)
                        <a href="{{route('user.deposit.confirm')}}" class="btn btn-primary btn-block btn-lg mt-2 cmn-btn">@lang('Pay Now')</a>
                        @else
                        <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn-primary btn-block btn-lg mt-2 cmn-btn">@lang('Pay Now')</a>
                        @endif
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@push('style')
<style type="text/css">
    .p-prev-list img{
        max-width:100px; 
        max-height:100px; 
        margin:0 auto;
    }
</style>
@endpush

