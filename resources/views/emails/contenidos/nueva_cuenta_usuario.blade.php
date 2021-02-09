<p>Su cuenta de usuario con el rol de <strong>{{$usuario->roles()->first()->nombre}}</strong> ha sido creada con éxito en el sistema web de <a href="{{url('/')}}">{{config('app.name', 'nuestro sistema')}}</a>.</p>

<p>Para ingresar al sistema ingrese a este <a href="{{url('/create-password/'.$usuario->token.'/'.\Illuminate\Support\Facades\Crypt::encrypt($usuario->id))}}">link</a> y registre su contraseña de ingreso.</p>
