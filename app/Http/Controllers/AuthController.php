<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class AuthController extends Controller
{

    public function login(){
        return view('login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credenciales = $request->only('email', 'password');
    
        //Autentificacion de usuario, creacion y envio codigo OTP
        if (Auth::attempt($credenciales)) {
    
            $otp = mt_rand(100000, 999999); // Generamos un código OTP aleatorio
    
            $request->session()->put('otp', $otp); // Guardar el OTP en la sesión 
    
            Mail::to($request->user()->email)->send(new OtpMail($otp)); // Enviar el código OTP por correo electrónico
    
            return redirect()->route('twofactor')->with('success', 'Código OTP enviado por correo electrónico.'); // Redirigir al usuario a la página de verificación OTP
        } else {
            return redirect()->route('login')->with('error', 'Credenciales incorrectas.'); // Autenticación fallida, redirigir de vuelta con un mensaje de error
        }
    }
}