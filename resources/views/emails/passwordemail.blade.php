@extends('layout.appL')
@section('title', 'Recuperacion de contraseña')
@section('content')
                <!-- Pasamos Ruta con formulario de cambio y el token unico para verificar -->
Puedes recuperar tu contraseña a través del siguiente link: <br>

<a href="{{ route("passwordReset", $token) }}">Recuperar Contraseña</a>

@endsection


