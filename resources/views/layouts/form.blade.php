<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <link rel="stylesheet" href="/css/themes/bootstrap.css"/>

    <style>
        :root {
            --dark: #16191c;
            --dark-x: #1e2126;
            --light: #ffffff;
        }

        body {
            font-family: 'Spartan', sans-serif;
            font-weight: 300;
            background: black;
            color: var(--light);
        }


        .bg-dark {
            background-color: var(--dark) !important;
        }

        .bg-dark-x {
            background-color: var(--dark-x);
        }

        .form-control, .btn {
            min-height: 3.125rem;
            line-height: initial;
        }

        .inputBox {
            position: relative;
            width: 100%;
            height: 46px;
            margin-bottom: 50px;
        }

        .inputBox:last-child {
            margin-bottom: 0;
        }

        .inputBox input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            border: 1px solid var(--light) !important;
            background: transparent;
            padding: 10px;
            color: #ffffff !important;
        }

        .inputBox label {
            position: absolute;
            top: 1px;
            left: 1px;
            padding: 10px;
            display: inline-block;
            transition: 0.5s;
            pointer-events: none;
            color: #808080 !important;
        }

        .inputBox input:focus {
            background: transparent;
        }

        .inputBox input:focus ~ label,
        .inputBox input:valid ~ label {
            transform: translateY(-35px);
            color: #ffffff !important;
        }

    </style>

    @yield('styles')

</head>
<body>
<section>
    <div class="row g-0 w-100">
        <div class="col-lg-7">
            <img src="/img/landing/header-bg.jpg" class="imgForm w-100 h-100" alt="">
        </div>
        <div class="col-lg-5 d-flex flex-column align-items-end min-vh-100 p-5 ">
            <div class="px-lg-5 py-lg-4 p-4 w-100 align-self-center">
               @yield('content')
            </div>


        </div>
    </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
        <script src="/js/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>


        @if (session('status'))

            <script>
                alertify.set("notifier", "position", "top-right");
            alertify.success(
                "{{ session('status') }}"
            );
            </script>



        @endif

        @yield('scripts')
</body>
</html>

