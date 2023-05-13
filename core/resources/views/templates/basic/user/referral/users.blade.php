@extends($activeTemplate . 'layouts.frontend')
@section('content')
@php
    $user = Auth::user();
@endphp

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="main-container">

            <div class="container">

                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Referral Link</label>
                                    <div class="input-group">
                                        <input type="text" name="key" value="{{ route('user.refer.register',[$user->username]) }}" class="form-control" id="referralURL" readonly>
                                        <a class="input-group-text btn btn-warning cursor-pointer copytext"
                                            id="copyBoard">
                                            <i class="lar la-copy"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $segments =request()->segments();
                            $last = end($segments);
                        @endphp
                        <div class="d-flex flex-wrap gap-4">
                            @for ($i = 1; $i <= $lev; $i++)
                                <div class="flex-grow-1 align-self-end p-1">
                                    <a href="{{ route('user.referral.users', $i) }}" class="btn btn-warning border-custom neo-shadow w-100 {{$last == $i ? 'disabled' : ''}}">Level {{$i}}</a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

            </div>

            <div id="existSearch">
                <div class="container">
                    <div class="row">
                        {{ showUserLevel(auth()->user()->id, $levelNo) }}
                    </div>
                </div>
            </div>

        </div>

    </main>

</body>

@endsection
@push('script')
    <script>
        $('.copytext').on('click', function() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            // iziToast.success({
            //     message: "Copied: " + copyText.value,
            //     position: "topRight"
            // });
            notifyMsg("Copied: " + copyText.value,'success')
        });
    </script>
@endpush