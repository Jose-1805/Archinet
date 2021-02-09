
    @if(\Illuminate\Support\Facades\Auth::guest())
    
    @else
    @include('layouts.menus.autenticado')
    @endif


