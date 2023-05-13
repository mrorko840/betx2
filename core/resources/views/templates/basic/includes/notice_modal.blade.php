@php
$noticeCaption = getContent('notice.content',true);
@endphp
<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Notice</h5>
                <a href="javascript:void(0)" class="btn btn-danger btn-30 neo-shadow btn-link" data-dismiss="modal">
                    <span class="material-icons las la-times"></span>
                </a>
            </div>
            <div class="modal-body">
                @php 
                    echo $noticeCaption->data_values->YourNotice;
                @endphp
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary neo-shadow" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>