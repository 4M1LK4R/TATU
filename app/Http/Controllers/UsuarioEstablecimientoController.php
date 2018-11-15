<?php

namespace TATU\Http\Controllers;

use Illuminate\Http\Request;
use TATU\DetalleUserEstablecimiento;
use TATU\Establecimiento;
use TATU\User;
class UsuarioEstablecimientoController extends Controller
{
    //
     //
     public function __construct()
     {
         $this->middleware('auth');
     }
     public function index()
     {
         return view('usuarios.usuario_establecimiento'); 
     }
     //Listar
     public function datatable(Request $request)
     {        
         /*
        ->addColumn('establecimiento', function ($item) {
            $establecimiento = Establecimiento::find($item->id_establecimiento);
            return  $establecimiento->nombre;
        })
        ->addColumn('user', function ($item) {
            $user = User::find($item->id_user);
            return  $user->name;
        })
         */
         return datatables()->of(DetalleUserEstablecimiento::all())
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
              'nombre' => 'required|string|max:255|unique:Users',
              'estado' => 'required|string|max:255',
              'id_tipo_User' => 'required|integer',
          ]);
          if ($validator->fails())
          {
              return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
          }    
          $User = User::create($request->all()); 
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
              'nombre' => 'required|string|max:255|unique:Users,nombre,'. $request->id,
              'estado' => 'required|string|max:255',
              'id_tipo_User' => 'required|integer',
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
                  ->where('id_tipo_User',$request->id_tipo_User)
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
 
