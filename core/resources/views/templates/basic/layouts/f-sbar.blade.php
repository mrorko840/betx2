@php
$yourLinks = getContent('your_links.content',true);
@endphp
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
                
                
                 @if (Auth::check())
            
            Message
            
            @endif
                
            <!--<a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">-->
            <!--    <ion-icon name="menu-outline"></ion-icon>-->
            <!--</a>-->
                
                
                    
                
                <!--<a href="#" class="headerButton" data-toggle="modal" data-target="#exampleModalCenter">-->
                <!--    <ion-icon class="icon" name="notifications-outline"></ion-icon>-->
                <!--    <span class="badge badge-warning"1 </span>-->
                <!--</a>-->
                
                <!--<div class="border border-light bg-white rounded-1 px-2 ms-1 shadow-sm text-success">-->
                        
                <!--        <img src="https://i.ibb.co/6bsLdBb/ezgif-1-1412e09fc9.gif" alt="Online: " width="20px">-->
                <!--        <b id="dynamic_counter"></b>-->
                        
                <!--</div>-->
                
            </div>
        </div>
        <!-- * App Header -->



<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body bg-warning  p-0">
                
                
                <!-- action group -->
                <div class="action-group">
                    <a href="{{ route('user.deposit') }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="arrow-up-outline"></ion-icon>
                            </div>
                            Deposit
                        </div>
                    </a>
                    
                    <a href="{{ $yourLinks->data_values->apps }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="cloud-download-outline"></ion-icon>
                            </div>
                           Official App
                        </div>
                    </a>
                    
                    <a href="{{ route('user.login') }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="log-in-outline"></ion-icon>
                            </div>
                            Login
                        </div>
                    </a>
                    
                    <a href="{{ route('user.register') }}" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="person-add-outline"></ion-icon>
                            </div>
                            Register
                        </div>
                    </a>
                    
                   
                </div>
                <!-- * action group -->
                
            <div class="bg-warning " align="center" width="100%">
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
                
            

                <!-- menu -->
                <div class="bg-warning listview-title mt-1">Menu</div>
                <ul class="bg-warning listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{ route('home') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Home
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.bet.index', 'all')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="trophy-outline"></ion-icon>
                            </div>
                            <div class="in">
                                My Bet
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/privacy" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="bug-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Privacy Policy
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- others -->
                <div class="bg-warning listview-title mt-1">Others</div>
                <ul class="bg-warning listview flush transparent no-line image-listview">
                    <li>
                        <a href="" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="school-outline"></ion-icon>
                            </div>
                            <div class="in">
                                About Us
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="call-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Contact Us
                            </div>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://t.me/ncfcadmin" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="paper-plane-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Join Telegram
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.login') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-in-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Login
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.register') }}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-add-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Sign Up
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
    <a href="{{ route('home') }}" class="item {{ request()->path() == '/' ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('user.deposit') }}" class="item {{ request()->path() == 'user/ptc' ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="card-outline"></ion-icon>
            <strong>Deposit</strong>
        </div>
    </a>
    <a href="{{route('user.bet.index', 'all')}}" class="item {{ request()->path() == 'user/plan' ? 'active' : '' }}">
        <div style="margin-top: -15px;" class="action-button bg-warning">
            <ion-icon style="font-size: 32px;" name="trophy"></ion-icon>
            
        </div>
    </a>
    <a href="{{ route('user.register') }}" class="item {{ request()->path() == 'telegram' ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="person-add-outline"></ion-icon>
            <strong>Register</strong>
        </div>
    </a>
    <a href="{{ route('user.login') }}" class="item">
        <div class="col">
            <ion-icon name="log-in-outline"></ion-icon>
            <strong>Login</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->
    