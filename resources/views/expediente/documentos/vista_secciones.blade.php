@php($secciones = \Archinet\Models\Seccion::all())
@foreach($secciones as $seccion)
    <div class="col-12 col-md-4 text-center border border-light grey lighten-4">
        <a href="{{url('/expediente/seccion/'.$seccion->nombre_carpeta.'/'.$user->id)}}" class="text-center waves-effect waves-light">
            <div><i class="fas fa-folder-open fa-4x" style="color: {{config('params.colores')['verde']}}"></i></div>
            <p class="font-small margin-top-10">{{$seccion->nombre}}</p>
        </a>
    </div>
@endforeach

<div class="col-12 no-padding">
    <a href="{{url('/expediente/')}}" class="btn-guardar btn btn-default btn-submit right" id="">REGRESAR</a>
</div>