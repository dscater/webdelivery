@if(count($libros))
@foreach($libros as $libro)
    <div class="col-md-3">
        <div class="contenedor">
            <div class="imagen">
                <img src="{{asset('imgs/libros/'.$libro->portada)}}" alt="">
            </div>
            <div class="titulo">
                {{$libro->titulo}}
            </div>
            <div class="opciones">
                @if($array_prestamo[$libro->id])
                <a href="" class="btn bg-danger btn-sm" style="color:white!important;">NO DISPONIBLE</a>
                @else
                <a href="" data-id="{{$libro->id}}" class="reservar btn bg-orange btn-sm" style="color:white!important;">RESERVAR</a>
                @endif
                <a href="{{route('informacion',$libro->id)}}" class="btn btn-outline-success btn-sm info">INFORMACIÓN</a>
            </div>
        </div>
    </div>
@endforeach
@else
NO SE ENCONTRARON COINCIDENCIAS
@endif
