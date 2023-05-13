@extends($activeTemplate.'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="p-1 w-100">
                                    <label>Transaction Number</label>
                                    <input class="form-control" name="search" id="search" type="text" value="{{ request()->search }}">
                                </div>
                                <div class="flex-grow-1 align-self-end p-1">
                                    <button class="btn btn-warning border-custom neo-shadow w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div id="existSearch">
                @forelse ($logs as $data)
                    <div class="container">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 rounded">
                                            <div class="background" style="width: 50px; background-size: contain !important;">
                                                @if (@$data->gateway->image)
                                                    <img src="{{ asset('assets/images/gateway/'. @$data->gateway->image) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">Deposit via {{ __(@$data->gateway->name) }}</h6>
                                        <p class="small text-secondary">{{ showDateTime($data->created_at, 'd-m-Y') }} |
                                            {{ diffForHumans($data->created_at) }}
                                            <br>
                                            Trx: <b class="text-info">{{ $data->trx }}</b>
                                        </p>
                                    </div>
                
                                    <div class="col-auto text-right">
                                        <h6 class="text-success mb-0">
                                            {{ __($general->cur_sym) }} {{ getAmount($data->amount) }}
                                        </h6>
                                        @php
                                            $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                        @endphp

                                        <p style="cursor: pointer;" class="approveBtn"
                                            data-info="{{ $details }}"
                                            data-id="{{ $data->id }}"
                                            data-amount="{{ showAmount($data->amount)}} {{ __($general->cur_text) }}"
                                            data-charge="{{ showAmount($data->charge)}} {{ __($general->cur_text) }}"
                                            data-after_charge="{{ showAmount($data->amount + $data->charge)}} {{ __($general->cur_text) }}"
                                            data-rate="{{ showAmount($data->rate)}} {{ __($data->method_currency) }}"
                                            data-payable="{{ showAmount($data->final_amo)}} {{ __($data->method_currency) }}">
                                            
                                            @if($data->status == 1)
                                                <span class="badge border-custom badge-success">@lang('Complete')</span>
                                            @elseif($data->status == 2)
                                                <span class="badge border-custom badge-warning">@lang('Pending')</span>
                                            @elseif($data->status == 3)
                                                <span class="badge border-custom badge-danger">@lang('Cancel')
                                            @endif
                                        </p>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-danger">{{__($emptyMessage)}}</div>
                @endforelse
            </div>

        </div>

    </main>

</body>

    
    {{-- <section class="cmn-section">
        <div class="container">
            
                                    @if(count($logs) >0)
                                        @foreach($logs as $k=>$data)
                                        
                    <div class="card table-card mt-2 pt-1">
                        <div class="card-body p-o">
                            <div class="table-responsive--sm">
                                
                                            <div class="row">   
                                                <div align="left" class="col-6"><h4>Deposit</h4></div>
                                                
                                                <div align="right" class="col-6"> <h3 class="text-danger">{{showAmount($data->amount)}} {{$general->cur_text}}</h3></div>
                                            </div>   
                                                
                                                
                                            <div class="row">
                                                    
                                                <div align="left" class="col-6"><h5>{{date(' d M, Y ', strtotime($data->created_at))}}</h5></div>
                                                
                                                
                                                <div align="right" class="col-6"><h5>
                                                    @if($data->status == 1)
                                                        <span class="badge badge-success">@lang('Complete')</span>
                                                    @elseif($data->status == 2)
                                                        <span class="badge badge-warning">@lang('Pending')</span>
                                                    @elseif($data->status == 3)
                                                        <span class="badge badge-danger">@lang('Cancel')
                                                    @endif
                                                    </h5>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                    
                                                <div align="left" class="col-6"><h5>Trx : {{$data->trx}}</h5></div>
                                                
                                                @php
                                                $details = ($data->detail != null) ? json_encode($data->detail) : null;
                                                @endphp
                                                
                                                <div align="right" class="col-6">
                                                    <h5>More: 
                                                        <a href="javascript:void(0)" class="badge badge--success approveBtn"
                                                        data-info="{{ $details }}"
                                                        data-id="{{ $data->id }}"
                                                        data-amount="{{ showAmount($data->amount)}} {{ __($general->cur_text) }}"
                                                        data-charge="{{ showAmount($data->charge)}} {{ __($general->cur_text) }}"
                                                        data-after_charge="{{ showAmount($data->amount + $data->charge)}} {{ __($general->cur_text) }}"
                                                        data-rate="{{ showAmount($data->rate)}} {{ __($data->method_currency) }}"
                                                        data-payable="{{ showAmount($data->final_amo)}} {{ __($data->method_currency) }}">
                                                    <i class="fa fa-desktop"></i>
                                                </a>
                                                    </h5>
                                                </div>
                                            </div>
            
                                                
                            </div>
                        </div>
                    </div>
                                            
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" class="text-center"> @lang('No results found')!</td>
                                        </tr>
                                    @endif
                                    
                            
                            </div>
                        </div>
                    </div>

        </div>
    </section> --}}

    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title m-0">@lang('Details')</h5>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <ul class="list-group shadow-sm rounded">
                        <li class="list-group-item">@lang('Amount') : <span class="withdraw-amount "></span></li>
                        <li class="list-group-item">@lang('Charge') : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item">@lang('After Charge') : <span class="withdraw-after_charge"></span></li>
                        <li class="list-group-item">@lang('Conversion Rate') : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item">@lang('Payable Amount') : <span class="withdraw-payable"></span></li>
                    </ul>
                    <ul class="list-group withdraw-detail mt-1">
                    </ul>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0">@lang('Details')</h6>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <div class="withdraw-detail">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-charge').text($(this).data('charge'));
                modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
                modal.find('.withdraw-rate').text($(this).data('rate'));
                modal.find('.withdraw-payable').text($(this).data('payable'));
                var list = [];
                var details =  Object.entries($(this).data('info'));

                var ImgPath = "{{asset(imagePath()['verify']['deposit']['path'])}}/";
                var singleInfo = '';
                for (var i = 0; i < details.length; i++) {
                    if (details[i][1].type == 'file') {
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="@lang('Image')" class="w-100">
                                        </li>`;
                    }else{
                        singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <textarea class="form-control shadow-sm text-warning" rows="2">${details[i][1].field_name}</textarea>
                                        </li>`;
                    }
                }

                if (singleInfo)
                {
                    modal.find('.withdraw-detail').html(`<br><strong class="my-3">@lang('Payment Information')</strong>  ${singleInfo}`);
                }else{
                    modal.find('.withdraw-detail').html(`${singleInfo}`);
                }
                modal.modal('show');
            });

            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

