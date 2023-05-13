@extends($activeTemplate.'layouts.frontend')
@section('content')

    @php
        $bannerElements = getContent('banner.element');
    @endphp
     
    <style>
        .bet-info{
            width:100%;
        }
    </style>
    <main class="all-sections1">
       <!-- <div class="container-fluid">-->
            <div class="row g-4">
               
                <article class="col-sm-12">
                    @if(Request::routeIs('home'))
                        <div class="banner-wrapper owl-theme owl-carousel">
                            @foreach ($bannerElements as $item)
                                <div class="banner-item">
                                    <a class="d-block">
                                        <img src="{{ getImage('assets/images/frontend/banner/'.@$item->data_values->image,'1150x650') }}" alt="banner">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </article>
               <br/>
                <div class="mhome row">
                    
                <div class="col-sm-2">
                  @include($activeTemplate.'partials.leftbar')
                  </div>
                  
                <div class="col-sm-10">
                
              <div class="predict__wrapper">
                          
                        <div class="predict__header">
                            <h5 class="predict__header-title">
                              All Matches
                            </h5>
                        </div>
                
                       <div class="predict__area bg--section">
                          
                           <div class="row">
                            @foreach ($matches as $item)
                           
                            <div class="col-md-4">
                            <a class="bet-info" data-id="{{ $item->id }}" href="javascript:void(0);">
                              <div class="predict__item bg--body">
                                  
                                  <span style="color:white;font-size:14px">{{ date('Y-m-d H:i', strtotime($item->match_time) ) }}</span>
                                  
                                <div class="predict__item-header">
                                        <h6 class="predict__item-title">
                                           {{$item->team_1}} 
                                           
                                         <img style="width:20px;height:20px" src="{{ url('/assets/images') }}/vs.png" />
                                           
                                         {{ $item->team_2 }}
                                        </h6>
                                        <div class="clear"></div>
                                        
                                         <span style="font-size:14px;color:yellow;clear:both;">Starts In : 
                                         <span data-date="{{ date('Y-m-d H:i:s', strtotime($item->match_time) ) }}" class="mtime"></span>
                                         </span>
                                        
                                </div>
                            </div>
                            </a>
                            </div>
                            
                            @endforeach
                            </div>
                        
                       
                      </div>
                      
                  </div>
                
                 </div>
              
              
                 
                </div>
                 {{--
                 @include($activeTemplate.'partials.rightbar')
                 --}}

            </div>
       <!-- </div>-->
    </main>

    @if($sections->secs == time())
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
