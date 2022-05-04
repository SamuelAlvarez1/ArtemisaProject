@if(sizeof($events) > 0)
<section class="page-section" id="Eventos" >
    
    <div class="row text-center mb-2"><h2 class="text-white">
        @if(sizeof($events)>1)
            Eventos
        @else 
            Evento
        @endif
        </h2>
    </div>
    @foreach($events as $event) 
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <h2 class="titulo">{{$event->name}}</h2>

                <p class="text">{{$event->description}}</div>
            
            <div class="col-md-5">
                @if($event->image == '')
                <img src="img/landing/Mapa.png" alt="Evento" class="img quienessomos">
                @else
                <img src="uploads/{{$event->image}}" alt="Evento" class="img quienessomos">
                @endif
            </div>
        </div>
        <div class="row text-center mt-3">
            <div class="col-md-6">
                <h4 class="text-white">Fecha de inicio</h4>
                <h6 class="text-white">{{$event->startDate}}</h6>
            </div>
            <div class="col-md-6">
                <h4 class="text-white">Fecha fin</h4>
                <h6 class="text-white">{{$event->endDate}}</h6>
            </div>
        </div>
    </div>
@endforeach
</section>
@endif