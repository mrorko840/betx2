@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $user = Auth::user();
@endphp

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Referral Link</label>
                                    <div class="input-group">
                                        <input type="text" name="key" value="{{ route('user.refer.register',[$user->username]) }}" class="form-control" id="referralURL" readonly>
                                        <a class="input-group-text btn btn-warning cursor-pointer copytext"
                                            id="copyBoard">
                                            <i class="lar la-copy"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $segments =request()->segments();
                            $last = end($segments);
                        @endphp
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1 align-self-end p-1">
                                <a href="{{route('user.referral.commissions.deposit')}}" class="btn btn-warning neo-shadow border-custom w-100 @if(request()->routeIs('user.referral.commissions.deposit')) disabled @endif">Deposit Bonus</a>
                            </div>
                            <div class="flex-grow-1 align-self-end p-1">
                                <a href="{{route('user.referral.commissions.bet')}}" class="btn btn-warning neo-shadow border-custom w-100 @if(request()->routeIs('user.referral.commissions.bet')) disabled @endif">Bet Bonus</a>
                            </div>
                            <div class="flex-grow-1 align-self-end p-1">
                                <a href="{{route('user.referral.commissions.win')}}" class="btn btn-warning neo-shadow border-custom w-100 @if(request()->routeIs('user.referral.commissions.win')) disabled @endif">Won Bet Bonus</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="existSearch">
                <div class="container">
                    @forelse ($logs as $data)
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 rounded">
                                            <div class="background" style="width: 50px; background-size: contain !important;">
                                                @if (@$data->bywho->image)
                                                    <img src="{{ asset('assets/images/user/profile/'. @$data->bywho->image) }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">{{__($data->details)}}</h6>
                                        <p class="small text-secondary">{{ showDateTime($data->created_at, 'd-m-Y') }} | {{ diffForHumans($data->created_at) }}
                                            <br>
                                            From: <b class="text-info">{{@$data->bywho->username}}</b>
                                        </p>
                
                
                                    </div>
                
                                    <div class="col-auto text-right">
                                        <h6 class="text-success mb-0">
                                            {{__($general->cur_sym)}} {{getAmount($data->comission_amount)}}
                                        </h6>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-danger">{{__($emptyMessage)}}</div>
                    @endforelse
                </div>
            </div>

        </div>

    </main>

</body>




    {{-- <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="btn--group justify-content-center mb-1">
                    <a href="@if(request()->routeIs('user.referral.commissions.deposit')) javascript:void(0) @else {{route('user.referral.commissions.deposit')}} @endif" class="cmn--btn btn--sm btn-primary w-100 @if(request()->routeIs('user.referral.commissions.deposit')) btn-disabled @endif">@lang('Deposit Bonus')</a>

                    <a href="@if(request()->routeIs('user.referral.commissions.bet')) javascript:void(0) @else {{route('user.referral.commissions.bet')}} @endif" class="cmn--btn btn--sm btn-warning w-100 @if(request()->routeIs('user.referral.commissions.bet')) btn-disabled @endif">@lang('Bet Bonus')</a>
                    
                    <a href="@if(request()->routeIs('user.referral.commissions.win')) javascript:void(0) @else {{route('user.referral.commissions.win')}} @endif" class="cmn--btn btn--sm btn-dark w-100 @if(request()->routeIs('user.referral.commissions.win')) btn-disabled @endif">@lang('Won Bet Bonus')</a>
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary rounded">
                            <tr>
                                <th class="text-white">@lang('Date')</th>
                                <th class="text-white">@lang('From')</th>
                                <th class="text-white">@lang('Amount')</th>
                                <th class="text-white">@lang('Details')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $data)
                                <tr class="bg-success">
                                    <td data-label="@lang('Date')">{{showDateTime($data->created_at,'d M, Y')}}</td>
                                    <td data-label="@lang('From')"><strong>{{@$data->bywho->username}}</strong></td>
                                    <td data-label="@lang('Amount')">{{__($general->cur_sym)}}{{getAmount($data->comission_amount)}}</td>
                                    <td data-label="@lang('Type')">{{__($data->details)}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">{{__($emptyMessage)}}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$logs->links()}}
                </ul>
            </div>
        </div>
    </section> --}}
@endsection
@push('script')
    <script>
        $('.copytext').on('click', function() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            // iziToast.success({
            //     message: "Copied: " + copyText.value,
            //     position: "topRight"
            // });
            notifyMsg("Copied: " + copyText.value,'success')
        });
    </script>
@endpush