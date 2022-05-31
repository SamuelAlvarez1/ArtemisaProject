<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Artemisa</title>
    <!-- Font Awesome icons (free version)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet"/>

    <link rel="stylesheet" href="/css/alertify.min.css"/>
    <link rel="stylesheet" href="/css/themes/bootstrap.css"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
</head>
<body id="page-top" style=" background-image: url('{{asset('img/landing/header-bg.jpg')}}');">
<!-- Navigation-->
<nav id="mainNav" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img class="logo" src="{{asset('img/landing/navbar-logo.png')}}"
                                                      alt="..."/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#page-top">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#Quienessomos">¿Quiénes somos?</a></li>
                <li class="nav-item"><a class="nav-link" href="#Ubicacion">Ubicación</a></li>
                <li class="nav-item"><a class="nav-link" href="#Destacados">Destacados</a></li>
                <li class="nav-item"><a class="nav-link" href="#Contactanos">Contáctanos</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead"
        style="padding:0%; background-image: url('{{asset('img/landing/header-bg.jpg')}}'); padding-top:80px;">
    <div class="container">
        <div class="masthead-heading text-uppercase logoHeader"><img src="{{asset('img/landing/navbar-logo.png')}}"
                                                                     alt="..."/>
        </div>
        <a class="btn btn-primary btn-xl text-uppercase animate__animated animate__fadeInUp" href="/login">Iniciar
            sesión</a>
    </div>
    <div class="container"
         style="height: 6rem; background: rgba(0,0,0, 0.8); max-width: 1000rem !important; margin-top: 30px; display: flex;">
        <a class="arrow" href="#Quienessomos"><i class="fa-solid fa-angle-down"></i></a>
    </div>
</header>
@include('includes.events')
<!-- Quienes somos-->
<section class="page-section" id="Quienessomos">

    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <img src="img/landing/Artemisa_comida.jfif" alt="..." class="quienessomos img">
            </div>
            <div class="col-md-5">
                <h2 class="titulo">¿Quiénes somos?</h2>

                <p class="text">Bienvenidos a Artemisa,
                    un restaurante apasionado por la comida artesanal, creando así un lugar alternativo y cómodo para
                    todo público y disfrutar de un buen momento </p>
            </div>
        </div>
    </div>
</section>
<!-- Ubicación-->
<section class="page-section" id="Ubicacion">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-6">
                <h2 class="titulo">¿Dónde estamos ubicados?</h2>

                <p class="text">Nos encontramos ubicados Cra. 51 #50a-6, te esperamos para que disfrutes de un buen
                    momento en nuestro restaurante-bar</div>
            <div class="col-md-5">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.4566938669386!2d-75.56149658548003!3d6.33483692708588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442fa68a4e80bf%3A0x2a9eccf2250943da!2sCra.%2051%20%2350a-6%2C%20Bello%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1653330556882!5m2!1ses!2sco"
                    width="600" height="450" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="map" title="Localización de Artemisa en el mapa"></iframe>
            </div>
        </div>
    </div>
</section>

{{--Destacados--}}

<section class="page-section text-center" id="Destacados">
    <h2 class="titulo mb-5">Destacados</h2>
    <div class="container">

        <div class="row">
            @foreach($plates as $plate)
                <div class="col">
                    <div class="card">
                        @if($plate->image == '')
                        <img src="img/landing/sin-imagen-logo.jpg"
                             class="u-full-width" alt="">
                        @else
                        <img src="uploads/{{$plate->image}}"
                             class="u-full-width" alt="">
                        @endif
                        <div class="info-card">
                            <h4>{{$plate->name}}</h4>
<<<<<<< HEAD

=======
                            <p>Marca nesca</p>
>>>>>>> c58b7a665d4888b1f495ad029b21667dbd0c80e0
                            <span class="u-pull-right">${{number_format($plate->price)}}</span>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>

<!-- Contactanos-->
<section class="page-section pt-0" id="Contactanos">
    <div class="container">
        <div class="text-center contact">
            <h2 class="titulo">Contáctanos</h2>
            <h3 class="section-subheading text-white contact-text">Cuéntanos tus sugerencias e inquietudes</h3>
            <div class="form">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form id="contact" method="post" action="{{url('/contact')}}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" required minlength="5" value="{{old('name')}}" name="name"
                               class="form-control" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <input type="email" required value="{{old('email')}}" name="email" class="form-control"
                               placeholder="Correo electrónico">
                    </div>
                    <div class="mb-3">
                        <textarea class="sugerencia form-control" minlength="10" required name="message" cols="50"
                                  rows="5" placeholder="Sugerencia o inquietud">{{old('message')}}</textarea>
                    </div>
                    <div class="text-center">
                        <div class="g-recaptcha text-center" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary btn-xl text-uppercase mt-3" id="submitButton" type="submit">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start text-white">Copyright &copy; Artemisa 2022</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a target="_blank" class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/artemisa.restobar/?hl=es"><i class="fab fa-instagram"></i></a>
                <a target="_blank" class="btn btn-dark btn-social mx-2" href="https://api.whatsapp.com/send?phone=3015767307"><i class="fab fa-whatsapp"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none me-3 text-white" href="#!">Privacy Policy</a>
                <a class="link-dark text-decoration-none text-white" href="#!">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
<a href="https://api.whatsapp.com/send?phone=3015767307" class="btn-wsp animate__animated animate__fadeInUp"
   target="_blank"><i class="fa-brands fa-whatsapp"></i></a>

<!-- Bootstrap core JS-->
<script src="/js/alertify.min.js"></script>
@if(Session::has('success'))
    <script>
        alertify.success('Se envió su mensaje correctamente!');
    </script>
@endif
@if(Session::has('error'))
    <script>
        alertify.error('No fue posible enviar el mensaje!');
    </script>
@endif

@if(Session::has('errorState'))
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('{{ Session::get('errorState') }}');
    </script>
@endif
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    window.onload = function () {
        var recaptcha = document.forms["contact"]["g-recaptcha-response"];
        recaptcha.required = true;
        recaptcha.oninvalid = function (e) {
            alertify.error('Verifica que no eres un robot!');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
<script src="{{asset('js/scripts.js')}}"></script>

<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
