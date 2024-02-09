<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    public function get(){
        try { 
            $data = Usuarios::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function create(Request $request){
        try {
            $data['id'] = $request['id'];
            $data['apellidos'] = $request['apellidos'];
            $data['nombres'] = $request['nombres'];
            $data['correo'] = $request['correo'];
            $data['username'] = $request['username'];
            $data['password'] = $request['password'];
            $res = Usuarios::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id){
        try { 
            $data = Usuarios::find($id);
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request,$id){
        try { 
            $data['id'] = $request['id'];
            $data['apellidos'] = $request['apellidos'];
            $data['nombres'] = $request['nombres'];
            $data['correo'] = $request['correo'];
            $data['username'] = $request['username'];
            $data['password'] = $request['password'];
            Usuarios::find($id)->update($data);
            $res = Usuarios::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
  
    public function delete($id){
        try {       
            $res = Usuarios::find($id)->delete(); 
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            // Validar los datos del formulario de inicio de sesión
            $credentials = $request->only('username', 'password');
            // Obtener el usuario por su nombre de usuario
            $user = Usuarios::where('username', $credentials['username'])->first();
    
            // Verificar si se encontró un usuario con el nombre de usuario proporcionado
            if ($user) {
                // Verificar si la contraseña proporcionada coincide con la contraseña almacenada
                if ($credentials['password']== $user->password) {
                    // Si las credenciales son válidas, devolver la información del usuario
                    return response()->json([
                        'user' => $user
                    ], 200);
                } else {
                    // Si la contraseña no coincide, devolver un error JSON
                    return response()->json(['error' => 'Contraseña incorrecta'], 401);
                }
            } else {
                // Si no se encuentra un usuario con el nombre de usuario proporcionado, devolver un error JSON
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
        } catch (\Throwable $th) {
            // Capturar cualquier excepción y devolver un error JSON
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    

    public function logout(Request $request)
{
    try {
        Auth::logout(); // Cerrar sesión del usuario actual

        return response()->json(['message' => 'Sesión cerrada exitosamente'], 200);
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}
    
}
