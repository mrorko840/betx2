@extends($activeTemplate . 'layouts.frontend')

@section('content')

<div class="container">
    <div class="withdraw-preview">
        <div class="withdraw-content my-2">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Request Amount
                    <span class="badge badge-primary badge-pill">{{ showAmount($withdraw->amount) }} {{ __($general->cur_text) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Withdrawal Charge
                    <span class="badge badge-danger badge-pill">{{ showAmount($withdraw->charge) }} {{ __($general->cur_text) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    After Charge
                    <span class="badge badge-warning badge-pill">{{ showAmount($withdraw->after_charge) }} {{ __($general->cur_text) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Conversion Rate
                    <span class="badge badge-info badge-pill">1 {{ __($general->cur_text) }} = {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    You Will Get
                    <span class="badge badge-success badge-pill">{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Balance Will be
                    <span class="badge badge-orange badge-pill">{{ showAmount($withdraw->user->balance - $withdraw->amount) }} {{ __($general->cur_text) }}</span>
                </li>
            </ul>
        </div>
        <div class="withdraw-form-area">
            <form class="withdraw-form" action="{{ route('user.withdraw.submit') }}" method="post"
                enctype="multipart/form-data">
                @csrf

                @if ($withdraw->method->user_data)
                    @foreach ($withdraw->method->user_data as $k => $v)
                        @if ($v->type == 'text')
                            <div class="form-group">
                                <label for="name" class="cmn--label">{{ __($v->field_level) }} @if ($v->validation == 'required')
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="{{ $k }}"
                                    value="{{ old($k) }}" placeholder="{{ __($v->field_level) }}"
                                    @if ($v->validation == 'required') required @endif>

                                @if ($errors->has($k))
                                    <small class="text-danger">{{ __($errors->first($k)) }}</small>
                                @endif
                            </div>
                        @elseif($v->type == 'textarea')
                            <div class="form-group">
                                <label for="name" class="cmn--label">{{ __($v->field_level) }} @if ($v->validation == 'required')
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <textarea class="form-control" name="{{ $k }}" placeholder="{{ __($v->field_level) }}"
                                    @if ($v->validation == 'required') required @endif>{{ old($k) }}</textarea>

                                @if ($errors->has($k))
                                    <small class="text-danger">{{ __($errors->first($k)) }}</small>
                                @endif
                            </div>
                        @elseif($v->type == 'file')
                            <div class="form-group">
                                <label for="name" class="cmn--label">{{ __($v->field_level) }} @if ($v->validation == 'required')
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input type="file" class="form-control" name="{{ $k }}" accept="image/*"
                                    @if ($v->validation == 'required') required @endif>

                                @if ($errors->has($k))
                                    <small class="text-danger">{{ __($errors->first($k)) }}</small>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endif

                {{-- @if (auth()->user()->ts)
                <div class="form-group mb-4">
                    <label class="cmn--label">@lang('Google Authenticator Code') <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="authenticator_code" required>
                </div>
            @endif --}}
                <div class="form--group mb-2">
                    <button type="submit" class="btn btn-sm btn-warning border-custom w-100">Withdraw Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
