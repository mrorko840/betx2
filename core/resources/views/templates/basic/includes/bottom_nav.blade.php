<!-- footer-->
<div class="footer">
    <div class="row no-gutters justify-content-center">
        <div class="col-auto">
            <a href="{{ route('home') }}" class="pt-1 {{ request()->route()->getName() == 'home' ? 'active' : '' }}">
                <i class="material-icons las la-home"></i>
                <p>Home</p>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{route('user.deposit')}}" class="OpenDepositModal {{ request()->path() == 'user/analytics' ? 'active' : '' }}">
                <i class="material-icons las la-coins"></i>
                <p>Deposit</p>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{route('user.bet.index', 'all')}}" class="{{ request()->path() == 'user/bets/all' ? '' : '' }}">
            <div style="height: 56px; width: 56px; margin-top: -23px;" class="btn-warning rounded-circle neo-shadow d-flex align-items-center">
                <i style="font-size: 30px; width: 40px;" class="material-icons las la-trophy"></i>
            </div>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{route('user.withdraw')}}" class="OpenWithdrawModal {{ request()->path() == 'user/ptc' ? 'active' : '' }}">
                <i class="material-icons las la-wallet"></i>
                <p>Withdraw</p>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('user.home') }}" class="pt-1 {{ request()->route()->getName() == 'user.home' ? 'active' : '' }}">
                <i class="material-icons las la-user-alt"></i>
                <p>Profile</p>
            </a>
        </div>
    </div>
</div>
