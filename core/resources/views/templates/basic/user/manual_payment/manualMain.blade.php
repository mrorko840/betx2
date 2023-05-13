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



    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="message__chatbox bg-warning">
                            <div class="message__chatbox__header bg-primary">
                                <h5 class="title text-white">{{__($pageTitle)}}</h5>
                            </div>
                            <div class="message__chatbox__body">
                                <p class="text-center mt-2">@lang('You have requested') <b class="text-danger">{{ showAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                    <b class="text-danger">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                </p>
                                <h4 class="text-center mb-4">@lang('Please follow the instruction below')</h4>

                                <div class="text-center instruction">
                                    @php echo $data->gateway->description @endphp
                                </div>

                                <form class="message__chatbox__form row mt-4" action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if($method->gateway_parameter)
                                        @foreach(json_decode($method->gateway_parameter) as $k => $v)
                                            @if($v->type == "text")
                                                <div class="form--group col-sm-12">
                                                    <label for="fname" class="cmn--label">{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</label>
                                                    <input type="text" class="form-control" name="{{$k}}" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == 'required') required @endif>
                                                </div>
                                            @elseif($v->type == "textarea")
                                                <div class="form--group col-sm-12">
                                                    <label for="fname" class="cmn--label">{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</label>
                                                    <textarea class="form-control" name="{{$k}}" placeholder="{{__($v->field_level)}}" @if($v->validation == 'required') required @endif>{{old($k)}}</textarea>
                                                </div>
                                                
                                            @elseif($v->type == "file")
                                                <div class="form--group col-sm-12">
                                                    <label for="name" class="cmn--label">{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</label>
                                                </div>
                                                <div class="container">
                                                    <div class="custom-file-upload mb-2" id="fileUpload1">
                                                        <input name="{{$k}}" type="file" id="fileuploadInput3" accept="image/*" @if($v->validation == "required") required @endif>
                                                        <label for="fileuploadInput3">
                                                            <span>
                                                                <strong>
                                                                    <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                                                    <i>Upload the recipt here</i>
                                                                </strong>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            
                                                <!--<div class="form--group col-sm-12">-->
                                                <!--    <label for="name" class="cmn--label">{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</label>-->
                                                <!--    <input type="file" class="form-control" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>-->
                                                <!--</div>-->
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="form--group col-sm-12 mb-0">
                                        <button type="submit" class="cmn--btn justify-content-center w-100 btn-primary bg-primary">@lang('Pay Now')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .message__chatbox__body .instruction *{
            text-align: center !important;
            color: white !important;
            font-size: 14px;
        }
    </style>
@endpush

