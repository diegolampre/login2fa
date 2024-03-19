@extends('layout.app')

@section('title', 'Inicio')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h1>Sesion iniciada</h1>

                    <form action="{{'logout'}}" method="POST">
                        @csrf
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Cerrar Sesion</button>
                        </div>
                    </form>

                 </div>
            </div>
        </div>
    </div>
</main>
@endsection

