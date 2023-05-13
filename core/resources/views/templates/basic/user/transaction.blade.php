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
                                <div class="flex-grow-1 p-1">
                                    <label>Type</label>
                                    <select id="trx_type" class="form-control form-select" name="trx_type">
                                        <option value="" @if(request()->trx_type == '') selected @endif >All</option>
                                        <option value="plus" @if(request()->trx_type == 'plus') selected @endif >Plus</option>
                                        <option value="minus" @if(request()->trx_type == 'minus') selected @endif >Minus</option>
                                    </select>
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
                @forelse ($transactions as $trx)
                    <div class="container">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 rounded">
                                            <div class="background">
                                                @if ($trx->trx_type == '+')
                                                    <img width="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/trans_add_logo.png') }}" alt="">
                                                @else
                                                    <img width="50px" src="{{ asset($activeTemplateTrue . '/assets/img/services/trans_send_logo.png') }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1"> {{ __(@$trx->details) }}</h6>
                                        <p class="small text-secondary">{{ showDateTime($trx->created_at, 'd-m-Y') }} |
                                            {{ diffForHumans($trx->created_at) }}
                                            <br>
                                            Trx: <b class="text-info">{{ $trx->trx }}</b>
                                        </p>
                
                
                                    </div>
                
                                    <div class="col-auto">
                
                                        <h6
                                            class="@if ($trx->trx_type == '+') {{ 'text-success' }} @else {{ 'text-danger' }} @endif">
                
                                            @if (getAmount($trx->amount) != 0)
                                                {{ __($trx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($trx->amount) }}
                                            @else
                                                {{ __($trx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($trx->charge) }}
                                            @endif
                
                                        </h6>
                
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

</section>
@endsection

