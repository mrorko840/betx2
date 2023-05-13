@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.gateway.manual.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="height: 110px; background-image: url('{{getImage(imagePath()['gateway']['path'],imagePath()['gateway']['size'])}}')"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="row mt-4 mb-none-15">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-15">
                                            <div class="input-group">
                                                <label class="w-100 font-weight-bold">@lang('Gateway Name') <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control " placeholder="@lang('Method Name')" name="name" value="{{ old('name') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-15">

                                            <div class="input-group">
                                                <label class="w-100 font-weight-bold">@lang('Currency') <span class="text-danger">*</span></label>
                                                <input type="text" name="currency" placeholder="@lang('Currency')" class="form-control border-radius-5" value="{{ old('currency') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6">
                                            <div>
                                                <label class="w-100 font-weight-bold">@lang('Symbol') <span class="text-danger">*</span></label>
                                                <input type="text" name="cur_sym" placeholder="@lang('Symbol')" class="form-control border-radius-5" value="{{ old('cur_sym') }}"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-xl-6 col-md-6">
                                            <label class="form-control-label font-weight-bold"> @lang('Theme Color')</label>
                                            <div class="input-group">
                                            <span class="input-group-addon ">
                                                <input type='text' class="form-control form-control-lg colorPicker" value="{{ old('theme_color') }}"/>
                                            </span>
                                                <input type="text" class="form-control form-control-lg colorCode" name="theme_color" value="{{ old('theme_color') }}"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-xl-6 mb-15">
                                            <label class="w-100 font-weight-bold">@lang('Rate') <span class="text-danger">*</span></label>

                                            <div class="input-group has_append">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">1 {{ __($general->cur_text )}} =</div>
                                                </div>
                                                <input type="text" class="form-control form-control-lg" placeholder="0" name="rate" value="{{ old('rate') }}"/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="currency_symbol"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">

                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card border--primary mt-3">
                                            <h5 class="card-header bg--primary">@lang('Range')</h5>
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <label class="w-100 font-weight-bold">@lang('Minimum Amount') <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ __($general->cur_sym) }}</div>
                                                    </div>
                                                    <input type="text" class="form-control" name="min_limit" placeholder="0" value="{{ old('min_limit') }}"/>
                                                </div>
                                                <div class="input-group">
                                                    <label class="w-100 font-weight-bold">@lang('Maximum Amount') <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ __($general->cur_sym) }}</div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{ old('max_limit') }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="card border--primary mt-3">
                                            <h5 class="card-header bg--primary">@lang('Charge')</h5>
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <label class="w-100 font-weight-bold">@lang('Fixed Charge') <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ __($general->cur_sym) }}</div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ old('fixed_charge') }}"/>
                                                </div>
                                                <div class="input-group">
                                                    <label class="w-100 font-weight-bold">@lang('Percent Charge') <span class="text-danger">*</span></label>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">@lang('%')</div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ old('percent_charge') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Deposit Informations-->
                                    <div class="col-lg-12">
                                        <div class="card border--primary mt-3">

                                            <h5 class="card-header bg--primary">@lang('Deposit Informations')</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-6">
                                                        <div>
                                                            <label class="w-100 font-weight-bold">Phone Number<span class="text-danger">*</span></label>
                                                            <input type="text" name="phone_number" placeholder="Phone Number" class="form-control border-radius-5" value="{{ old('phone_number') }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-6">
                                                        <label class="w-100 font-weight-bold">Number Type<span class="text-danger">*</span></label>
                                                        <select class="form-select w-100" name="number_type">
                                                            <option>Select One</option>
                                                            <option value="personal">Personal</option>
                                                            <option value="agent">Agent</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-md-6">
                                                        <div>
                                                            <label class="w-100 font-weight-bold">Dial Code<span class="text-danger">*</span></label>
                                                            <input type="text" name="dial_code" placeholder="ex: *247#" class="form-control border-radius-5" value="{{ old('dial_code') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="card border--primary mt-3">

                                            <h5 class="card-header bg--primary">@lang('Deposit Instruction')</h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="8" class="form-control border-radius-5 nicEdit" name="instruction">{{ old('instruction') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-12">
                                        <div class="card border--primary mt-3">
                                            <h5 class="card-header bg--primary  text-white">@lang('User data')
                                                <button type="button" class="btn btn-sm btn-outline-light float-right addUserData"><i class="la la-fw la-plus"></i>@lang('Add New')
                                                </button>
                                            </h5>

                                            <div class="card-body">
                                                <div class="row addedField">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Save Method')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('breadcrumb-plugins')
    <a href="{{ route('admin.gateway.manual.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i> @lang('Go Back') </a>
@endpush

@push('script')
    <script>

        (function ($) {
            "use strict";
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.addUserData').on('click', function () {
                var html = `
                    <div class="col-md-12 user-data">
                        <div class="form-group">
                            <div class="input-group mb-md-0 mb-4">
                                <div class="col-md-4">
                                    <input name="field_name[]" class="form-control" type="text" required placeholder="@lang('Field Name')">
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="type[]" class="form-control">
                                        <option value="text" > @lang('Input Text') </option>
                                        <option value="textarea" > @lang('Textarea') </option>
                                        <option value="file"> @lang('File') </option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="validation[]"
                                            class="form-control">
                                        <option value="required"> @lang('Required') </option>
                                        <option value="nullable">  @lang('Optional') </option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-md-0 mt-2 text-right">
                                    <span class="input-group-btn">
                                        <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('.addedField').append(html)
            });

            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            @if(old('currency'))
            $('input[name=currency]').trigger('input');
            @endif

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
        })(jQuery);

    </script>
@endpush
