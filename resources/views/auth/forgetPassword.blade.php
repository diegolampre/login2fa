@extends('layout.appL')
@section('title', 'Recuperación de contraseña')
@section('content')
<br>
<br>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Recuperación de Contraseña</h3>
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

                                <!-- Llamamos al metodo POST en el form para enviar los datos a la BD -->
                        <form method="POST" action="{{ route('forgetPasswordStore') }}"> 
                            @csrf 
                            <div class="form-group mb-3">
                                <p>Introduce el correo electronico asociado a una cuenta</p>
                                <input type="text" placeholder="Correo Electronico"  class="form-control" name="email" >
                            </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Enviar Email de recuperación</button>
                                <br>
                            </div>
                            <a style="text-align: center" href="{{url('/login')}}">Ir al inicio de sesion</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

