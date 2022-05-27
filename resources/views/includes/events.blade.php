@if(sizeof($events) > 0)
<div class="row text-center mt-4"><h2 class="titulo display-3">
    @if(sizeof($events)>1)
        Eventos
    @else 
        Evento
    @endif
    </h2>
</div>
@foreach($events as $key => $event) 
<section class="page-section" id="Eventos{{$key}}" >
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6">
                <h2 class="titulo">{{Str::upper($event->name)}}</h2>
                @if(Str::length($event->description)>=50&&Str::length($event->description)<=125)
                <h3 class="text-white"><small>{{$event->description}}</small></h3></div>
                @elseif(Str::length($event->description)>=126&&Str::length($event->description)<=255)
                <h6 class="text-white">{{$event->description}}</h6></div>
                @else
                <h2 class="text-white">{{$event->description}}</h2></div>  
                @endif
            <div class="col-md-5">
                @if($event->image == '')
                <img src="img/landing/event-default.jpg" alt="Evento" class="img rounded">
                @else
                <img src="uploads/{{$event->image}}" alt="Evento" class="img rounded">
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
</section>
@endforeach
<div class="row text-center mt-4"><h2 class="titulo display-3">
    </h2>
</div>
@endif