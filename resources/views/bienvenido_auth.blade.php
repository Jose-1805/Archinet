@extends('layouts.app')

@section('content')
	<div class="margin-top-50 col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		@php($privilegios = explode('_', \Archinet\Models\Rol::strPrivilegios(session('rol')->privilegios)))
		<h1 class="margin-bottom-10">Bienvenido a Archinet</h1>
		<div class="grey lighten-4 padding-top-20 padding-bottom-20 padding-left-30 padding-right-20">
			<h5 class="grey-text">En este sistema usted podrá: </h5>
			@if(Auth::user()->esSuperadministrador())
				<ul class="no-padding margin-top-20" style="list-style: none;">
					<li class="grey-text">• Gestionar expedientes y funcionarios</li>
					<li class="grey-text">• Generar hoja de vida de un funcionario</li>
					<li class="grey-text">• Agregar folios a un expediente</li>
					<li class="grey-text">• Gestionar roles del sistema</li>
					<li class="grey-text">• Gestionar Usuarios</li>
					<li class="grey-text">• Agregar tipos documentales</li>
					<li class="grey-text">• Configurar correo para recibir solicitudes de certificados laborales</li>
					<li class="grey-text">• Visualizar historial de eventos de usuarios en el sistema</li>
				</ul>
			@else
				<ul class="no-padding margin-top-20" style="list-style: none;">
					@forelse($privilegios as $p)
						<li class="grey-text">• {{$p}}</li>
					@empty
						<li class="grey-text">No existen funcionalidades disponibles</li>
					@endforelse
				</ul>
			@endif
		</div>
	</div>
@endsection
