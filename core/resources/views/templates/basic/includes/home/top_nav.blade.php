<?php 
$noticeCaption = getContent('notice.content',true);
?>

<!-- Fixed navbar -->
<header  class="header">
    <div class="row">
        <div class="col-auto px-0">
            {{-- <button class="menu-btn btn btn-40 btn-link" type="button">
                <span class="material-icons">menu</span>
            </button> --}}
        </div>
        <div class="text-left col align-self-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h5 class="mb-0"><img style="width:110px;" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="site-logo"></h5>
            </a>
        </div>
        <div class="ml-auto col-auto pl-0">

            <div class="row">
                <div class="custom-control custom-switch pt-2">
                    <input type="checkbox" class="custom-control-input switch-info text-align-center" id="darklayout" >
                    <label class="custom-control-label" for="darklayout">
                        <span class="material-icons">
                            mode_night
                        </span>
                    </label>
                </div>
    
                <a href="notification.html" class=" btn btn-40 btn-link" data-toggle="modal" data-target="#noticeModal">
                    <span class="material-icons">notifications_none</span>
                    <span class="counter"></span>
                </a>
                
            </div>
        </div>
    </div>
    
</header>


@include(activeTemplate() . 'includes.notice_modal')


