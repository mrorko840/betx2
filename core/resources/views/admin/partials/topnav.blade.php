<?php $adminType = auth()->guard('admin')->user()->type; ?>

<style>
    .mb-nn{
        height:400px! important;
        overflow:auto! important;
    }
</style>
<!-- navbar-wrapper start -->
<nav class="navbar-wrapper">
    <form class="navbar-search" onsubmit="return false;">
        <button type="submit" class="navbar-search__btn">
            <i class="las la-search"></i>
        </button>
        <input type="search" name="navbar-search__field" id="navbar-search__field"
               placeholder="Search...">
        <button type="button" class="navbar-search__close"><i class="las la-times"></i></button>

        <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
    </form>

    <div class="navbar__left">
        <button class="res-sidebar-open-btn"><i class="las la-bars"></i></button>
        <button type="button" class="fullscreen-btn">
            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
            <i class="fullscreen-close las la-compress-arrows-alt" onclick="closeFullscreen();"></i>
        </button>
    </div>

    <div class="navbar__right">
        <ul class="navbar__action-list">
            <li>
                <button type="button" class="navbar-search__btn-open">
                    <i class="las la-search"></i>
                </button>
            </li>


            <li class="dropdown">
                <button type="button" class="primary--layer nbtn" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" <?php if($adminType != 'superadmin' && $adminType != 'admin'){ echo "disabled"; } ?> >
                  <i class="las la-bell text--primary "></i>
                  @if($adminNotificationscount > 0)
                    <span class="pulse--primary"></span>
                  @endif
                </button>
                <div class="dropdown-menu dropdown-menu--md p-0 border-0 box--shadow1 dropdown-menu-right mb-nn">
                  <div class="dropdown-menu__header">
                    <span class="caption">@lang('Notification')</span>
                    @if($adminNotificationscount > 0)
                        <p>@lang('You have') <span id="ncount">{{ $adminNotificationscount }}</span> @lang('unread notification')</p>
                    @else
                        <p>@lang('No unread notification found')</p>
                    @endif
                  </div>
                  <div class="dropdown-menu__body main-noti">
                    @foreach($adminNotifications as $notification)
                    <a href="{{ route('admin.notification.read',$notification->id) }}" class="dropdown-menu__item nitem">
                      <div class="navbar-notifi">
                        <div class="navbar-notifi__left bg--green b-radius--rounded"><img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.@$notification->user->image,imagePath()['profile']['user']['size'])}}" alt="@lang('Profile Image')"></div>
                        <div class="navbar-notifi__right">
                          <h6 class="notifi__title">{{ __($notification->title) }}</h6>
                          <span class="time"><i class="far fa-clock"></i> {{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                      </div><!-- navbar-notifi end -->
                    </a>
                    @endforeach
                  </div>
                  <div class="dropdown-menu__footer">
                    <a href="{{ route('admin.notifications') }}" class="view-all-message">@lang('View all notification')</a>
                  </div>
                </div>
            </li>


            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                  <span class="navbar-user">
                    <span class="navbar-user__thumb"><img src="{{ getImage('assets/admin/images/profile/'. auth()->guard('admin')->user()->image) }}" alt="image"></span>
                    <span class="navbar-user__info">
                      <span class="navbar-user__name">{{auth()->guard('admin')->user()->name.' ('.auth()->guard('admin')->user()->type.') ' }}</span>
                    </span>
                    <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                  </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                    <a href="{{ route('admin.profile') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{route('admin.password')}}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption">@lang('Password')</span>
                    </a>

                    <a href="{{ route('admin.logout') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- navbar-wrapper end -->

@push('script-lib')
<script>
function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

var noti = $('#ncount').html();
noti = parseInt(noti) || 0;

setInterval(function(){
    
$.ajax({
            type: 'GET',
            url: "{{ route('admin.ajax-noti') }}?t="+makeid(10),
            success:function(data){
                var data = JSON.parse(data);
                $('.main-noti').html(data.html);
                $('#ncount').html(data.count);
                if ( data.count > noti){
                   var audio = new Audio('{{url('')}}/assets/admin/smile-ringtone.mp3');
                   audio.play();
                }
                noti = data.count;
            }
});

}, 5000);
    
</script>
@endpush