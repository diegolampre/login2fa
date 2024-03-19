@extends('layout.appL')
@section('title', 'Login')
@section('content')      
<br>     
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Inicio de sesion</h3>
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

                        <form method="POST" action="{{ route('loginStore') }}">

                            @csrf
                            
                            <div class="form-group mb-3">
                                <input type="email" placeholder="Correo Electronico"  class="form-control" name="email"
                                    autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Contraseña"  class="form-control" name="password">
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recuerdame
                                    </label>
                                    <a href="{{route('forgetPasswordStore')}}">Recuperar contraseña</a>

                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Iniciar Sesion</button>
                            </div>
        

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection





  
  
  
  

