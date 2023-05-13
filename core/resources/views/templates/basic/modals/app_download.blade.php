@php
    $yourLinks = getContent('links.content', true);
@endphp

<!-- App Download Modal -->
<div class="modal fade" id="appDownloadModal" tabindex="-1" role="dialog" aria-labelledby="appDownloadModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-custom">
            <div class="modal-header py-2">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Install Software</h5>
                <a href="javascript:void(0)" class="btn btn-danger btn-30 neo-shadow btn-link" data-dismiss="modal">
                    <span class="material-icons las la-times"></span>
                </a>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center">

                    <div class="col-auto text-center">
                        <a class="text-white" href="{{ @$yourLinks->data_values->AppleApps }}">
                            <div class="stat-box appStore border-custom neo-shadow">
                                <i style="font-size: 70px;" class="lab la-app-store"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto text-center d-flex align-items-center">
                        <a href="{{ @$yourLinks->data_values->AndroidApps }}">
                            <div class="stat-box bg-white border-custom neo-shadow d-flex align-items-center justify-content-center pl-1" style="width: 70px; height: 70px;">
                                <svg style="width: 35px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="google-play">
                                    <path fill="#2196F3" d="M8.32 7.68.58 15.42c-.37-.35-.57-.83-.57-1.35V1.93C.01 1.4.22.92.6.56l7.72 7.12z"></path>
                                    <path fill="#FFC107" d="M15.01 8c0 .7-.38 1.32-1.01 1.67l-2.2 1.22-2.73-2.52-.75-.69 2.89-2.89L14 6.33c.63.35 1.01.97 1.01 1.67z"></path>
                                    <path fill="#4CAF50" d="M8.32 7.68.6.56C.7.46.83.37.96.29 1.59-.09 2.35-.1 3 .26l8.21 4.53-2.89 2.89z"></path>
                                    <path fill="#F44336" d="M11.8 10.89 3 15.74c-.31.18-.66.26-1 .26-.36 0-.72-.09-1.04-.29a1.82 1.82 0 0 1-.38-.29l7.74-7.74.75.69 2.73 2.52z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm btn-danger border-custom neo-shadow" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
