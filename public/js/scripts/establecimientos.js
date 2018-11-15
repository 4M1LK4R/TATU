var table;
var id = 0;
var title_modal_data = "Registrar Nuevo Establecimiento";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //__Call functions
    SelectTiposEstablecimientos();
    ListDataTable();
    catch_parameters();
    //Alert_4MK("Error","test", "msg-global", "warning");
});

function catch_parameters() {
    var data = $(".form-data").serialize();
    data += "&id=" + id;
    //console.log(data);
    return data;
}

function ListDataTable() {
    table = $('#table').DataTable({
        //dom: 'Bfrtip',
        //dom:'lBfrtip',
        dom: 'lfBrtip',
        processing: true,
        language: {
            "url": "/js/Spanish.json"
        },
        serverSide: true,
        "paging": true,
        //Metodo para filtrado especial
        ajax: {
            url: '../DataTableEstablecimientos'
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'nombre'
            },
            {
                data: 'estado'
            },
            {
                data: 'tipo_establecimiento'
            },

            {
                data: 'editar',
                orderable: false,
                searchable: false
            },
            {
                data: 'eliminar',
                orderable: false,
                searchable: false
            },
        ],
        buttons: [{
                text: '<i class="icon-eye"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Columnas',
                extend: 'colvis'
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-excel"></i>',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Excel',
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            //btn Refresh
            {
                text: '<i class="icon-arrows-cw"></i>',
                className: 'rounded btn-info m-2',
                action: function () {
                    table.ajax.reload();
                }
            }
        ],
    });
};

//__Save New or Save
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('form-data');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    //__Stop Event Submit
                    event.preventDefault();
                    event.stopPropagation();
                    if (id == 0) {
                        SaveNew();
                    } else {
                        Save();
                    }
                    $('#modal_datos').modal('hide');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$('#btn-agregar').click(function () {
    ClearInputs();
    $("#title-modal").html(title_modal_data);
    $('#modal_datos').modal('show');
});

function ClearInputs() {
    //$("#nombre").val("");
    //$('#estado_activo').prop('checked', true);

    //__Remove class form-data of controls 
    var forms = document.getElementsByClassName('form-data');
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });

    //__Clean values of inputs
    $("#form-data")[0].reset();
    id = 0;

};

function SaveNew() {
    //console.log("Guardando...");
    $.ajax({
        url: "../Establecimientos/Create",
        method: 'post',
        data: catch_parameters(),
        success: function (result) {
            //console.log(result);
            if (result.success) {
                Alert_4MK("Correcto: ", result.msg, "msg-global", "success");
            } else {
                Alert_4MK("Alerta: ", result.msg, "msg-global", "warning");
            }
        },
        error: function (result) {
            Alert_4MK("Error: ", result.errors, "msg-global", "danger");
            console.log(result);
        },
    });

    table.ajax.reload();
}

//__Show Data of Obj
function Show(id) {
    //console.log(id);
    $.ajax({
        url: "../Establecimientos/Get",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            Alert_4MK("Error: ", result, "msg-global", "danger");
            console.log(result);
        },

    });
};
var values_old;

function show_data(obj) {
    ClearInputs();
    obj = JSON.parse(obj);
    id = obj.id;
    $("#nombre").val(obj.nombre);
    $("#id_tipo_establecimiento").val(obj.id_tipo_establecimiento);
    if (obj.estado == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.estado == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#title-modal").html("Editar Registro");

    values_old = $(".form-data").serialize();

    $('#modal_datos').modal('show');
};

function Save() {
    var values_new = $(".form-data").serialize();
    if (values_old != values_new) {
        $.ajax({
            url: "../Establecimientos/Update",
            method: 'post',
            data: catch_parameters(),
            success: function (result) {
                //console.log(result);
                if (result.success) {
                    Alert_4MK("Correcto: ", result.msg, "msg-global", "success");
                } else {
                    //console.log(result);
                    Alert_4MK("Alerta: ", result.msg, "msg-global", "warning");
                }
            },
            error: function (result) {
                //console.log(result);
                Alert_4MK("Error: ", result.errors, "msg-global", "danger");
            },
        });
        table.ajax.reload();
    }
}

function Delete(id_) {
    id = id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "../Establecimientos/Delete",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                Alert_4MK("Correcto: ", result.msg, "msg-global", "success");
            } else {
                console.log(result);
                Alert_4MK("Alerta: ", result.msg, "msg-global", "warning");
            }
        },
        error: function (result) {
            Alert_4MK("Error: ", result, "msg-global", "danger");
            console.log(result);
        },

    });
    table.ajax.reload();
    $('#modal_eliminar').modal('hide');
});

function Mayus(e) {
    e.value = e.value.toUpperCase();
}

function SelectTiposEstablecimientos() {
    $.ajax({
        url: "../Catalogos/ListQuery",
        method: 'get',
        data: {
            by: "id_tipo_catalogo",
            id_tipo_catalogo: 1
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="tipo-establecimiento"><b>Tipo de Establecimiento:</b></label>';
            code += '<select class="form-control" name="id_tipo_establecimiento" id="id_tipo_establecimiento" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                //console.log(key);
                //console.log(value);
                code += '<option value="' + value.id + '">' + value.nombre + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_tipos_establecimientos").html(code);
        },
        error: function (result) {
            Alert_4MK("Error: ", result, "msg-global", "danger");
            console.log(result);
        },

    });
}