@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $banners = getContent('banner.element');
        $bannerElements2 = getContent('banner_2.element');
        $fakeCount = getContent('fake_count.content', true);
        $noticeCaption = getContent('notice.content', true);
        $sponsors = getContent('sponsor.element');
        $fake_reviews = getContent('fake_review.element');
    @endphp
    @include($activeTemplate . 'liveonline')


    <body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">


        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @guest
                @include($activeTemplate . 'includes.home.top_nav')
            @endguest

            @auth
                @include($activeTemplate . 'includes.top_nav')
                @include($activeTemplate . 'includes.side_nav')
            @endauth


            <div class="main-container">

                <!-- Scrolling Banner -->
                <div class="container-fluid pb-3">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner border-custom neo-shadow">

                            @php $i=0; @endphp
                            @forelse($banners as $item)
                                @php
                                    $actives = '';
                                @endphp

                                @if ($i == 0)
                                    @php $actives = 'active';@endphp
                                @endif
                                @php $i=$i+1; @endphp

                                <div class="carousel-item <?= $actives ?>">
                                    <img class="d-block w-100"
                                        src="{{ getImage('assets/images/frontend/banner/' . $item->data_values->image) }}"
                                        alt="banner">
                                </div>

                            @empty
                            @endforelse

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <!-- Scrolling Notice -->
                <div class="row pt-1 mx-2 mb-3">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-body p-0 px-2">
                                <div class="row">
                                    <div
                                        class="col-auto d-flex align-items-center justify-content-center border-custom bg-warning-light text-warning">
                                        <span class="material-icons">campaign</span>
                                    </div>
                                    <div class="col align-items-center px-0 mx-0 pt-2">
                                        <marquee behavior="scroll" direction="left">
                                            @php
                                                echo $noticeCaption->data_values->sliding_notice;
                                            @endphp
                                        </marquee>
                                    </div>
                                    <div style="font-size: 10px"
                                        class="col-auto d-flex align-items-center justify-content-center border-custom bg-default-secondary">
                                        <span style="font-size: 17px"
                                            class="material-icons">groups</span>{{ '-' }} <b
                                            id="dynamic_counter"></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today & Tomorrow Match Heading -->
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item nav-item-custom">
                        <a style="background-color: #fff0;" class="nav-link nav-link-custom active" id="today-tab" data-toggle="tab"
                            href="#today" role="tab" aria-controls="today" aria-selected="true">Today Match</a>
                    </li>
                    <li class="nav-item">
                        <a style="background-color: #fff0;" class="nav-link nav-link-custom" id="tomorrow-tab" data-toggle="tab"
                            href="#tomorrow" role="tab" aria-controls="tomorrow" aria-selected="false">Tomorrow Match</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <!-- Today Match -->
                    <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                        <div class="mt-4">
                            @foreach ($matches as $item)
                                <div class="container">
                                    <div class="card border-0 mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div align="center" class="col-4">
                                                    <div
                                                        class="neo-shadow avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                        <img width="50" height="50" src="{{ $item->logo_1 }}"
                                                            alt="team_1">
                                                    </div>
                                                    <div class="text-center pt-2">
                                                        <p>{{ $item->team_1 }}</p>
                                                    </div>
                                                </div>
                                                <div style="flex-direction: column;"
                                                    class="col d-flex align-items-center justify-content-center text-center">
                                                    <h6 class="mb-1">{{ __($item->category->name) }}</h6><br>
                                                    <a class="bet-info btn btn-sm btn-primary neo-shadow border-custom"
                                                        data-id="{{ $item->id }}" href="javascript:void(0);">
                                                        Bet Now
                                                    </a>
                                                </div>
                                                <div align="center" class="col-4">
                                                    <div
                                                        class="neo-shadow avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                        <img width="50" height="50" src="{{ $item->logo_2 }}"
                                                            alt="item_2">
                                                    </div>
                                                    <div class="text-center pt-2">
                                                        <p>{{ $item->team_2 }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tomorrow Match -->
                    <div class="tab-pane fade" id="tomorrow" role="tabpanel" aria-labelledby="tomorrow-tab">
                        <div class="mt-4">
                            @foreach ($matches_t as $item)
                                <div class="container">
                                    <div class="card border-0 mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div align="center" class="col-4">
                                                    <div
                                                        class="neo-shadow avatar avatar-50  border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                        <img width="50" height="50" src="{{ $item->logo_1 }}"
                                                            alt="team_1">
                                                    </div>
                                                    <div class="text-center pt-2">
                                                        <p>{{ $item->team_1 }}</p>
                                                    </div>
                                                </div>
                                                <div style="flex-direction: column;"
                                                    class="col d-flex align-items-center justify-content-center text-center">
                                                    <h6 class="mb-1">{{ __($item->category->name) }}</h6><br>
                                                    <a class="bet-info btn btn-sm btn-primary neo-shadow border-custom"
                                                        data-id="{{ $item->id }}" href="javascript:void(0);">
                                                        Bet Now
                                                    </a>
                                                </div>
                                                <div align="center" class="col-4">
                                                    <div
                                                        class="neo-shadow avatar avatar-50 border-0 bg-danger-light rounded-circle shadow-sm text-danger">
                                                        <img width="50" height="50" src="{{ $item->logo_2 }}"
                                                            alt="item_2">
                                                    </div>
                                                    <div class="text-center pt-2">
                                                        <p>{{ $item->team_2 }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>

                <!-- Swiper Our Reviews-->
                <div class="container mb-4">
                    <div class="row mb-3">
                        <div class="col">
                            <h6 class="subtitle mb-0">Our Reviews</h6>
                        </div>
                    </div>
                    <div class="swiper-container swiper-users ">
                        <div class="swiper-wrapper" style="padding-left: 0.6rem !important;">
                            @forelse($fake_reviews as $review)
                                <div class="swiper-slide">
                                    <div style="min-height: 180px; width: 320px;" class="card my-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="neo-shadow avatar avatar-60 rounded mb-1">
                                                        <div class="background"><img
                                                                src="{{ getImage('assets/images/frontend/fake_review/' . @$review->data_values->image) }}"
                                                                alt=""></div>
                                                    </div>
                                                    <p class="text-secondary mb-0">
                                                        <small>{{ @$review->data_values->name }}</small></p>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col ">
                                                    <p class="mb-1">{{ @$review->data_values->review_text }}<small
                                                            class="text-success" hidden>28% <span
                                                                class="material-icons small"
                                                                hidden>call_made</span></small></p>
                                                    <p class="text-secondary small">
                                                        {{ showDateTime(@$review->updated_at, 'd-m-Y, h:i a') }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- footer-->
        @guest
            @include($activeTemplate . 'includes.home.bottom_nav')
        @endguest
        @auth
            @include($activeTemplate . 'includes.bottom_nav')
        @endauth


    </body>
@endsection
