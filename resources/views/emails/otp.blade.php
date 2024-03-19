@extends('layout.appL')
@section('title', 'Codigo de doble verificacion')
@section('content')
<p>¡Hola!</p>
<p>Tu código de verificación OTP es: {{ $otp }}</p>
<p>Gracias,</p>
<p>Equipo de {{ config('app.name') }}</p>
@endsection