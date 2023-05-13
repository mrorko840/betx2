       @include('templates.basic.liveonline')


    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        
        
         
           
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>

        <div class="pageTitle">
            <img src="{{ asset('assets/images/logoIcon/logo.png') }}" alt="logo" class="logo">
        </div>
        <div class="right">
            
         
        <a class="headerButton" href="{{route('user.notifications')}}">
            <ion-icon class="icon" name="notifications-outline"></ion-icon>
            {!! user_notification_count() !!}
        </a>
            
            
            <!--<a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">-->
            <!--    <ion-icon name="menu-outline"></ion-icon>-->
            <!--</a>-->
            
            
            
            <!--<a class="headerButton" data-bs-toggle="modal" data-bs-target="#noticeModal">-->
            <!--    <ion-icon class="icon" name="notifications-outline"></ion-icon>-->
            <!--    <span class="badge badge-warning"1 </span>-->
            <!--</a>-->
            
            
            <!--<div class="border border-light bg-white rounded-1 px-2 ms-1 shadow-sm text-success">-->
                        
            <!--            <img src="https://i.ibb.co/6bsLdBb/ezgif-1-1412e09fc9.gif" alt="Online: " width="20px">-->
            <!--            <b id="dynamic_counter"></b>-->
                        
            <!--</div>-->
                
                
            <!--
            <a href="{{ route('user.home') }}" class="headerButton">
                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="image" class="imaged rounded-circle w32">
            </a>
            -->
            
        </div>

    </div>
    <!-- * App Header -->
    
 



    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body bg-warning p-0">
                    
                    <!-- profile box -->
                    <div class="profileBox bg-warning pt-2 pb-2">
                        <div class="image-wrapper">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="image" class="imaged  w36">
                        </div>
                        <div class="in">
                            <strong class="text-white">{{ Auth::user()->firstname.' '.Auth::user()->lastname }}</strong>
                            <div class="text-dark">{{ Auth::user()->username }}</div>
                            
                            <div align="center" width="100%">
                        <div id="google_translate_element"></div>
                
                <script type="text/javascript">
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({pageLanguage: 'en', 
                   includedLanguages: 'en,es,fr,it,ro,pt',
                  layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                }
                </script>
            
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
                            
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
                    <!-- balance -->
                    <div class="sidebar-balance">
                        <div class="listview-title">Balance</div>
                        <div class="in">
                            <h1 class="amount">{{ Auth::user()->balance }} {{ $general->cur_text }}</h1>
                        </div>
                    </div>
                    <!-- * balance -->
                   

                    <!-- action group -->
                    <div class="row-12 action-group pb-0">
                        <a href="{{ route('user.deposit') }}" class="col-6 action-button">
                            <div class="in btn btn-warning w-100">
                                <!--<div class="iconbox">-->
                                <!--    <ion-icon name="arrow-up-outline"></ion-icon>-->
                                <!--</div>-->
                                Deposit
                            </div>
                        </a>
                        
                        <a href="{{ route('user.withdraw') }}" class="col-6 action-button">
                            <div class="in btn btn-warning w-100">
                                <!--<div class="iconbox">-->
                                <!--    <ion-icon name="arrow-down-outline"></ion-icon>-->
                                <!--</div>-->
                                Withdraw
                            </div>
                        </a>
                        
                        <!--<a href="{{route('user.referral.commissions.deposit')}}" class="action-button">-->
                        <!--    <div class="in btn btn-warning">-->
                                <!--<div class="iconbox">-->
                                <!--    <ion-icon name="bar-chart-outline"></ion-icon>-->
                                <!--</div>-->
                        <!--        Commissions-->
                        <!--    </div>-->
                        <!--</a>-->
                        
                        <!--<a href="{{ route('user.home') }}" class="action-button">-->
                        <!--    <div class="in">-->
                        <!--        <div class="iconbox">-->
                        <!--            <ion-icon name="person-circle-outline"></ion-icon>-->
                        <!--        </div>-->
                        <!--        Profile-->
                        <!--    </div>-->
                        <!--</a>-->
                        
                       
                    </div>
                    <!-- * action group -->
                    
                    
                    <!-- action group -->
                    <div class="action-group pt-0">
                        
                        
                        <a href="{{route('user.referral.commissions.deposit')}}" class="col-12 action-button">
                            <div class="in btn btn-warning w-100">
                                <!--<div class="iconbox">-->
                                <!--    <ion-icon name="bar-chart-outline"></ion-icon>-->
                                <!--</div>-->
                                Commissions
                            </div>
                        </a>
                        
                        
                       
                    </div>
                    <!-- * action group -->

                    <!-- menu -->
                    <div class="bg-warning listview-title mt-1">Menu</div>
                    <ul class="bg-warning listview flush transparent no-line image-listview">
                        <li>
                            <a href="{{ route('home') }}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Home
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.deposit.history') }}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Deposit History
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.withdraw.history') }}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Withdraw History
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.bet.index', 'all')}}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    My Bets
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- * menu -->

                    <!-- others -->
                    <div class="bg-warning listview-title mt-1">Others</div>
                    <ul class="bg-warning listview flush transparent no-line image-listview">
                        <li>
                            <a href="{{route('user.profile.setting')}}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Account Settings
                                </div>
                            </a>
                        </li>
                        
                        <!--<li>-->
                        <!--    <a href="{{route('user.change.password')}}" class="item text-white">-->
                        <!--        <div class="icon-box bg-primary">-->
                        <!--            <ion-icon name="key-outline"></ion-icon>-->
                        <!--        </div>-->
                        <!--        <div class="in">-->
                        <!--            Change Password-->
                        <!--        </div>-->
                        <!--    </a>-->
                        <!--</li>-->
                        
                        <li>
                            <a href="{{route('ticket')}}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Support
                                </div>
                            </a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('user.logout') }}" class="item text-white">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Log out
                                </div>
                            </a>
                        </li>


                    </ul>
                    <!-- * others -->

                   

                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->
    
    
     <!-- App Bottom Menu -->
    <div class="appBottomMenu bg-primary">
        <a href="{{route('user.bet.index', 'all')}}" class="item {{ request()->path() == 'user/bets/all' ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="trophy-outline"></ion-icon>
                <strong>My Bet</strong>
            </div>
        </a>
        
        <!--<a href="{{ route('home') }}" class="item {{ request()->path() == '/' ? 'active' : '' }}">-->
        <!--    <div class="col">-->
        <!--        <ion-icon name="home-outline"></ion-icon>-->
        <!--        <strong>Home</strong>-->
        <!--    </div>-->
        <!--</a>-->
        
        <!--<a href="{{ route('user.deposit') }}" class="item {{ request()->path() == 'user/deposit' ? 'active' : '' }}">-->
        <!--    <div class="col">-->
        <!--        <ion-icon name="card-outline"></ion-icon>-->
        <!--        <strong>Deposit</strong>-->
        <!--    </div>-->
        <!--</a>-->
        
        <a href="{{ route('user.withdraw') }}" class="item {{ request()->path() == 'user/withdraw' ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="cash-outline"></ion-icon>
                <strong>Withdraw</strong>
            </div>
        </a>
        
        <!--<a href="{{ route('user.home') }}" class="item {{ request()->path() == 'user/dashboard' ? 'active' : '' }}">-->
        <!--    <div class="col">-->
        <!--        <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="image" width="40px" class="rounded-circle">-->
        <!--        <strong>Profile</strong>-->
        <!--    </div>-->
        <!--</a>-->
        
        <a href="{{ route('home') }}" class="item {{ request()->path() == '/' ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        
            
        <!--
        <a href="{{ route('user.home') }}" class="item {{ request()->path() == 'user/dashboar' ? 'active' : '' }}">
            <div style="margin-top: -15px;" class="action-button bg-primary">
                <ion-icon style="font-size: 32px;" name="person-outline"></ion-icon>
            </div>
        </a>
        
        <a href="{{route('user.bet.index', 'all')}}" class="item {{ request()->path() == 'user/plan' ? 'active' : '' }}">
            <div style="margin-top: -15px;" class="action-button bg-primary">
                <ion-icon style="font-size: 32px;" name="trophy"></ion-icon>
                
            </div>
        </a>
        -->
        
        <a href="{{ route('user.deposit') }}" class="item {{ request()->path() == 'user/deposit' ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="wallet-outline"></ion-icon>
                <strong>Deposit</strong>
            </div>
        </a>
        
        <!--<a href="{{ route('user.withdraw') }}" class="item {{ request()->path() == 'user/withdraw' ? 'active' : '' }}">-->
        <!--    <div class="col">-->
        <!--        <ion-icon name="wallet-sharp"></ion-icon>-->
        <!--        <strong>Withdraw</strong>-->
        <!--    </div>-->
        <!--</a>-->
        
        <!--<a href="{{route('user.bet.index', 'all')}}" class="item {{ request()->path() == 'user/bets/all' ? 'active' : '' }}">-->
        <!--    <div class="col">-->
        <!--        <ion-icon name="trophy-outline"></ion-icon>-->
        <!--        <strong>My Bet</strong>-->
        <!--    </div>-->
        <!--</a>-->
        
        <a href="{{ route('user.home') }}" class="item {{ request()->path() == 'user/dashboard' ? 'active' : '' }}">
            <div class="col">
                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" alt="image" width="36px" class="rounded-circle border border-warning">
                <strong>Profile</strong>
            </div>
        </a>
        
    </div>
    <!-- * App Bottom Menu -->

