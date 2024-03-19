@extends('layout.appL')
@section('title', 'Cambio de contraseña')
  
@section('content')
<main class="login-form">
    <br>
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Cambio de Contraseña</div>
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

                      <form action="{{ route('passwordResetStore') }}" method="POST">
                          @csrf
                          <input type="text" hidden name="token" value="{{ $token }}">
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                  <input type="text" class="form-control" name="email">
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                              <div class="col-md-6">
                                  <input type="password" class="form-control" name="password" >
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                              <div class="col-md-6">
                                  <input type="password"  class="form-control" name="password_confirmation">
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Cambiar Contraseña
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection

