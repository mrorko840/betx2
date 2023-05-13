<?php $adminType = auth()->guard('admin')->user()->type; ?>

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
                 