<?php

namespace TATU\Http\Controllers;

use TATU\Catalogo;
use TATU\TipoCatalogo;
use TATU\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class CatalogoController extends Controller
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
    //Views
    public function tipos_establecimientos()
    {
        return view('catalogos.tipos-establecimientos');
    }
    public function paises()
    {
        return view('catalogos.paises');
    }
    public function tipos_documentos()
    {
        return view('catalogos.tipos-documentos');
    }
    public function profesiones()
    {
        return view('catalogos.profesiones');
    }
    public function nacionalidades()
    {
        return view('catalogos.nacionalidades');
    }
    //Listar
    public function datatable(Request $request)
    {        
        return datatables()->of(Catalogo::all()->where('id_tipo_catalogo',$request->id_tipo_catalogo))
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
        $list=Catalogo::All();
        return $list->toJson();
    }
    //Crear
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:catalogos',
            'estado' => 'required|string|max:255',
            'id_tipo_catalogo' => 'required|integer',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        }    
        $Catalogo = Catalogo::create($request->all()); 
        return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
    }
    //Ver
    public function get(Request $request)
    {
        $Catalogo = Catalogo::find($request->id);
        return $Catalogo->toJson();
    }
    //Actualizar
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:catalogos,nombre,'. $request->id,
            'estado' => 'required|string|max:255',
            'id_tipo_catalogo' => 'required|integer',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        }
        $Catalogo = Catalogo::find($request->id);
        $Catalogo->update($request->all());
        return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
    }
    //Borrar
    public function delete(Request $request)
    {
        $Catalogo = Catalogo::find($request->id);
        $Catalogo->delete();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function list_query(Request $request)
    {
        switch ($request->by)
        {
            case 'id_tipo_catalogo':
                $list=Catalogo::All()
                ->where('id_tipo_catalogo',$request->id_tipo_catalogo)
                ->where('estado','ACTIVO');
                return $list;
            break;
            case 'all':
                $list=Catalogo::All();
                return $list=Catalogo::All();
            break;         
            default:

            break;
        }
    }
    public function other()
    {
                /*
        $code="";
        foreach( $request->toArray() as $property => $value )
        {
            switch ($property)
            {
                case 'id_tipo_catalogo':
                        return $list_test=Catalogo::All()->where($property,$value);
                    break;
                case 'estado':
                        return $list_test=Catalogo::All()->where($property,$value);
                    break;
                default:
                        return "Propiedad no accesible
                        ";
                    break;  
            }
        }
        */
        //New Code
        /*
        $list_test=Catalogo::All()->where($property,$value);
        $code.=$property.":".$value;
        return $list_test;
        */

        //Code Full
        //$list=Catalogo::All()->where('id_tipo_catalogo',$request->id_tipo_catalogo);
        //return $list;
    }
}
