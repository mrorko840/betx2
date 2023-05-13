@extends($activeTemplate.'layouts.frontend')

@section('content')

<!-- page content start -->
<main class="flex-shrink-0 main">
    @include(activeTemplate() . 'includes.top_nav_mini')

    <div class="main-container">
        <div class="container">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row user-profile text-center">
                        <div  class="col-auto profile-thumb-wrapper text-center ms-1 mt-4 mb-3">
                            <div style="width: 7.25rem; height: 7.25rem;" class="profile-thumb">
                                <div class="avatar-preview">
                                    <div style="width: 7.25rem; height: 7.25rem; background-image: url( '{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}' );" class="profilePicPreview rounded-circle" style=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center">
                            <div>
                                <h6 class="title">{{ __($user->fullname) }}</h6>
                                <span class="align-middle">@lang('user id'): {{ __($user->username) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="subtitle mb-0">
                        <div class="avatar avatar-40 bg-default-light text-default neo-shadow rounded mr-2"><span
                                class="material-icons vm">lock</span></div>
                        Change Password
                    </h6>
                </div>
                <form id="changePassword" action="" method="post" class="register">
                    @csrf
                    <div class="card-body">

                        <div class="form-group float-label active">
                            <input id="password" type="password" class="form-control" name="current_password" required
                                autocomplete="current-password" autofocus>
                            <label class="form-control-label">Current Password</label>
                        </div>
                        <div class="form-group float-label">
                            <input id="confirm_password" type="password" class="form-control" name="password" required
                                autocomplete="current-password">
                            <label class="form-control-label">New Password</label>
                            @if ($general->secure_password)
                                <div class="progress mt-2">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                <p class="text-danger my-1 capital">@lang('Minimum 1 capital letter is required')</p>
                                <p class="text-danger my-1 number">@lang('Minimum 1 number is required')</p>
                                <p class="text-danger my-1 special">@lang('Minimum 1 special character is required')</p>
                            @endif
                        </div>

                        <div class="form-group float-label">
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="current-password">
                            <label class="form-control-label">Confirm New Password</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-block btn-default neo-shadow rounded" value="Update Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

    {{-- <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="profile-wrapper  bg-white shadow">
                    <div class="profile-user mb-lg-0">
                        <div class="thumb">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. auth()->user()->image,imagePath()['profile']['user']['size']) }}" class="rounded-circle" width="150px" alt="user">
                        </div>
                        <div class="content">
                            <h6 class="title">@lang('Name'): {{__(auth()->user()->fullname)}}</h6>
                            <span class="subtitle">@lang('Username'): {{auth()->user()->username}}</span>
                        </div>
                    </div>
                    <div class="profile-form-area">
                        <form class="profile-edit-form row mb--25" action="" method="POST">
                            @csrf
                            <div class="form--group col-md-12">
                                <label class="cmn--label" for="first-name">@lang('Current Password')</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                            <div class="form--group col-md-12 hover-input-popup">
                                <label class="cmn--label" for="first-name">@lang('New Password')</label>
                                <input type="password" class="form-control" name="password" required>
                                @if($general->secure_password)
                                    <div class="input-popup">
                                      <p class="error lower">@lang('1 small letter minimum')</p>
                                      <p class="error capital">@lang('1 capital letter minimum')</p>
                                      <p class="error number">@lang('1 number minimum')</p>
                                      <p class="error special">@lang('1 special character minimum')</p>
                                      <p class="error minimum">@lang('6 character password')</p>
                                    </div>
                                @endif
                            </div>
                            <div class="form--group col-md-12">
                                <label class="cmn--label" for="first-name">@lang('Confirm Password')</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form--group w-100 col-md-6 mb-0 text-end">
                                <button type="submit" class="cmn--btn w-100 justify-content-center">@lang('Change Password')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/build/css/intlTelInput.css') }}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100% !important;
        }

        .profile-thumb {
            position: relative;
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: inline-flex;
        }

        .profile-thumb .profilePicPreview {
            width: 11.25rem;
            height: 11.25rem;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            display: block;
            border: 3px solid #ffffff;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.25);
            background-size: cover;
            background-position: center;
        }

        .profile-thumb .profilePicUpload {
            font-size: 0;
            opacity: 0;
        }

        .profile-thumb .avatar-edit {
            position: absolute;
            right: -15px;
            bottom: -20px;
        }

        .profile-thumb .avatar-edit input {
            width: 0;
        }

        .profile-thumb .avatar-edit label {
            width: 45px;
            height: 45px;
            background-color: #37ebec;
            border-radius: 50%;
            text-align: center;
            line-height: 45px;
            border: 2px solid #ffffff;
            font-size: 18px;
            cursor: pointer;
            color: #000000;
        }
    </style>
@endpush

@push('style')
<style>
    .hover-input-popup {
        position: relative;
    }
    .hover-input-popup:hover .input-popup {
        opacity: 1;
        visibility: visible;
    }
    .input-popup {
        position: absolute;
        bottom: 130%;
        left: 50%;
        width: 280px;
        background-color: #1a1a1a;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .input-popup::after {
        position: absolute;
        content: '';
        bottom: -19px;
        left: 50%;
        margin-left: -5px;
        border-width: 10px 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #1a1a1a transparent;
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .input-popup p {
        padding-left: 20px;
        position: relative;
    }
    .input-popup p::before {
        position: absolute;
        content: '';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        left: 0;
        top: 4px;
        line-height: 1;
        font-size: 18px;
    }
    .input-popup p.error {
        text-decoration: line-through;
    }
    .input-popup p.error::before {
        content: "\f057";
        color: #ea5455;
    }
    .input-popup p.success::before {
        content: "\f058";
        color: #28c76f;
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
<script>
    (function ($) {
        "use strict";
        @if($general->secure_password)
            $('input[name=password]').on('input',function(){
                secure_password($(this));
            });
        @endif
    })(jQuery);

    $(document).on('submit', '#changePassword', function(e) {
        e.preventDefault();
        let formData = new FormData($("#changePassword")[0])
        $.ajax({
            type: "POST",
            url: "{{route('user.password.submit')}}",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                console.log(res);
                notifyMsg(res.msg, res.cls)
                if (res.cls=='success') {
                    $("#changePassword")[0].reset()
                }
            }
        });
    });
</script>
@endpush
