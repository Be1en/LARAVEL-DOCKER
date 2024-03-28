<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CRUD extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function create(Request $request){
        try {
            $sql=DB::insert("insert into contactos(nombre, telefono, email, direccion)values(?,?,?,?)",[
                $request->txtNombre,
                $request->txtTel,
                $request->txtEmail,
                $request->txtDireccion,
            ]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if($sql == true){
            return back()->with("exito","Contacto registrado exitosamente");
        }else{
            return back()->with("error","Error al registrar contacto");
        }
    }

    public function update(Request $request){
        try {
            $sql=DB::insert("update contactos set nombre=?, telefono=?, email=?, direccion=? where id=? ",[
                $request->txtNombre,
                $request->txtTel,
                $request->txtEmail,
                $request->txtDireccion,
                $request->txtId
            ]);
        } catch (\Throwable $th) {
            $sql=0;
        }
        if($sql == true){
            return back()->with("exito","Contacto actualizado exitosamente");
        }else{
            return back()->with("error","Error al actualizar contacto");
        }
    }
    public function delete($id){
        try {
            $sql=DB::delete("delete from contactos where id=$id ");
        } catch (\Throwable $th) {
            $sql=0;
        }
        if($sql == true){
            return back()->with("exito","Contacto eliminado exitosamente");
        }else{
            return back()->with("error","Error al eliminar contacto");
        }
    }
}
