@extends($activeTemplate .'layouts.auth')
@section('content')
    @php
	    $authBackground = getContent('auth_page.content',true)->data_values;
    @endphp
    
    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute mb-3">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="{{ route('user.register') }}" class="headerButton">
                Register
            </a>
        </div>
    </div>
    <!-- * App Header -->
    
    
<!-- App Capsule -->
<div id="appCapsule">
    <div>
        <div>
                <div class="mt-5">
                <!--<div align="center" class="bg-primary mb-2">-->
                <!--    <a href="{{route('home')}}">-->
                <!--        <img src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" width="230px" alt="logo">-->
                <!--    </a>-->
                <!--</div>-->
                <div class="container">
                    <div class="container bg-white rounded shadow py-3">
                        <h3 class="text-center text-dark">@lang('Reset Password')</h3>
    
                        <form class="account-form" action="{{ route('user.password.email') }}" method="POST">
                            @csrf
        
                            <div class="cmn--form--group form-group">
                                <label for="username" class="cmn--label text-dark w-100">@lang('Select One')</label>
                                <div class="input-group">
                                    <select class="form-control" name="type">
                                        <option value="email">@lang('E-Mail Address')</option>
                                        <option value="username">@lang('Username')</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="cmn--form--group form-group">
                                <label for="username" class="cmn--label text-dark w-100 my_value"></label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off">
        
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="cmn--form--group form-group">
                                <button type="submit" class="cmn--btn w-100 justify-content-center">@lang('Send Password Code')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>

        (function($){
            "use strict";

            myVal();
            $('select[name=type]').on('change',function(){
                myVal();
            });
            function myVal(){
                $('.my_value').text($('select[name=type] :selected').text());
            }
        })(jQuery)
    </script>
@endpush
