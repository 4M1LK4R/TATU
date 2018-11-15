<?php

namespace TATU\Http\Controllers;

use Illuminate\Http\Request;
use TATU\Establecimiento;
use TATU\Catalogo;


class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('turismo.establecimientos'); 
    }
    //Listar
    public function datatable(Request $request)
    {        
        return datatables()->of(Establecimiento::all())
        ->addColumn('tipo_establecimiento', function ($item) {
            $tipo_establecimiento = Catalogo::find($item->id_tipo_establecimiento);
            return  $tipo_establecimiento->nombre;
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
         $list=Establecimiento::All();
         return $list->toJson();
     }
     //Crear
     public function create(Request $request)
     {
         $validator = \Validator::make($request->all(), [
             'nombre' => 'required|string|max:255|unique:establecimientos',
             'estado' => 'required|string|max:255',
             'id_tipo_establecimiento' => 'required|integer',
         ]);
         if ($validator->fails())
         {
             return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
         }    
         $Establecimiento = Establecimiento::create($request->all()); 
         return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
     }
     //Ver
     public function get(Request $request)
     {
         $Establecimiento = Establecimiento::find($request->id);
         return $Establecimiento->toJson();
     }
     //Actualizar
     public function update(Request $request)
     {
         $validator = \Validator::make($request->all(), [
             'nombre' => 'required|string|max:255|unique:establecimientos,nombre,'. $request->id,
             'estado' => 'required|string|max:255',
             'id_tipo_establecimiento' => 'required|integer',
         ]);
         if ($validator->fails())
         {
             return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
         }
         $Establecimiento = Establecimiento::find($request->id);
         $Establecimiento->update($request->all());
         return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
     }
     //Borrar
     public function delete(Request $request)
     {
         $Establecimiento = Establecimiento::find($request->id);
         $Establecimiento->delete();
         return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
     }
     public function list_query(Request $request)
     {
         switch ($request->by)
         {
             case 'id_tipo_establecimiento':
                 $list=Establecimiento::All()
                 ->where('id_tipo_Establecimiento',$request->id_tipo_Establecimiento)
                 ->where('estado','ACTIVO');
                 return $list;
             break;
             case 'all':
                 $list=Establecimiento::All();
                 return $list=Establecimiento::All();
             break;
             default:
 
             break;
         }
     }
}