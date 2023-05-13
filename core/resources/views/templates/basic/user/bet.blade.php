@extends($activeTemplate.'layouts.frontend')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div id="existSearch">
                @forelse ($bets as $item)
                    <div class="container">
                        <div class="card border-0 mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div align="center" class="col-4">
                                        <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle neo-shadow text-danger">
                                            <img width="50" height="50" src="{{ @$item->match->logo_1 }}"
                                                alt="team_1">
                                        </div>
                                        <div class="text-center pt-2">
                                            <b>{{ @$item->match->team_1 }}</b>
                                        </div>
                                    </div>
                                    <div style="flex-direction: column;" class="col d-flex align-items-center justify-content-center text-center">
                                        {{-- <h6 class="mb-1">{{__($item->match->team_1)}} <font color="red">VS</font> {{__($item->match->team_2)}}</h6> --}}
                                        <p class="mb-0 text-secondary"><b>Score :</b> {{__($item->option->dividend)}}:{{__($item->option->divisor)}} ( <span class="text-success">{{__($item->option->profit)}}%</span> )</p>
                                        <p class="mb-0 text-secondary"><b>Invest :</b> {{getAmount($item->invest_amount)}} {{__($general->cur_sym)}}</p>
                                        <p class="mb-0 text-secondary">
                                            <b>Reward :</b> 
                                            @php 
                                            $p = getAmount($item->option->profit);
                                            $p = 0.01 * $p;
                                            $p = $p * $item->invest_amount;
                                            $d = getAmount($item->invest_amount) + getAmount($p);
                                            @endphp
                                        
                                            {{ getAmount($d) }} {{__($general->cur_sym)}}
                                        </p>
                                        <div>@php echo $item->statusBadge @endphp</div>
                                    </div>
                                    <div align="center" class="col-4">
                                        <div
                                            class="avatar avatar-50 border-0 bg-danger-light rounded-circle neo-shadow text-danger">
                                            <img width="50" height="50" src="{{ @$item->match->logo_2 }}"
                                                alt="item_2">
                                        </div>
                                        <div class="text-center pt-2">
                                            <b>{{ @$item->match->team_2 }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-danger">{{__($emptyMessage)}} !</div>
                @endforelse
            </div>

        </div>

    </main>

</body>


    {{-- <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">@lang('Match')</th>
                                <th class="text-white">@lang('Betted Score')</th>
                                <th class="text-white">@lang('Betted Amount')</th>
                                <th class="text-white">@lang('Reward if Won')</th>
                                <th class="text-white">@lang('Result')</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bets as $item)
                                <tr>
                                    <td data-label="@lang('Match')">{{__($item->match->team_1)}} <font color="red">VS</font>
                                    {{__($item->match->team_2)}}
                                    </td>
                                  
                                    <td data-label="@lang('Score')">{{__($item->option->dividend)}}:{{__($item->option->divisor)}} ( <font color="yellow">{{__($item->option->profit)}}%</font> ) </td>
                                    <td data-label="@lang('Invest')">{{getAmount($item->invest_amount)}} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Return')">
                                        
                                        @php 
                                        $p = getAmount($item->option->profit);
                                        $p = 0.01 * $p;
                                        $p = $p * $item->invest_amount;
                                        $d = getAmount($item->invest_amount) + getAmount($p);
                                        @endphp
                                      
                                        {{ getAmount($d) }} {{__($general->cur_text)}}
                                    </td>
                                    <td data-label="@lang('Result')">
                                        @php echo $item->statusBadge @endphp
                                    </td>
                                   
                                </tr>
                            @empty
                                <tr><td colspan="100%" class="text-center">{{__($emptyMessage)}}</td></tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$bets->links()}}
                </ul>
            </div>
        </div>
    </section> --}}

    <div class="modal cmn--modal fade" id="detailsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col text-center match-name" id="exampleModalLabel">@lang('Login Required')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="predict-content">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                @lang('Question') <span class="subtitle question"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span>@lang('My Choice Was ')</span> <span class="choice text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Invested Amount ')</b></span> <span class="invest text--base"></span>
                            </li>
                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Return Amount ')</b></span> <span class="return text--base"></span>
                            </li>

                            <li class="list-group-item bg-transparent d-flex flex-wrap justify-content-between">
                                <span><b>@lang('Result')</b></span> <span class="status text--base"></span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.detailBtn').on('click', function() {
                var modal       = $('#detailsModal');
                var match       = $(this).data('match');
                var question    = $(this).data('question');
                var choice      = $(this).data('choice');
                var investAmount= $(this).data('invest_amount');
                var returnAmount= $(this).data('return_amount');
                var statusBadge = $(this).data('status_badge');

                modal.find('.match-name').text(match);
                modal.find('.question').text(question);
                modal.find('.choice').text(choice);
                modal.find('.invest').html(`${parseFloat(investAmount).toFixed(2)} {{__($general->cur_text)}}`);
                modal.find('.return').html(`${parseFloat(returnAmount).toFixed(2)} {{__($general->cur_text)}}`);
                modal.find('.status').html(statusBadge);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
