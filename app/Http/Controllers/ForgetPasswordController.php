<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForgetPasswordController extends Controller
{
            //Devolvemos vista Recuperacion de contraseña
    public function forgetPassword(){
        return view('auth.forgetPassword');
    }


            //Validamos datos del formulario contra la BD
    public function forgetPasswordStore(Request $request){ 
        $request->validate([
            'email' => "required|email|exists:users"
        ]);
            //Creamos token unico 
        $token = Str::random(64);

            //Conecatmos con la tabla password_reset_tokens y eliminamos posibles token de reseteo anterior
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete(); 
            //Creamos solicitud de reseteo
        DB::table('password_reset_tokens')->insert([  //Creamos solicitud de reseteo
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now() //CARBON paquete para dar formato a fechas
        ]);
        
            //Pasamos el Token a la vista passwordemail 
        Mail::send("emails.passwordemail", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset password");
        });
            //Redirigimos al usuario a la misma vista y mostramos mensaje de correo enviado
        return redirect()->to(route('forgetPassword'))->with("success", "Te hemos enviado un correo con las instrucciones de recuperacion de la contraseña");   
    }
        

    public function passwordReset($token) {
        return view('auth.newPassword', compact('token')); //Enviamos token a la nueva pagina
    }
            //Funcion para Validar y modificar la contraseña en la BD por una nueva
    public function PasswordResetStore(Request $request){
        $request->validate([    // Validaciones
            'email' => "required|email|exists:users",
            'password' => "required|string|min:4|confirmed",
            'password_confirmation' => "required" //Obligatorio termine en confirmation. Cosas de LARAVEL
        ]);
            // Obtenemos los datos que contiene el formulario de reseteo de contraseña y la almacenamos en una variable
        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatePassword){ //Comprobamos que la variable contiene datos, sino devolvemos error
            return redirect()->to(route('passwordReset'))->with('error', 'Invalid');
        }
            // Actualizamos la contraseña del usuario en la base
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

            //Eliminamos la solicitud una vez hecho el cambio
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

            //Devolvemos a la pantalla de Login
        return redirect()->to(route("login"))->with("success", "Cambio de contraseña satisfactorio");
    }
}
