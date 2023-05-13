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

            <form id="addressSetting" class="user-profile-form" action="" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <h6 class="subtitle mb-0">
                            <div class="avatar avatar-40 bg-warning-light text-warning neo-shadow rounded mr-2"><span
                                    class="material-icons vm">location_city</span></div>
                            User Address
                        </h6>
                    </div>
                    
                    <div class="card-body">

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="state" name="state" value="{{@$user->address->state}}">
                            <label class="form-control-label">State</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="zip" name="zip" value="{{@$user->address->zip}}">
                            <label class="form-control-label">Zip Code</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="city" name="city" value="{{@$user->address->city}}">
                            <label class="form-control-label">City</label>
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="address" name="address" value="{{@$user->address->address}}">
                            <label class="form-control-label">Address</label>
                        </div>

                        <div class="form-group float-label active">
                            <select class="form-control" id="country" name="country" required>
                                @foreach ($countries as $country)
                                    <option @if($country->country == $user->address?->country) selected @endif value="{{ $country->country }}">{{ __($country->country) }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id="country" name="country" value="{{@$user->address->country}}" readonly> --}}
                            <label class="form-control-label">Country</label>
                        </div>

                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-block btn-default neo-shadow rounded" value="Update Address">
                    </div>

                </div>

            </form>

        </div>
    </div>
</main>


    
    {{-- <div class="container pb-2" align="right">
        <a href="{{route('user.change.password')}}">
            <div class="btn btn-warning">
                Change Password
            </div>
        </a>
    </div>
    
    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="profile-wrapper bg-white shadow">
                    <div class="profile-user mb-lg-0">
                        <div class="thumb">
                            @if($user->image)
                                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }}" class="rounded-circle" width="150px" alt="user">
                            @else
                                <img src="{{ asset('assets/images/avatar.png') }}" class="rounded-circle" width="150px" alt="user">
                            @endif
                        </div>
                        <div class="content">
                            <h3 class="title">@lang('Name'): {{__($user->fullname)}}</h3>
                            <span class="subtitle">@lang('Username'): {{$user->username}}</span>
                        </div>
                    </div>
                    <div class="profile-form-area">
                        <form class="profile-edit-form row mb--25" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="first-name">@lang('First Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}" minlength="3" required>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="last-name">@lang('Last Name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  name="lastname" value="{{$user->lastname}}" minlength="3" required>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="email">@lang('E-mail Address') <span class="text-danger">*</span></label>
                                <input name="email" type="text" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="mobile">@lang('Mobile Number') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$user->mobile}}" readonly>
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="address">@lang('Address') </label>
                                <input type="text" class="form-control" name="address" value="{{@$user->address->address}}">
                            </div>
                            
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="zip">@lang('Zip') </label>
                                <input type="text" class="form-control" name="zip" value="{{@$user->address->zip}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="city">@lang('City') </label>
                                <input type="text" class="form-control" name="city" value="{{@$user->address->city}}">
                            </div>
                            <div class="form--group col-md-6">
                                <label class="cmn--label" for="country">@lang('Country') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{@$user->address->country}}" disabled>
                            </div>
                            <div class="form--group col-md-12">
                                <label class="cmn--label" for="profile-image">@lang('Profile Picture')</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="form--group w-100 col-md-6 mb-0 text-end">
                                <button type="submit" class="cmn--btn w-100 justify-content-center">@lang('Update Profile')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .imgEdit {
            width: 35px !important; 
            height: 35px !important; 
            margin-left: -3.5rem !important; 
            margin-bottom: 1.5rem !important;
        }
    </style>
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

@push('script')
    <script>

        //-- Proile Setting --//
        $(document).on('submit', '#profileSetting', function (e) {
            e.preventDefault();
            let formData = new FormData($("#profileSetting")[0])
            $.ajax({
                type: "POST",
                url: "{{route('user.profile.submit')}}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg,res.cls)
                },
                error: function (err) {
                    let errors = err.responseJSON.errors
                    let allErr = [];
                    $.each(errors, function (index, value) { 
                        allErr += value+'<br>'
                    });
                    console.log(allErr);

                    notifyMsg(allErr, 'error')
                }
            });
        });

        //-- Address Setting --//
        $(document).on('submit', '#addressSetting', function (e) {
            e.preventDefault();
            let formData = new FormData($("#addressSetting")[0])
            $.ajax({
                type: "POST",
                url: "{{route('user.address.submit')}}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg,res.cls)
                }
            });
        });

    </script>
@endpush