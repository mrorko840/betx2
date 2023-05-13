<style>
    .bg-gradiant {
        background-image: linear-gradient(to bottom right, #ffffff73, #00000038) !important;
    }

    .bg-img-match {
        background-image: url('https://i.ibb.co/z5bsfg1/web-banner-design-with-soccer-ball-goal-post-night-background-text-soccer-tournament-1302-10525-2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        padding: 10px 20px 0;
        border-radius: 15px;
    }

    .bg-img-match2 {
        background-image: url('https://i.ibb.co/rw6hJRS/web-banner-design-with-soccer-ball-goal-post-night-background-text-soccer-tournament-1302-10525-3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        padding: 10px 20px 0;
        border-radius: 15px;
    }

    .bg-img-deposit {
        background-image: url('https://i.ibb.co/r2Zgg61/credit-card-PNG99-copy.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        padding: 10px 20px 0;
        border-radius: 15px;
    }

    .bg-img-withdraw {
        background-image: url('https://i.ibb.co/r2Zgg61/credit-card-PNG99-copy.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        padding: 10px 20px 0;
        border-radius: 15px;
    }


    .avatar {
        position: relative;
        overflow: hidden;
        display: inline-block;
        vertical-align: middle;
        padding: 0;
        text-align: center;
    }

    .avatar.avatar-40 {
        height: 40px;
        line-height: 40px;
        width: 40px;
    }

    .bg-white-light {
        background-color: rgba(255, 255, 255, 0.2) !important;
    }

    .bg-danger,
    .btn-danger {
        color: #fff !important;
    }

    .bg-info,
    .btn-info {
        color: #fff !important;
    }

    .card-num {
        display: block;
        margin-block-start: 1.33em;
        margin-block-end: 1.33em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
        font-family: "Poppins", sans-serif;
        font-size: 20px;
        line-height: 1.6rem;
        letter-spacing: 0.1em;

    }


    .owl-carousel .owl-stage {
        display: flex;
    }

    .owl-carousel .owl-item img {
        max-width: 700px;
        margin: 0 auto;
    }

    .sidebar {
        flex: 0 0 220px;
    }

    .owl-dots {
        display: none;
    }

    .image-listview>li a.item {
        color: white !important;
    }

    @media only screen and (max-width: 767px) {

        .owl-carousel .owl-item img {
            height: 160px !important;
        }

        .mhome.row,
        .mhome .container {
            margin: 0 ! important;
            padding: 0 ! important;
        }

    }

    @media only screen and (min-width: 767px) {

        .predict__area .bg--body {
            background: url('{{ url('/assets/images') }}/bg.jpg');
            background-size: cover;
        }
    }

    .predict__item-title {
        font-size: 16px;
    }

    .predict__item {
        padding: 0px;
        padding-left: 10px;
        padding-top: 10px;
        margin-bottom: 2px;
    }

    .loginBtn {
        background-image: linear-gradient(to right, #00c4ff 0%, #ce35dc 100%);
        color: white;
        border: 0px solid transparent;
    }

    .loginBtn:hover {
        background-image: linear-gradient(to left, #00c4ff 0%, #ce35dc 100%);
        color: white;
        border: 0px solid transparent;
    }

    .appStore {
        color: #fff;
        background: rgb(26, 117, 243);
        background: linear-gradient(6deg, rgba(26, 117, 243, 1) 35%, rgba(73, 188, 248, 1) 100%);
    }

    .shadow-custom {
        box-shadow: 0px 0px 8px 0px rgb(0 0 0 / 43%) !important;
    }

    .gatewayItem {
        border-radius: 11px;
        border: 1px solid #dee2e6;
        cursor: pointer;
        background: linear-gradient(145deg, #f0f0f0, #cacaca);
        box-shadow:  5px 5px 10px #b3b3b3,
                    -5px -5px 10px #ffffff;
    }

    .gatewayActive {
        border: 1px solid #ffc107 !important;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #b3b3b3,
                    inset -5px -5px 10px #ffffff;
    }

    .gatewayItem img {
        max-width: 110px;
        width: 100%;
        transition: transform .2s;
    }

    .gatewayItem img:hover {
        transform: scale(1.1);
    }


    /* == Neumorphism Start == */
    body {
        background-color: #e0e0e0;
    }

    /* header */
    .header {
        background-color: #e0e0e0;
    }

    .header.active {
        background: linear-gradient(145deg, #f0f0f0, #cacaca);
    }

    /* footer */
    .footer {
        padding: 0 15px;
        border-radius: 20px;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 99;
        align-self: center;


        background: linear-gradient(145deg, #f0f0f0, #cacaca);
        box-shadow: 5px 5px 10px #b3b3b3,
            -5px -5px 10px #ffffff;
    }

    .footer a:not(.btn).active {
        color: #00b3ff;
        border-color: #00b3ff;
        border-radius: 50%;
        height: 55px;
        width: 55px;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #b3b3b3,
            inset -5px -5px 10px #ffffff;
    }

    .footer a:not(.btn) {
        padding: 10px 15px;
        text-align: center;
        color: #999999;
        display: block;
        text-decoration: none;
        border-top: 4px solid transparent;
    }

    .footer a:not(.btn):hover {
        color: #00b3ff;
    }

    .footer a:not(.btn).active i,
    .footer a:not(.btn).active span {
        color: #00b3ff;
    }


    /* Side Bar */
    .menu-overlay .main-menu {
        background: #e0e0e0;
        color: #ffffff;
    }

    .menu-overlay .main-menu .menu-container .nav-pills .nav-item .nav-link.active {
        background: linear-gradient(145deg, #00c1ff, #00a2e6);
        color: #ffffff;
        box-shadow: 5px 5px 10px #cacaca,
            -5px -5px 10px #f6f6f6;
    }

    .menu-overlay .main-menu .menu-container .nav-pills .nav-item .nav-link {
        color: #00b4ff;
    }

    .menu-overlay .main-menu .menu-container .nav-pills .nav-item .nav-link:hover {
        color: #ffffff;
        text-shadow: 3px 3px 9px #D9DADE, -3px -3px 9px #FFFFFF;
    }

    /* Main menu */
    .main {
        background-color: #e0e0e0;
    }

    .main .main-container {
        padding-top: 15px;
        padding-bottom: 15px;
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #b3b3b3,
            inset -5px -5px 10px #ffffff;
    }

    .card {
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: 5px 5px 10px #cacaca,
            -5px -5px 10px #f6f6f6;
    }

    .list-group-item {
        background-color: rgba(255, 255, 255, 0);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    /* light color */
    .bg-success-light {
        background: linear-gradient(145deg, #dfffe7, #bbdcc2);
    }

    .bg-default-light {
        background: linear-gradient(145deg, #dfdbff, #bbb9dc);
    }

    .bg-warning-light {
        background: linear-gradient(145deg, #ffffd7, #e6d9b5);
    }

    .bg-danger-light {
        background: linear-gradient(145deg, #fff3f5, #e1ccce);
    }

    /* shadow */
    .neo-shadow {
        box-shadow: 5px 5px 10px #cacaca,
            -5px -5px 10px #f6f6f6 !important;
    }

    .text-neo-shadow {
        color: #ffffff;
        text-shadow: 3px 3px 9px #D9DADE, -3px -3px 9px #FFFFFF;
        caret-color: #262626;
        outline: none;
    }

    /* btn */
    .btn {
        position: relative;
        display: inline-block;
        vertical-align: middle;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
        border-radius: 20px;
    }

    .btn-primary {
        color: #ffffff;
        background: linear-gradient(145deg, #0084ff, #006fe6);
    }

    .btn-primary:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #006fe6, #0084ff);
    }

    .btn-warning {
        color: #ffffff;
        background: linear-gradient(145deg, #ffcf07, #e6ae06);
    }

    .btn-warning:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #e6ae06, #ffcf07);
    }

    .btn-success {
        color: #ffffff;
        background: linear-gradient(145deg, #2bb34a, #24963e);
    }

    .btn-success:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #24963e, #2bb34a);
    }

    .btn-info {
        color: #ffffff;
        background: linear-gradient(145deg, #19adc5, #1592a6);
    }

    .btn-info:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #1592a6, #19adc5);
    }

    .btn-danger {
        color: #ffffff;
        background: linear-gradient(145deg, #eb394a, #c6303e);
    }

    .btn-danger:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #c6303e, #eb394a);
    }

    .btn-secondary {
        color: #ffffff;
        background: linear-gradient(145deg, #747d86, #616971);
    }

    .btn-secondary:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #616971, #747d86);
    }

    .btn-default {
        color: #ffffff;
        background: linear-gradient(145deg, #00c1ff, #00a2e6);
    }

    .btn-default:hover {
        color: #ffffff;
        background: linear-gradient(145deg, #00a2e6, #00c1ff);
    }

    /* Tab Btn */
    .nav-tabs {
        border-bottom: 0px solid #dee2e600;
    }

    .nav-item a {
        margin-left: 5px;
        margin-right: 5px;
    }

    .nav-link-custom {
        color: #495057;
        border-radius: 20px !important;
        background: linear-gradient(145deg, #cacaca, #f0f0f0);
        box-shadow: 5px 5px 10px #bebebe,
            -5px -5px 10px #ffffff;
    }

    .nav-tabs .nav-link-custom.active,
    .nav-tabs .nav-item.show .nav-link-custom {
        color: #0092c0;
        border-color: #dee2e600 #dee2e600 #fff0;
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #bebebe,
            inset -5px -5px 10px #ffffff;
    }

    .nav-link-custom:hover,
    .nav-link-custom:focus {
        color: #0092c0;
        border-radius: 20px;
        text-decoration: none;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #bebebe,
            inset -5px -5px 10px #ffffff;
    }



    /* image */
    .img-thumbnail {
        padding: 0.25rem;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;

        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #cacaca,
            inset -5px -5px 10px #f6f6f6;
    }

    /* modal */
    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3rem;
        outline: 0;

        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #c5c5c5,
            inset -5px -5px 10px #fbfbfb;
    }

    .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #d5d5d5;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        background: linear-gradient(145deg, #f0f0f0, #cacaca);
    }

    .modal-footer {
        border-top: 1px solid #cfcfcf;
    }

    /* form */
    .form-control {
        font-size: 1rem;
        border-radius: .55rem;
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
    }

    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 1.2rem + .0625rem);
        padding: .6rem .75rem;
        font-size: 1rem;
        font-weight: 300;
        line-height: 1.5;
        color: #44476a;
        background-color: #e6e7ee;
        background-clip: padding-box;
        border: .0625rem solid #d1d9e6;
        border-radius: .55rem;
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        transition: all .3s ease-in-out
    }

    .form-control:focus {
        color: #44476a;
        background-color: #e6e7ee;
        border: .0625rem solid #d1d9e6;
        box-shadow: inset 5px 5px 10px #bebebe,
            inset -5px -5px 10px #ffffff !important;
        transition: all .3s ease-in-out
    }

    .input-group>.input-group-append>.btn,
    .input-group>.input-group-append>.input-group-text,
    .input-group>.input-group-prepend:first-child>.btn:not(:first-child),
    .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child),
    .input-group>.input-group-prepend:not(:first-child)>.btn,
    .input-group>.input-group-prepend:not(:first-child)>.input-group-text {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .input-group-text {
        font-size: .875rem;
        transition: all .3s ease-in-out;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: .6rem .75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #44476a;
        text-align: center;
        white-space: nowrap;
        background-color: #e6e7ee;
        border: .0625rem solid #d1d9e6;
        border-radius: .55rem
    }

    .float-label .form-control {
        background-color: transparent;
        border-width: 0 0 1px 0;
        border-radius: 20px;
        z-index: 1;
        position: relative;
        padding-left: 10px;
        padding-right: 0;
        background-image: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }

    .float-label .form-control:focus {
        outline: none;
        border-bottom: 0px solid rgba(0, 0, 0, 0);
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: inset 5px 5px 10px #bebebe,
            inset -5px -5px 10px #ffffff !important;
    }

    .float-label .form-control-label {
        left: 10px;
        top: 28px;
    }

    /* table */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-radius: 20px;
        background: #e0e0e0;
        box-shadow: 5px 5px 10px #b3b3b3,
            -5px -5px 10px #ffffff;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 0px solid #dee2e6;
    }

    /* image preview */
    .profile-thumb .profilePicPreview {
        border: 2px solid #ffffff;
        box-shadow: 5px 5px 10px #bebebe,
            -5px -5px 10px #ffffff;
    }

    .profile-thumb .avatar-edit label {
        width: 45px;
        height: 45px;
        background-color: #37ebec;
        border-radius: 50%;
        text-align: center;
        line-height: 45px;
        border: 2px solid #ffffff;
        font-size: 18px;
        cursor: pointer;
        color: #000000;
    }

    /* badge */
    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 70%;
        font-weight: 700;
        line-height: 1.4;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .badge-primary {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #006fe6
    }

    a.badge-primary:focus,
    a.badge-primary:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-secondary {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #2d4cc8
    }

    a.badge-secondary:focus,
    a.badge-secondary:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-success {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #18634b
    }

    a.badge-success:focus,
    a.badge-success:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-info {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #0056b3
    }

    a.badge-info:focus,
    a.badge-info:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-warning {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #f0b400
    }

    a.badge-warning:focus,
    a.badge-warning:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-danger {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #a91e2c
    }
    .badge-orange {
        color: #e7831d;
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
    }

    a.badge-danger:focus,
    a.badge-danger:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-light {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #d1d9e6
    }

    a.badge-light:focus,
    a.badge-light:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-dark {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #31344b
    }

    a.badge-dark:focus,
    a.badge-dark:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-default {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #262833
    }

    a.badge-default:focus,
    a.badge-default:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-white {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #ecf0f3
    }

    a.badge-white:focus,
    a.badge-white:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #44476a
    }

    a.badge-gray:focus,
    a.badge-gray:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-neutral {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #ecf0f3
    }

    a.badge-neutral:focus,
    a.badge-neutral:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-soft {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #e6e7ee
    }

    a.badge-soft:focus,
    a.badge-soft:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-black {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #262833
    }

    a.badge-black:focus,
    a.badge-black:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-purple {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #6f42c1
    }

    a.badge-purple:focus,
    a.badge-purple:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-100 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #f3f7fa
    }

    a.badge-gray-100:focus,
    a.badge-gray-100:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-200 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #fafbfe
    }

    a.badge-gray-200:focus,
    a.badge-gray-200:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-300 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #e6e7ee
    }

    a.badge-gray-300:focus,
    a.badge-gray-300:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-400 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #d1d9e6
    }

    a.badge-gray-400:focus,
    a.badge-gray-400:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-500 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #b1bcce
    }

    a.badge-gray-500:focus,
    a.badge-gray-500:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-600 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #93a5be
    }

    a.badge-gray-600:focus,
    a.badge-gray-600:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-700 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #66799e
    }

    a.badge-gray-700:focus,
    a.badge-gray-700:hover {
        color: #31344b;
        background-color: #e6e7ee
    }

    .badge-gray-800 {
        box-shadow: inset 2px 2px 5px #b8b9be, inset -3px -3px 7px #fff;
        background-color: transparent;
        color: #525480
    }

    a.badge-gray-800:focus,
    a.badge-gray-800:hover {
        color: #31344b;
        background-color: #e6e7ee
    }
</style>
