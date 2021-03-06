@extends('layouts.app') @section('styles') @endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="card-title text-primary">Asignación de usuarios a establecimientos</h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-sm-12" id="msg-global">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Usuario</td>
                                <td>Establecimiento</td>
                                <td>Editar</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modals-->
<!-- Modal Datos -->
<div class="modal fade bd-example-modal-lg" id="modal_datos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <center>
                    <h5 class="modal-title" id="title-modal"></h5>
                </center>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" id="form-data" novalidate>
                <input id="id" name="id" value="0" type="hidden">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="nombre"><b>Nombre:</b></label>
                            <input type="text" class="form-control" onkeyup="Mayus(this);" id="name" name="name" placeholder="Nombre"
                                required>
                            <div class="invalid-feedback">
                                Dato necesario.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre"><b>Email:</b></label>
                            <input type="mail" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                            <div class="invalid-feedback">
                                Dato necesario.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="estado"><b>Estado:</b></label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="estado_activo" name="estado" class="custom-control-input bg-danger"
                                    value="ACTIVO" checked>
                                <label class="custom-control-label" for="estado_activo">Activo</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="estado_inactivo" name="estado" class="custom-control-input"
                                    value="INACTIVO">
                                <label class="custom-control-label" for="estado_inactivo">Inactivo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                    <button class="btn btn-success" type="submit">Aceptar<i class="icon-ok"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade bd-example-modal-lg" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h2>¿Está seguro que desea eliminar el registro?</h2>
            </div>
            <div class="modal-footer bg-dark">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                <button class="btn btn-success" id="btn_delete">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Importar -->
<div class="modal fade bd-example-modal-lg" id="modal_importar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Importar Datos</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" id="files" name="files" />                           
                    </div>
                </div>   
                <br>        
                <div class="row">
                    <div class="col-md-12" id="div-btn">
                    </div>
                    <div class="col-md-12">
                        <div id="DatosExcel"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-dark">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                <button class="btn btn-success" id="btn_importar">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('scripts')
<script src="{{ URL::asset('js/scripts/usuarios_establecimientos.js') }}"></script>

@endsection