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
            $data['name'] = $request['name'];
            $data['address'] = $request['address'];
            $data['phone'] = $request['phone'];
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
            $data['name'] = $request['name'];
            $data['address'] = $request['address'];
            $data['phone'] = $request['phone'];
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
}
