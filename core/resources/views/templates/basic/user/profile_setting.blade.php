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
                                    <form action="{{route('user.profile.photo')}}" method="POST" enctype="multipart/form-data" id="imgForm">
                                        <div class="avatar-edit">
                                            <input type='file' class="profilePicUpload" id="image" name="image" accept=".png, .jpg, .jpeg" />
                                            <label  class="text-white bg-warning imgEdit" for="image">
                                                <span class="material-icons">photo_camera</span>
                                            </label>
                                        </div>
                                    </form>
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

                <form id="profileSetting" class="user-profile-form" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h6 class="subtitle mb-0">
                                <div class="avatar avatar-40 neo-shadow bg-success-light text-success rounded mr-2"><span
                                        class="material-icons vm">account_circle</span></div>
                                User Informations
                            </h6>
                        </div>
                        
                        <div class="card-body">

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" id="InputFirstname" name="firstname" value="{{@$user->firstname}}">
                                <label class="form-control-label">First Name</label>
                            </div>
                            <div class="form-group float-label active">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{@$user->lastname}}">
                                <label class="form-control-label">Last Name</label>
                            </div>

                            <div class="form-group float-label active">
                                <input type="tel" class="form-control" id="phone" name="mobile" value="{{@$user->mobile}}">
                                <label class="form-control-label">Mobile Number</label>
                            </div>

                            <div class="form-group float-label active">
                                <input type="email" class="form-control" id="email" name="email" value="{{@$user->email}}" readonly>
                                <label class="form-control-label">E-Mail</label>
                            </div>

                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-block btn-default neo-shadow rounded" value="Update Information">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>
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
        //--profile Photo--//
        (function($){

            function proPicURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var preview = $(input).parents('.profile-thumb').find('.profilePicPreview');
                        $(preview).css('background-image', 'url(' + e.target.result + ')');
                        $(preview).addClass('has-image');
                        $(preview).hide();
                        $(preview).fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".profilePicUpload").on('change', function(e) {
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{route('user.profile.photo')}}",
                    data: new FormData($("#imgForm")[0]),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (res) {
                        console.log(res.msg);
                        notifyMsg(res.msg,res.cls)
                        $('.loadProfilePhoto').attr('style', '');
                        $('.loadProfilePhoto').attr('style', "background-image: url('{{route('home')}}/"+res.img+"');");
                    }
                });
                proPicURL(this);

            });

            $(".remove-image").on('click', function(){
            $(".profilePicPreview").css('background-image', 'none');
            $(".profilePicPreview").removeClass('has-image');
            })

        })(jQuery);

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

    </script>
@endpush