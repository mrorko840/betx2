@auth
    <div class="modal-body">
        @csrf
        <input type="hidden" name="option_id">
        <div class="predict-content">
            <h5 class="subtitle betting-details text-center">
                {{ $match->team_1 }}
                <font color="red">VS</font> 
                {{ $match->team_2 }}
            </h5>
            <h6 class="text-center">
                <b>Select Score</b>
            </h6>

            <table class="table table-striped">

                <thead>
                    <tr align="center">
                        <th>@lang('Item')</th>
                        <th>@lang('Profit')</th>
                        <th class="text-right">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $data)
                        <tr align="center">
                            <td data-label="@lang('Item')"><b
                                    style="color: red;font-size: 15px;">{{ getAmount($data->dividend) }} :
                                    {{ getAmount($data->divisor) }}</b></td>
                            <td data-label="@lang('Profit')">{{ $data->profit }}%</td>
                            <td class="text-right" data-label="@lang('Action')">
                                <a class="btn btn-sm btn-info neo-shadow cfc" href="javascript:void(0)" data-profit="{{ $data->profit }}" data-id="{{ $data->id }}">
                                    Select
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br/>


            <div class="form-group text-start">
                <div class="row">
                    <div class="col-12">
                        <div style="display:none" id="msg"> </div>
    
                        <div class="form-group">
                            <label for="amount" class="mb-2">@lang('Enter Bet Amount')</label>
                            <div class="input-group">
                                <input style="color:red! important" type="number" step="any" id="invest-amount"
                                    name="invest_amount" min="{{ $general->min_limit }}" max="{{ $general->max_limit }}"
                                    class="form-control" required>
                                    
                                <span align="right" class="input-group-text">
                                    {{ __($general->cur_text) }}
                                </span>
                            </div>
    
                            <div style="color:red" id="min-bet" style="display:none"><b>Minimum bet is {{@$general->min_limit}} {{@$general->cur_sym}}</b></div>
    
                            <h6 class="mt-2 text-center">
                                <span>Profit : </span>
                                <span id="ppf" style="color: #f7bf42;font-size: 15px;">0</span>
                                <span style="color: #f7bf42;font-size: 15px;">%</span>
                                <br/>
                                You will get <span class="text-success" id="return-amount">0.00
                                    {{ __($general->cur_text) }}</span> if you win
                                <br/>
                                Current Balance : <b> {{ getAmount(Auth::user()->balance) }} {{ __($general->cur_text) }} </b>
                            </h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer py-2">
        <button type="button" class="btn bg-danger text--white border-0 fz--16 neo-shadow"
            data-bs-dismiss="modal">@lang('Close')</button>
        <button id="place-bet" class="btn btn-success border-0 fz--16 neo-shadow">@lang('Proceed')</button>
    </div>
@else
    <div class="modal-body">
        <h5 class="modal-title col text-center">@lang('Login Required')</h5>

        <div class="predict-content">
            <h6 class="subtitle">
                @lang('Placing Bet Requires Login')
            </h6>
            <div class="be-in-limit">
                <span>@lang('If you are already with us then please ')</span> <span><a href="{{ route('user.login') }}"
                        class="text-danger">@lang('login')</a></span> <span>@lang('otherwisw')</span> <span><a
                        href="{{ route('user.register') }}" class="text-success">@lang('register')</a></span>
            </div>
        </div>
    </div>
    <div class="modal-footer py-2">
        <button type="button" class="btn btn-danger btn-sm neo-shadow" data-bs-dismiss="modal">@lang('Close')</button>
        <a href="{{ route('user.login') }}" class="btn btn-sm btn-success neo-shadow">@lang('Login')</a>
    </div>


    @endif
