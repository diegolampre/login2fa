<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class TwoFactorController extends Controller
{
    public function twofactor(){
        return view('twofactor');
    }
    
    public function twofactorstore(Request $request){

        $request->validate([
            'otp' => 'required|digits:6', 
        ]);

        $otp = $request->input('otp');

        $user = $request->user(); // Obtener el usuario actualmente autenticado

        if ($otp == $request->session()->get('otp')) { // Verificar si el código OTP ingresado por el usuario es correcto

            $user->update(['two_factor_authenticated' => true]); // El código OTP es correcto, autenticar al usuario
    
            return redirect()->route('index')->with('success', '¡Autenticación de dos factores exitosa!'); // Redirigir al usuario a la página de inicio
        } else {
        
            return back()->with('error', 'El código OTP es incorrecto. Por favor, inténtalo de nuevo.'); // El código OTP es incorrecto, redirigir de vuelta con un mensaje de error
        }
    }
}
