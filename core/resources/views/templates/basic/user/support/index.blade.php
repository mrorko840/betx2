@extends($activeTemplate.'layouts.frontend')

@section('content')

    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Support Ticket</h4></div>
            
        </div>

    </div>

    <section class="dashboard-section">
        <div class="container">
            <div class="pb-120">
                <div class="text-end mb-1">
                    <a href="{{route('ticket.open') }}" class="cmn--btn btn--sm">@lang('New Ticket')</a>
                </div>
                <div class="table-responsive">
                    <table class="table bg-white">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">@lang('Subject')</th>
                                <th class="text-white">@lang('Status')</th>
                                <th class="text-white">@lang('Last Reply')</th>
                                <th class="text-white">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($supports as $key => $support)
                                <tr>
                                    <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold text--base"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                    <td data-label="@lang('Status')">
                                        @if($support->status == 0)
                                            <span class="badge badge--success">@lang('Open')</span>
                                        @elseif($support->status == 1)
                                            <span class="badge badge--info">@lang('Answered')</span>
                                        @elseif($support->status == 2)
                                            <span class="badge badge--primary">@lang('Customer Reply')</span>
                                        @elseif($support->status == 3)
                                            <span class="badge badge--danger">@lang('Closed')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('ticket.view', $support->ticket) }}" class="badge badge--success">
                                            <i class="fa fa-desktop"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="100%" class="text-center">@lang('No data found')</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    {{$supports->links()}}
                </ul>
            </div>
        </div>
    </section>
@endsection
