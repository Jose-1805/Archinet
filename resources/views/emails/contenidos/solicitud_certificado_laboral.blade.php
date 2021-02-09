<p>{{$descripcion}}</p>
<br>
<p>Datos del funcionario</p>
<p><strong>Nombre: </strong>{{Auth::user()->fullName()}}</p>
<p><strong>{{Auth::user()->tipo_identificacion}}: </strong>{{Auth::user()->identificacion}}</p>
<p><strong>Correo: </strong>{{Auth::user()->email}}</p>
