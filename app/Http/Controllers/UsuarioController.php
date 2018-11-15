<?php

namespace TATU\Http\Controllers;

use Illuminate\Http\Request;
use TATU\User;
use TATU\Role;

class UsuarioController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('usuarios.usuarios'); 
    }
    //Listar
    public function datatable(Request $request)
    {        
        return datatables()->of(User::all())
        ->addColumn('rol', function ($item) {
            $rol = Role::find($item->id_role);
            return  $rol->nombre;
        })
        ->addColumn('editar', function ($item) {
            return '<a class="btn btn-xs btn-primary text-white" onclick="Show('.$item->id.')"><i class="icon-pencil"></i></a>';
        })
        ->addColumn('eliminar', function ($item) {
            return '<a class="btn btn-xs btn-danger text-white" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
        })
        ->rawColumns(['editar','eliminar']) 
                
        ->toJson();
    }
     //Listar
     public function list()
     {
         $list=User::All();
         return $list->toJson();
     }
     //Crear
     public function create(Request $request)
     {
         $validator = \Validator::make($request->all(), [
             'name' => 'required|string|max:255|unique:Users',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
             'estado' => 'required|string|max:255'
         ]);
         if ($validator->fails())
         {
             return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
         }
         $role = Role::where('nombre', 'ESTANDAR')->first();
         $User = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password),
             'photo' => null,
             'estado' => 'ACTIVO',
             'id_role' => $role->id
         ]);
         //$User = User::create($request->all()); 
         return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
     }
     //Ver
     public function get(Request $request)
     {
         $User = User::find($request->id);
         return $User->toJson();
     }
     //Actualizar
     public function update(Request $request)
     {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:Users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'estado' => 'required|string|max:255'
        ]);
         if ($validator->fails())
         {
             return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
         }
         $User = User::find($request->id);
         $User->update($request->all());
         return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
     }
     //Borrar
     public function delete(Request $request)
     {
         $User = User::find($request->id);
         $User->delete();
         return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
     }
     public function list_query(Request $request)
     {
         switch ($request->by)
         {
             case 'id_tipo_User':
                 $list=User::All()
                 ->where('id_role',$request->id_role)
                 ->where('estado','ACTIVO');
                 return $list;
             break;
             case 'all':
                 $list=User::All();
                 return $list=User::All();
             break;
             default:
 
             break;
         }
     }
}

