@php
	$captcha = loadCustomCaptcha();
@endphp

@if($captcha)
    <div class="cmn--form--group form-group col-md-12">
        @php echo $captcha @endphp
    </div>
    <div class="cmn--form--group form-group col-md-12 w-100">
        <div class="input-group">
            <input type="text" class="form-control" name="captcha" placeholder="@lang('Enter Code')">
        </div>
    </div>
@endif
