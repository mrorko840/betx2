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

            
            <div align="center" class="col pt-2"><h4 class="text-light">
                <a href="{{route('user.notifications')}}">
                Notifications  </a></h4></div>
            
        </div>

    </div>
    
<section class="cmn-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card table-card">
                    <div class="card-body p-0">
                        
                        
                        <div style="padding:10px">
                        <b> {{ $notification->created_at->diffForHumans() }} </b>
                         <h3 class="text-center"> {!! $notification->subject !!} </h3>
                        
                         <div> {!! $notification->message !!} </div>
                        
                        
                         </div>
                         
                         
                      
                    </div>
                </div>
               
               
               
            </div>
        </div>
    </div>
</section>

<section style="height: 90px;">

</section>
@endsection
