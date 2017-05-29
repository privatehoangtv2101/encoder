<!doctype html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Encoder</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('/css/login.css') }}"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <!-- Styles -->
    </head>
    <body>
        <div id="app"></div>
        <div id="login-page-wrapper">
            <div id="login-form-wrapper">
                <form id="login-form" method="post" action="{{action('Hello@action')}}">
                    <div id="form-title">Login Form</div>
                    <div class="input-field">
                        <input type="text" name="user_name" placeholder="Nhập username..."/>
                        <div class='icon'><i class="fa fa-user" aria-hidden="true"></i></div>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Nhập password..."/>
                        <div class='icon'><i class="fa fa-lock" aria-hidden="true"></i></div>
                    </div>
                    <input type="submit" value="Đăng nhập"/>
                    <div id='copyright'><div class='text'>© 2017 Bictweb. All rights reserved!</div></div>
                </form>
            </div>
        </div>
        <script src="{{ mix('/js/app.js') }}" type="text/javascript"></script>
    </body>
</html>
