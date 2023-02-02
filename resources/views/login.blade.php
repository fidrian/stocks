<!doctype html>
<html lang="en">
<head>
    <title>Kasual Stock</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link rel="icon" type="image/png" href="{{ asset('faviconkasual.png') }}" />
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('back/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ url('back/assets/css/main.css?v1.3') }}">
    <link rel="stylesheet" href="{{ url('assets/scss/index.css') }}">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</head>
<body class="bg-dark c-login">
<div class="container-fluid">
    <div class="row ">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-xs-12 ml-0 mr-0 mx-auto mt-5">
                <fieldset class="border rounded shadow-lg  px-4 py-5" id="loginForm" style="background:#FFF !important;">
                    <form method="post" action="/">
                        @csrf
                        <div class="mb-3 text-center">
                            <figure class="mb-0">
                                <img loading="lazy" src="https://kasual.id/wp-content/uploads/2019/10/logo-baru.png"
                                    alt="Kasual Logo" style="width:50%;margin-bottom:10px;">
                            </figure>
                        </div>
                        <div class="mb-3">
                            Username<br />
                            <input type="text" name="email" class="form-control form-control-lg c-login__form"  placeholder="example@kasual.id" required />
                        </div>
                        <div class="mb-3">
                        Password<br />
                            <input type="password" name="password" class="form-control form-control-lg c-login__form" required />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg px-4 c-login__btn" style="background-color:#1C3D89 !important;color:#FFF !important;" aria-pressed="true">Login</button>
                        </div>
                    </form>
                </fieldset>
        </div>
    </div>
</div>
@include('content.notification')
<script>
    $(document).ready(function() {
        $('#resetPasswordLink').on('click', function() {
            $('#loginForm').hide();
            $('#resetPasswordForm').show();
        });

        $('#loginLink').on('click', function() {
            $('#loginForm').show();
            $('#resetPasswordForm').hide();
            
        });
    });

    $('.c-alert').on('mousedown',function(e){
        if(e.target == $('.c-alert').get(0)){
            $('.c-alert').removeClass('-active');
        }
    });
</script>
</body>
</html>
