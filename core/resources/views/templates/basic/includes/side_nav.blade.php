@php 
$user = Auth::user(); 
$importentLinks = getContent('importent_links.content', true);
@endphp

<!-- menu main -->
<div class="main-menu">
    <div class="row mb-4 no-gutters">
        <div class="col-auto"><button class="btn btn-link btn-40 btn-close text-white"><span
                    class="material-icons">chevron_left</span></button></div>
        <div class="col-auto">
            <div class="avatar avatar-40 neo-shadow rounded-circle position-relative">
                <figure class="background">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="LOGO">
                </figure>
            </div>
        </div>
        <div class="col pl-3 text-left align-self-center">
            <h6 class="mb-1 text-neo-shadow text-dark">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h6>
            <p class="small text-default-secondary">{{ Auth::user()->username }}</p>
        </div>
    </div>
    <div class="menu-container">
        <div class="row mb-4">
            <div class="col">
                <h4 class="mb-1 font-weight-normal text-neo-shadow text-success">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h4>
                <p class="text-default-secondary">My Balance</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('user.deposit') }}" class="btn btn-default btn-40 rounded-circle neo-shadow OpenDepositModal" onclick="sideBarBack()">
                    <i class="material-icons">add</i>
                </a>
            </div>
        </div>

        <ul class="nav nav-pills flex-column ">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('home') }}">
                    <div>
                        <span class="material-icons icon">account_balance</span>
                        Home
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.referral.commissions.deposit')}}">
                    <div>
                        <span class="material-icons icon">person_add_alt_1</span>
                        Refer Friends
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link OpenDepositModal" onclick="sideBarBack()" href="javascript:void(0)">
                    <div>
                        <span class="material-icons icon">payments</span>
                        Add Fund
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link OpenWithdrawModal" onclick="sideBarBack()" href="javascript:void(0)">
                    <div>
                        <span class="material-icons icon">account_balance_wallet</span>
                        Withdraw Fund
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile.setting') }}">
                    <div>
                        <span class="material-icons icon">manage_accounts</span>
                        Profile Settings
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.transactions') }}">
                    <div>
                        <span class="material-icons icon">layers</span>
                        Transactions
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ticket.open') }}">
                    <div>
                        <span class="material-icons icon">support_agent</span>
                        Support Ticket
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            @if ( strlen(@$importentLinks->data_values->telegram) > 10)
            <li class="nav-item">
                <a class="nav-link" href="{{ @$importentLinks->data_values->telegram }}">
                    <div>
                        <span class="material-icons icon lab la-telegram"></span>
                        Telegram
                    </div>
                    <span class="arrow material-icons">chevron_right</span>
                </a>
            </li>
            @endif

            @if (strlen(@$importentLinks->data_values->whatsapp) > 10)
                <li class="nav-item">
                    <a class="nav-link" href="{{ @$importentLinks->data_values->whatsapp }}">
                        <div>
                            <span class="material-icons icon lab la-whatsapp"></span>
                            Whatsapp
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="text-center">
            <a href="{{ route('user.logout') }}" class="btn btn-danger neo-shadow rounded my-3 mx-auto">Sign out</a>
        </div>
    </div>
</div>
<div class="backdrop"></div>

