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
                                    <button id="filter" class="btn btn-warning border-custom neo-shadow w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div id="existSearch">
                @forelse ($withdraws as $data)
                    <div class="container">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 rounded">
                                            <div class="background" style="width: 50px; background-size: contain !important;">
                                                @if (@$data->method->image)
                                                    <img src="{{ asset('assets/images/withdraw/method/'. @$data->method->image) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">Withdraw with {{ __(@$data->method->name) }}</h6>
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
                                            data-admin_feedback="{{ $data->admin_feedback ? $data->admin_feedback : 'Wait for Admin response!'  }}"
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
     
            
                       
                    
                               @forelse($withdraws as $k=>$data)
                    <div class="card table-card mt-2 pt-1">
                        <div class="card-body p-o">
                            <div class="table-responsive--sm">
                                   
                                       
                                <div class="row">

                                    <div align="left" class="col-6"><h4>Withdrawal</h4></div>
                                    <div align="right" class="col-6"> <h3 class="text-danger">{{showAmount($data->final_amount)}} {{$data->currency}}</h3></div>
                                    
                                </div>
                                       
                                       
                                <div class="row">
                                          
                                        <div align="left" class="col-6"><h5>{{date('d M, Y ', strtotime($data->created_at))}}</h5></div>
                                       
                                       
                                       <div align="right" class="col-6">
                                           <h5>
                                                @if($data->status == 2)
                                                    <span class="badge badge--warning">@lang('Pending')</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge badge--success">@lang('Completed')</span>
                                                    <a href="javascript:void(0)" class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                                @elseif($data->status == 3)
                                                    <span class="badge badge--danger">@lang('Rejected')</span>
                                                    <a class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                                @endif
                                            </h5>
                                       </div>
                                       
                                       <div class="row">
                                                
                                            <div align="left" class="col-6"><h5>Trx :</h5></div>
                                            
                                            <div align="right" class="col-6">
                                                <h5>{{$data->trx}}</h5>
                                            </div>
                                        </div>
                                        
                                </div>  
                            </div>
                        </div>
                    </div>        
                                       
                                       
                                   
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">@lang('Data not found')</td>
                            </tr>
                            @endforelse
                         
                   
         
   </div>
</section> --}}

    
    {{--
    <section class="dashboard-section bg--section pt-120">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-4">
                    <a href="{{route('user.withdraw')}}" class="cmn--btn btn--sm">@lang('Withdraw Now')</a>
                </div>
                <div class="table-responsive">
                    <table class="table cmn--table">
                        <thead>
                            <tr>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Gateway')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('After Charge')</th>
                                <th>@lang('Rate')</th>
                                <th>@lang('Receivable')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdraws as $k=>$data)
                                <tr>
                                    <td data-label="#@lang('Transaction ID')">{{$data->trx}}</td>
                                    <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                                    <td data-label="@lang('Amount')">
                                        <strong>{{showAmount($data->amount)}} {{__($general->cur_text)}}</strong>
                                    </td>
                                    <td data-label="@lang('Charge')" class="text-danger">
                                        {{showAmount($data->charge)}} {{__($general->cur_text)}}
                                    </td>
                                    <td data-label="@lang('After Charge')">
                                        {{showAmount($data->after_charge)}} {{__($general->cur_text)}}
                                    </td>
                                    <td data-label="@lang('Rate')">
                                        {{showAmount($data->rate)}} {{__($data->currency)}}
                                    </td>
                                    <td data-label="@lang('Receivable')" class="text-success">
                                        <strong class="text--base">{{showAmount($data->final_amount)}} {{__($data->currency)}}</strong>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($data->status == 2)
                                            <span class="badge badge--warning">@lang('Pending')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge--success">@lang('Completed')</span>
                                            <a href="javascript:void(0)" class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                        @elseif($data->status == 3)
                                            <span class="badge badge--danger">@lang('Rejected')</span>
                                            <a class="badge badge--info approveBtn" data-admin_feedback="{{$data->admin_feedback}}"><i class="fa fa-info"></i></a>
                                        @endif

                                    </td>
                                    <td data-label="@lang('Time')">
                                        <i class="fa fa-calendar text--base"></i> {{showDateTime($data->created_at)}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$withdraws->links()}}
                </ul>
            </div>
        </div>
    </section>
    --}}
    
    
    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade cmn--modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title m-0">@lang('Details')</h5>
                    <span data-bs-dismiss="modal"><i class="las la-times"></i></span>
                </div>
                <div class="modal-body">
                    <ul class="list-group shadow rounded">
                        <li class="list-group-item bg-warning">@lang('Amount') : <span class="withdraw-amount "></span></li>
                        <li class="list-group-item bg-info">@lang('Charge') : <span class="withdraw-charge "></span></li>
                        <li class="list-group-item bg-warning">@lang('After Charge') : <span class="withdraw-after_charge"></span></li>
                        <li class="list-group-item bg-info">@lang('Conversion Rate') : <span class="withdraw-rate"></span></li>
                        <li class="list-group-item bg-warning">@lang('Payable Amount') : <span class="withdraw-payable"></span></li>
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
                <div class="modal-header py-2">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span data-bs-dismiss="modal">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        // $(document).on('keyup', '#search', function (e) {
        //     e.preventDefault();
        //     let search = $(this).val()

        //     $.ajax({
        //         type: "GET",
        //         url: "{{route('user.withdraw.history')}}?search="+search,
        //         success: function (res) {
        //             $('#existSearch').load(location.href+" #existSearch");
        //         }
        //     });
        // });



        (function($){
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
