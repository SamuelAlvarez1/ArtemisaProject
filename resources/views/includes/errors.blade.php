@if(Session::has('error'))
<script>
    let divAlerts = document.querySelector(".div-alerts");
    divAlerts.innerHTML = `<div class="alert alert-danger alert-dismissible alert-sesion" role="alert">
        {{ Session::get('error') }}
    </div>`;

    setTimeout(() => {
        let alertSesion = document.querySelector(".alert-sesion");
        alertSesion.classList.add("animate__animated", "animate__fadeOutUp");
        setTimeout(() => {
            alertSesion.remove();
        }, 1000);
    }, 5000);
</script>

@endif 

@if(Session::has('success'))

<script>
    let divAlerts = document.querySelector(".div-alerts");

    divAlerts.innerHTML = `<div class="alert alert-success alert-dismissible alert-sesion" role="alert">
        {{ Session::get('success') }}
    </div>`;

    setTimeout(() => {
        let alertSesion = document.querySelector(".alert-sesion");
        alertSesion.classList.add("animate__animated", "animate__fadeOutUp");
        setTimeout(() => {
            alertSesion.remove();
        }, 1000);
    }, 5000);
</script>

@endif 

@if(session('warningErrors'))
<script>
    let divAlerts = document.querySelector(".div-alerts");
    divAlerts.innerHTML = `
    <div class="alert alert-warning alert-dismissible alert-sesion" role="alert">
    Changes saved correctly, but
    <ul>
        @foreach(session('warningErrors') as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    
</div>
`
setTimeout(() => {
        let alertSesion = document.querySelector(".alert-sesion");
        alertSesion.classList.add("animate__animated", "animate__fadeOutUp");
        setTimeout(() => {
            alertSesion.remove();
        }, 1000);
    }, 5000);

</script>

@endif
