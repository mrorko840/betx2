@extends($activeTemplate.'layouts.frontend')

@section('content')






<div class="bg-primary container pt-4 pb-3 mt-5 mb-2">
    <div class="row">

        
        <div class="col-7 pt-1 ps-2">
            
            <h2 class="text-light">Deposit</h2>
            <h6 class="text-light">You can <b> Diposit</b> here</h6>
            <h6 class="text-light">for<b> Beting</b></h6>
        </div>

        <div align="center" class="col-5"><img width="90px" src="https://i.ibb.co/L1HScH9/5-F867-FDB-41-C9-488-D-913-C-16-FDDD5-BDFF0-1.png" /></div>

    </div>

</div>




<section class="cmn-section">

    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group text-center">

                            <p class="list-group-item border border-primary">
                                @lang('Amount'):
                                <strong>{{showAmount($data->amount)}} </strong> {{$general->cur_text}}
                            </p>
                            
                            <p class="list-group-item border border-danger">
                                @lang('Charge'):
                                <strong>{{showAmount($data->charge)}}</strong> {{$general->cur_text}}
                            </p>
                            
                            
                            <p class="list-group-item border border-danger">
                                @lang('Total Amount'):
                                <strong>{{showAmount($data->final_amo)}}</strong> {{$general->cur_text}}
                            </p>
                            
                            @if( $data->status == 0 )
                            
                            <b>Status : </b> <b class="text text-danger"> Pending </b>
                            
                            <p>Status will be automatically changed and payment will be approved once we have received the payment
                            , if status is not changed automatically please manually <a href="">refresh</a> this page.
                            </p>
                            @endif
                            
                            
                             @if( $data->status == 1 )
                             
                             <b>Status : </b> <b class="text text-success"> Success </b>
                             
                             @endif
                            
                            
                            
                            
                            
                            <p style="text-align: center; margin-right: 0px; margin-left: 0px; font-size: 14px; padding: 0px; list-style: none; outline: none; font-family: Arial, &quot;Microsoft YaHei&quot;;">
                            <b style="">
                            <font color="#ff9900">PAY TO THIS ADDRESS</font>
                            </b>
                            </p>
                            
                            <p style="margin-right: 0px; margin-left: 0px; padding: 0px; list-style: none; outline: none;text-align:center">
                                <font color="#333333" face="Arial, Microsoft YaHei">
                                <b>
                                <input type="text" id="vv" value="{{ $data->btc_wallet }}" readonly="" style="color: black! important;width: 100%;"> 
                              </b>
                              </font>
                              </p>
                            <button class="btn btn-success" onclick="myFunction()">Click To Copy Address</button>
<script>
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("vv");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied address: " + copyText.value);
}
</script>
                            
                        </ul>

                        
                        <br/>
                        <br/>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@push('style')
<style type="text/css">
    .p-prev-list img{
        max-width:100px; 
        max-height:100px; 
        margin:0 auto;
    }
</style>
@endpush

