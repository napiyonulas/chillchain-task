<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chill Chain</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('fontawesome')
    <style>
        header
        {
            text-align: center;
            font-size: 25px;
        }
        .footer-right ul {
            list-style-type: none;
        }
        .footer-right ul li {
            display: block; margin-left: 1rem;
        }
        .footer-right li a{
            color: #00baef;
        }
        .btn-outline-white {

            background-color: white;
            color: #00baef;
            border-color: white;
        }
        .btn-outline-white:hover {
            color: white;
            background-color: #00baef;

            border-color: white;
        }

        a{
            color: #074E8C;
        }

        .scrollbar
        {
            margin-left: 30px;
            float: left;
            height: 300px;
            width: 65px;
            background: #F5F5F5;
            overflow-y: scroll;
            margin-bottom: 25px;
        }

        .force-overflow
        {
            min-height: 450px;
        }




        ::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #00baef;
            border-color: #00baef;
        }

        .btn-info{
            color: white;
            background-color: #00baef;
        }
        .page-item:last-child .page-link {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .page-item:first-child .page-link {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .radius-none{
            border-radius: 0;
        }
        .modal-content  {
            -webkit-border-radius: 0px !important;
            -moz-border-radius: 0px !important;
            border-radius: 0px !important;
        }
        .modal-footer .btn {
            border-radius: 0;
        }
    </style>
</head>
<body style="background-color: #263338; overflow-x: hidden">

<div id="app">

    <navbar-component></navbar-component>
    <main class="display: block;">
        @yield('content')
    </main>
    <div style="background-image: url({{asset('/img/background.svg')}}); position: relative;
        left: 0;
        bottom: 0;
        width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-4">
                    <img class="brand-logo" height="15" src="{{asset('img/logo.png')}}"/>
                </div>
                <div class="col-md-6 footer-right my-4">
                    <ul class="float-right my-1 text-light">
                        <li class="float-left"><a href="">contact@chillchain.net</a></li>
                        <li class="float-left"><a href="">+44 (0) 203 4880137</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
