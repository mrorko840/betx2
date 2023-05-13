@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $yourLinks = getContent('your_links.content', true);
    @endphp









<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

    @include(activeTemplate().'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include(activeTemplate().'includes.top_nav')

        <!-- page content start -->
        {{-- <div class="container-fluid px-0">
            <div class="card overflow-hidden">
                <div class="card-body p-0 h-150">
                    <div class="background">
                        <img src="{{ asset($activeTemplateTrue.'assets/img/image10.jpg') }}" alt="" style="display: none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid top-70 text-center mb-4">
            <div class="neo-shadow avatar  avatar-140 rounded-circle mx-auto shadow">
                <div class="background">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                </div>
            </div>
        </div>

        <div class="container mb-4 text-center text-white">
            <h6 class="mb-1">{{ __($user->fullname) }}</h6>
            <p>{{@$user->address->country}}</p>
        </div> --}}

        <div class="main-container">

            
            <div class="container mb-4">
                {{-- <div class="row mb-4">
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-default px-2 btn-block rounded" data-toggle="modal" data-target="#QrCodeModal">
                            <span class="material-icons mr-1">
                                qr_code_scanner
                            </span> 
                            Share QR
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-outline-default px-2 btn-block rounded">
                            <span class="material-icons mr-1">
                                diamond
                            </span>
                            {{ get_user_vip_level(auth()->user()->id) }}
                        </a>
                    </div>
                </div> --}}

                <div class="card border-0 mb-3">
                    <div class="card-header pb-0 mt-2">
                        <div class="row align-items-end">
                            <div class="col-6 text-left">
                                <img src="{{asset('assets/images/user/profile/'. $user->image)}}" 
                                    class="img-thumbnail rounded-circle" style="width: 70px" alt="img">
                                <h6 class="text-neo-shadow text-dark">{{ __($user->fullname) }}</h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6 class="mb-0 text-neo-shadow text-dark">My Balance</h6>
                                <h3 class="text-neo-shadow text-success">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h3>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <div class="row align-items-center justify-content-center mb-1">
                            <div class="col-6 text-left">
                                <a href="javascript:void(0)" class="btn btn-warning neo-shadow OpenDepositModal">
                                    <span class="material-icons">
                                        arrow_downward
                                    </span>
                                </a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="javascript:void(0)" class="btn btn-success neo-shadow OpenWithdrawModal">
                                    <span class="material-icons">
                                        arrow_upward
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container mb-4">
                
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-warning-light rounded-circle text-warning">
                                            <i class="material-icons vm text-template">wallet</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($user->deposits->where('status',1)->sum('amount')) }}</h6>
                                        <p class="small text-secondary">Tota Deposit</p>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($user->withdrawals->where('status',1)->sum('amount')) }}</h6>
                                        <p class="small text-secondary">Total Withdraw</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-success-light rounded-circle text-success">
                                            <i class="material-icons vm text-template">account_balance</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-danger-light rounded-circle text-danger">
                                            <i class="material-icons vm text-template">supervised_user_circle</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($widget['totalTransaction']) }}</h6>
                                        <p class="small text-secondary">Team Earn</p>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount(($widget['totalTransaction'])) }}</h6>
                                        <p class="small text-secondary">Today Earn</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-default-light rounded-circle text-default">
                                            <i class="material-icons vm text-template">monetization_on</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-default-light rounded-circle text-default">
                                            <i class="material-icons vm text-template">task_alt</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <a href="{{route('user.bet.index', 'all')}}">
                                            <h6 class="mb-1">{{ $widget['totalBet'] }}</h6>
                                            <p class="small text-secondary">Total Bets</p>
                                        </a>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        <a href="{{route('user.bet.index', 'pending')}}">
                                            <h6 class="mb-1">{{ $widget['totalPending'] }}</h6>
                                            <p class="small text-secondary">Pending Bets</p>
                                        </a>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-warning-light rounded-circle text-warning">
                                            <i class="material-icons vm text-template">model_training</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-success-light rounded-circle text-success">
                                            <i class="material-icons vm text-template">videogame_asset</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <a href="{{route('user.bet.index', 'won')}}">
                                            <h6 class="mb-1">{{ $widget['totalWin'] }}</h6>
                                            <p class="small text-secondary">Won Bets</p>
                                        </a>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        <a href="{{route('user.bet.index', 'lose')}}">
                                            <h6 class="mb-1">{{ $widget['totalLose'] }}</h6>
                                            <p class="small text-secondary">Lose Bets</p>
                                        </a>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="neo-shadow avatar  avatar-40 border-0 bg-danger-light rounded-circle text-danger">
                                            <i class="material-icons vm text-template">videogame_asset_off</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            

            <!-- Profile Settings -->
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Profile</h6>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-group list-group-flush border-top border-color">
                            
                            <a href="{{ route('user.profile.setting') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-default-light text-default rounded">
                                            <span class="material-icons">manage_accounts</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Profile Setting</h6>
                                        <p class="text-secondary">Update account informations</p>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="{{ route('user.address.setting') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-default-light text-default rounded">
                                            <span class="material-icons">location_city</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">My Address</h6>
                                        <p class="text-secondary">Update Address informations</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('user.change.password') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-default-light text-default rounded">
                                            <span class="material-icons">lock_open</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Security Settings</h6>
                                        <p class="text-secondary">Change Password</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports -->
            <div class="container mt-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Reports</h6>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-group list-group-flush border-top border-color">
                            
                            <a href="{{route('user.referral.commissions.deposit')}}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-success-light text-success rounded">
                                            <span class="material-icons">bubble_chart</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Commissions</h6>
                                        <p class="text-secondary">Commissions from myTeam</p>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('user.transactions') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-success-light text-success rounded">
                                            <span class="material-icons">bar_chart</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Transactions</h6>
                                        <p class="text-secondary">All Transactions Here</p>
                                    </div>
                                </div>
                            </a>
                            
                            <a href="{{ route('user.deposit.history') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-success-light text-success rounded">
                                            <span class="material-icons">history_toggle_off</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Deposit History</h6>
                                        <p class="text-secondary">All deposit records here.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('user.withdraw.history') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-success-light text-success rounded">
                                            <span class="material-icons">history_toggle_off</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Withdraw History</h6>
                                        <p class="text-secondary">All withdraw records here.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Others -->
            <div class="container mt-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Others</h6>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-group list-group-flush border-top border-color">
                            
                            <a href="{{ route('user.referral.users') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-warning-light text-warning rounded">
                                            <span class="material-icons">groups</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">My Team</h6>
                                        <p class="text-secondary">See Team Earning Informations</p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#appDownloadModal" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-warning-light text-warning rounded">
                                            <span class="material-icons">system_update</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Download App</h6>
                                        <p class="text-secondary">Install Our Offical Application</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exit -->
            <div class="container mt-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Exit</h6>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="list-group list-group-flush border-top border-color">
                            <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-action border-color">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="neo-shadow avatar  avatar-50 bg-danger-light text-danger rounded">
                                            <span class="material-icons">power_settings_new</span>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pl-0">
                                        <h6 class="mb-1">Logout</h6>
                                        <p class="text-secondary">Logout from the application</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    @auth
        @include($activeTemplate . 'includes.bottom_nav')
    @endauth

    <!-- App Download Modal -->
    @include('templates.basic.modals.app_download')

    <!-- QrCode Modal -->

    <div class="modal fade" id="QrCodeModal" tabindex="-1" role="dialog" aria-labelledby="QrCodeModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QrCodeModalCenterTitle">Invite with - QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div align="center" class="modal-body">
                    <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ route('home') }}?reference={{ auth()->user()->username }}&chs=180x180&choe=UTF-8&chld=L|2" alt="QR Code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>


    <!-- App Capsule -->

    {{-- <div id="appCapsule" class="mb-3">

        <div class="container">
            <div class="row">
                <div class="col-auto p-1">
                    <div class="bg-primary rounded p-2">
                        <img width="90px" class="imaged border border-warning rounded-circle"
                            src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}" />
                    </div>
                </div>

                <div class="col p-1">
                    <div class="bg-primary rounded p-2 h-100 d-flex align-items-center">
                        <div class="pt-1">
                            <h2 class="text-white">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h2>
                            <h5 class="text-light"><b>username: </b>{{ Auth::user()->username }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--<div class="container">-->
        <!--    <div align="center" class=" row pt-3 rounded-bottom bg-primary">-->

        <!--        <div class="col-12 ps-2 "><img width="90px" class="imaged border border-warning rounded-circle" src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}" /></div>-->

        <!--        <div class="col-12 pt-2"><h2 class="text-white">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h2><h5 class="text-light"><b>username: </b>{{ Auth::user()->username }}</h5></div>-->

        <!--    </div>-->

        <!--</div>-->

        <!--<div class="container bg-primary pt-4 pb-3 ">-->
        <!--    <div class="row">-->

        <!--        <div class="col-4 ps-2"><img width="75px" class="imaged rounded-circle" src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}" /></div>-->

        <!--        <div class="col-8 pt-2"><h3 class="text-light">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h3><h5 class="text-warning"><b>username: </b>{{ Auth::user()->username }}</h5></div>-->

        <!--    </div>-->

        <!--</div>-->


        <!-- Wallet Card -->
        <div class="container pt-2">
            <div class="wallet-card bg-warning bg-gradiant">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title text-dark">My Balance</span>
                        <h1 class="total text-warning">{{ showAmount($user->balance) }} {{ $general->cur_text }}</h1>
                    </div>
                    <div align="center" class="right">
                        <a href="#" class="text-primary">

                            <div class="chip chip-media">
                                <i class="chip-icon bg-primary">
                                    <ion-icon style="font-size:20px;" name="basket" role="img" class="md hydrated"
                                        aria-label="person"></ion-icon>
                                </i>
                                <span class="chip-label">
                                    {{ get_user_vip_level(auth()->user()->id) }}
                                </span>
                            </div>



                        </a>
                    </div>
                </div>

                <div class="form--group">
                    <label class="form-label">
                        @lang('Referral Link')
                    </label>
                    <div class="input-group">
                        <input type="text" name="key"
                            value="{{ route('user.refer.register', [Auth::user()->id + 1000]) }}"
                            class="form-control bg-secondary bg-gradient" id="referralURL" readonly>
                        <span
                            class="input-group-text bg-primary form--control h--50px cursor-pointer copytext px-3 rounded-end"
                            id="copyBoard">
                            <i class="lar la-copy"></i>
                        </span>
                    </div>

                </div>

                <!-- * Balance -->
                <!-- Wallet Footer -->

                <!--<div class="wallet-footer">-->
                <!--    <div class="item">-->
                <!--        <a href="{{ route('user.deposit') }}">-->
                <!--            <div class="shadow icon-wrapper bg-warning">-->
                <!--                <ion-icon name="arrow-up-outline"></ion-icon>-->
                <!--            </div>-->
                <!--            <strong>Deposit</strong>-->
                <!--        </a>-->
                <!--    </div>-->
                <!--    <div class="item">-->
                <!--      <a href="{{ route('user.referral.commissions.deposit') }}">-->
                <!--          <div class="shadow icon-wrapper bg-secondary">-->
                <!--              <ion-icon name="bar-chart-outline"></ion-icon>-->
                <!--          </div>-->
                <!--          <strong>Commissions</strong>-->
                <!--      </a>-->
                <!--  </div>-->
                <!--    <div class="item">-->
                <!--      <a href="{{ route('user.withdraw') }}">-->
                <!--          <div class="shadow icon-wrapper bg-success">-->
                <!--              <ion-icon name="arrow-down-outline"></ion-icon>-->
                <!--          </div>-->
                <!--          <strong>Withdraw</strong>-->
                <!--      </a>-->
                <!--    </div>-->
                <!--</div>-->

                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->


        <!-- Stats -->
        <div class="container">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box bg-warning bg-gradiant">
                        <div class="title text-dark">Total Deposit</div>
                        <h2 class="text-warning">{{ $user->deposits->sum('amount') + 0 }}.00</h2>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box bg-warning bg-gradiant">
                        <div class="title text-dark">Total Withdraw</div>
                        <h2 class="text-warning">{{ showAmount($user->withdrawals->where('status', 1)->sum('amount')) }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <a href="{{route('user.bet.index', 'all')}}">
                        <div class="stat-box bg-warning bg-gradiant">
                            <div class="title text-dark">Total Bets</div>
                            <h2 class="text-warning">{{ $widget['totalBet'] }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <div class="stat-box bg-warning bg-gradiant">
                        <div class="title text-dark">Pending Bets</div>
                        <h2 class="text-warning">{{ $widget['totalPending'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box bg-warning bg-gradiant">
                        <div class="title text-dark">Won Bets</div>
                        <h2 class="text-warning">{{ $widget['totalWin'] }}</h2>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box bg-warning bg-gradiant">
                        <div class="title text-dark">Lose Bets</div>
                        <h2 class="text-warning">{{ $widget['totalLose'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="stat-box bg-secondary bg-gradiant">
                        <div class="title text-dark">Refunded Bets</div>
                        <h2 class="">{{ $widget['totalRefund'] }}</h2>
                    </div>
                </div>

            </div>

        </div>
        <!-- * Stats -->






        <div class="container pb-5">
            <div class="row pt-2">
                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ route('user.profile.setting') }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="construct-outline">
                                </ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                Account
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ route('user.transactions') }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="podium-outline"></ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                Transactions
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ route('user.referral.commissions.deposit') }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="bar-chart-outline">
                                </ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                Commissions
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ route('user.referral.users') }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="people-outline"></ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                My Team
                            </h6>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row pt-2">


                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a>
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="podium-outline"></ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                VIP Level - <b> {{ get_user_vip_level(auth()->user()->id) }} </b>
                            </h6>
                        </a>
                    </div>
                </div>


                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ $yourLinks->data_values->apps }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="cloud-download-outline">
                                </ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                Apps
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <div align="center" class="bg-white rounded shadow-sm p-1 bg-gradiant">

                        <a href="{{ route('user.logout') }}">
                            <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">
                                <ion-icon style="font-size: 20px;" class="align-middle" name="log-out-outline">
                                </ion-icon>
                            </div>
                            <h6 style="font-size: 10px;" class="pt-1">
                                Log Out
                            </h6>
                        </a>
                    </div>
                </div>
                <div class="col-3">
                    <!--<div align="center" class="bg-white rounded shadow-sm p-1">-->

                    <!--    <a href="{{ route('user.referral.commissions.deposit') }}">-->
                    <!--        <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">-->
                    <!--            <ion-icon style="font-size: 20px;" class="align-middle" name="bar-chart-outline"></ion-icon>-->
                    <!--        </div>-->
                    <!--        <h6 style="font-size: 10px;" class="pt-1">-->
                    <!--            Commissions-->
                    <!--        </h6>-->
                    <!--    </a>-->
                    <!--</div>-->
                </div>
                <div class="col-3">
                    <!--<div align="center" class="bg-white rounded shadow-sm p-1">-->

                    <!--    <a href="{{ route('user.referral.users') }}">-->
                    <!--        <div class="neo-shadow avatar  avatar-40 border-0 bg-primary rounded-circle text-white">-->
                    <!--            <ion-icon style="font-size: 20px;" class="align-middle" name="people-outline"></ion-icon>-->
                    <!--        </div>-->
                    <!--        <h6 style="font-size: 10px;" class="pt-1">-->
                    <!--            My Team-->
                    <!--        </h6>-->
                    <!--    </a>-->
                    <!--</div>-->
                </div>
            </div>
        </div>


        <!-- Account menu -->
        <!--<div class="container">-->
        <!--    <div style="background-color: rgb(255, 255, 255);" class="rounded mt-2 bg-warning"> -->

        <!--<div class="listview-title mt-1">Menu</div>-->


        <!--    <ul class="listview flush transparent no-line image-listview">-->
        <!--        <li>-->
        <!--            <a href="{{ route('user.profile.setting') }}" class="item">-->
        <!--                <div class="icon-box bg-primary">-->
        <!--                    <ion-icon name="construct-outline"></ion-icon>-->
        <!--                </div>-->
        <!--                <div class="in">-->
        <!--                    Account Info-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </li>-->

        <!--<li>-->
        <!--    <a href="{{ route('user.change.password') }}" class="item">-->
        <!--        <div class="icon-box bg-primary">-->
        <!--            <ion-icon name="key-outline"></ion-icon>-->
        <!--        </div>-->
        <!--        <div class="in">-->
        <!--        Change Password-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</li>-->


        <!--    </ul>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- * Account menu -->



        <!-- History menu -->
        <!--<div class="container">-->
        <!--    <div style="background-color: rgb(255, 255, 255);" class="rounded mt-2 bg-info"> -->

        <!--<div class="listview-title mt-1">Menu</div>-->


        <!--    <ul class="listview flush transparent no-line image-listview">-->

        <!--        <li>-->
        <!--        <a href="{{ route('user.transactions') }}" class="item">-->
        <!--            <div class="icon-box bg-primary">-->
        <!--                <ion-icon name="podium-outline"></ion-icon>-->
        <!--            </div>-->
        <!--            <div class="in">-->
        <!--                Transactions-->
        <!--            </div>-->
        <!--        </a>-->
        <!--        </li>-->
        <!--<li>-->
        <!--    <a href="{{ route('user.deposit.history') }}" class="item">-->
        <!--        <div class="icon-box bg-primary">-->
        <!--            <ion-icon name="card-outline"></ion-icon>-->
        <!--        </div>-->
        <!--        <div class="in">-->
        <!--            Deposit History-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</li>-->

        <!--<li>-->
        <!--    <a href="{{ route('user.withdraw.history') }}" class="item">-->
        <!--        <div class="icon-box bg-primary">-->
        <!--            <ion-icon name="cash-outline"></ion-icon>-->
        <!--        </div>-->
        <!--        <div class="in">-->
        <!--            Withdraw History-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</li>-->

        <!--        <li>-->
        <!--            <a href="{{ __($yourLinks->data_values->apps) }}" class="item">-->
        <!--                <div class="icon-box bg-primary">-->
        <!--                    <ion-icon name="cloud-download-outline"></ion-icon>-->
        <!--                </div>-->
        <!--                <div class="in">-->
        <!--                Download Apps-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </li>-->

        <!--    </ul>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- * History menu -->


        <!-- others menu -->
        <!--<div class="container">-->
        <!--    <div style="background-color: rgb(255, 255, 255);" class="rounded mt-2 bg-warning"> -->

        <!--<div class="listview-title mt-1">Menu</div>-->


        <!--    <ul class="listview flush transparent no-line image-listview">-->
        <!--        <li>-->
        <!--            <a href="{{ route('user.referral.commissions.deposit') }}" class="item">-->
        <!--                <div class="icon-box bg-primary">-->
        <!--                    <ion-icon name="bar-chart-outline"></ion-icon>-->
        <!--                </div>-->
        <!--                <div class="in">-->
        <!--                    Commissions-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </li>-->

        <!--        <li>-->
        <!--            <a href="{{ route('user.referral.users') }}" class="item">-->
        <!--                <div class="icon-box bg-primary">-->
        <!--                    <ion-icon name="people-outline"></ion-icon>-->
        <!--                </div>-->
        <!--                <div class="in">-->
        <!--                    My Team-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </li>-->



        <!--    </ul>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- * others menu -->


        <!-- logout menu -->
        <!--<div class="container pb-3">-->
        <!--    <div style="background-color: rgb(255, 255, 255);" class="rounded mt-2 bg-secondary"> -->

        <!--<div class="listview-title mt-1">Menu</div>-->


        <!--    <ul class="listview flush transparent no-line image-listview">-->

        <!--        <li>-->
        <!--            <a href="{{ route('user.logout') }}" class="item">-->
        <!--                <div class="icon-box bg-primary">-->
        <!--                    <ion-icon name="log-out-outline"></ion-icon>-->
        <!--                </div>-->
        <!--                <div class="in">-->
        <!--                Logout-->
        <!--                </div>-->
        <!--            </a>-->
        <!--        </li>-->

        <!--    </ul>-->
        <!--    </div>-->
        <!--</div>-->
        <!-- * logout menu -->

    </div> --}}


    <div class="modal cmn--modal fade" id="detailsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col text-center match-name" id="exampleModalLabel">@lang('Login Required')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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

@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.copytext').on('click', function() {
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });

            $('.detailBtn').on('click', function() {
                var modal = $('#detailsModal');
                var match = $(this).data('match');
                var question = $(this).data('question');
                var choice = $(this).data('choice');
                var investAmount = $(this).data('invest_amount');
                var returnAmount = $(this).data('return_amount');
                var statusBadge = $(this).data('status_badge');

                modal.find('.match-name').text(match);
                modal.find('.question').text(question);
                modal.find('.choice').text(choice);
                modal.find('.invest').html(
                    `${parseFloat(investAmount).toFixed(2)} {{ __($general->cur_text) }}`);
                modal.find('.return').html(
                    `${parseFloat(returnAmount).toFixed(2)} {{ __($general->cur_text) }}`);
                modal.find('.status').html(statusBadge);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
