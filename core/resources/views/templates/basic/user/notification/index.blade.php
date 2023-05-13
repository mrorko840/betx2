@extends($activeTemplate.'layouts.frontend')
@section('content')
    <style>
        .unread{
            background: #efeff0;
            color: #958d9e;
        }
    </style>

    <div style="background-image: linear-gradient(to bottom right, rgb(103, 103, 105), rgb(75, 74, 75));" class="container pt-5 pb-3 mt-5 mb-2">
        <div class="row">

            
            <div align="center" class="col pt-2"><h4 class="text-light">Notifications</h4></div>
            
        </div>

    </div>
    
<section class="cmn-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card table-card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm">
                            <table class="table">
                                <thead class="bg-primary rounded">
                                <tr>
                                    <th class="text-white">@lang('Subject')</th>
                                    <th class="text-white">@lang('Time')</th>
                                    <th class="text-white">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($notifications as $item)
                                <tr class="@if ( $item->status == '0') unread @endif">

                                    <td data-label="@lang('Subject')">
                                        {{ $item->subject }}
                                    </td>
                                   
                                    <td data-label="@lang('Time')"> {{ $item->created_at->diffForHumans() }} </td>

                                    <td data-label="@lang('Action')">
                                        
                                        <a class="btn-success" href="{{ route('user.notification.details', $item->id) }}">Read Message</a>
                                        
                                         </td>
                                </tr>
                                    @empty
                                <tr><td colspan="100%" class="text-center">{{__($emptyMessage)}}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <ul class="pagination justify-content-end">
                    {{$notifications->links()}}
                </ul>
            </div>
        </div>
    </div>
</section>

<section style="height: 90px;">

</section>
@endsection

