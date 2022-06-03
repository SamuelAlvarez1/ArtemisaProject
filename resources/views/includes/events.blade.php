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
        <section class="page-section" id="Eventos{{$key}}">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-6">
                        <h2 class="titulo mb-4">{{Str::upper($event->name)}}</h2>
                        @if(Str::length($event->description)>=50&&Str::length($event->description)<=125)
                            <h3 class="text-white mb-4"><small>{{$event->description}}</small></h3>
                        @elseif(Str::length($event->description)>=126&&Str::length($event->description)<=255)
                            <h6 class="text-white mb-4">{{$event->description}}</h6>
                        @else
                            <h2 class="text-white mb-4">{{$event->description}}</h2>
                        @endif
                    </div>
                    <div class="col-md-5">
                        @if($event->image == '')
                            <img src="img/landing/sin-imagen-logo.jpg" alt="Evento" class="img rounded">
                        @else
                            <img src="uploads/{{$event->image}}" alt="Evento" class="img rounded">
                        @endif
                    </div>
                </div>
                <div class="row text-center mt-5">
                    <div class="col-md">
                        <h4 class="text-white">Fecha de inicio</h4>
                        <h6 class="text-white mb-3">{{$event->startDate}}</h6>
                    </div>
                    <div class="col-md">
                        <h4 class="text-white">Fecha fin</h4>
                        <h6 class="text-white mb-3">{{$event->endDate}}</h6>
                    </div>
                    <div class="col-md">
                        @if($event->entryPrice > 1)
                            <h4 class="text-white">Precio de entrada:</h4>
                            <h6 class="text-white">${{number_format($event->entryPrice)}}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <div class="row text-center mt-4"><h2 class="titulo display-3">
        </h2>
    </div>
@endif
