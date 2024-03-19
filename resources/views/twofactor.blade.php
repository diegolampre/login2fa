


@extends('layout.appL')
@section('title', 'Login')
@section('content')      
<br>     
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Login de Usuarios</h3>
                    <div class="card-body">
                        
                        <div>
                            @if ($errors->any())
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{$error}}</div>
                                    @endforeach
                                </div>
                            @endif
                        
                            @if (session()->has('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                        
                            @if (session()->has('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('twofactorstore') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="otp">Introduce el codigo que hemos enviado a tu correo</label>
                                <input type="email" placeholder="Codigo Doble Verificación"  class="form-control" name="email"
                                    autofocus>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Continuar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection