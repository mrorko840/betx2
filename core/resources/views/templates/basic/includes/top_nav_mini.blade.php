<?php 
$user = Auth::user(); 
$noticeCaption = getContent('notice.content',true);
?>

<!-- Fixed navbar -->
<header class="header">
    <div class="row">
        <div class="col-auto px-0">
            <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                <span class="material-icons">keyboard_arrow_left</span>
            </button>
        </div>
        <div class="text-left col align-self-center">
            <a class="navbar-brand" href="#">
                <h5 class="mb-0 text-neo-shadow text-secondary">{{ @$pageTitle }}</h5>
            </a>
        </div>
        <div class="ml-auto col-auto">
            <a href="{{route('user.home')}}" class="avatar avatar-30 neo-shadow rounded-circle ml-2">
                <figure class="m-0 background loadProfilePhoto">
                    <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                </figure>
            </a>
        </div>
    </div>
</header>