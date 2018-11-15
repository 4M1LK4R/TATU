var table;
var id=0;
var id_tipo_catalogo=1;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //__Call functions
    ListDataTable();
    catch_parameters();
    //Alert_4MK("Error","test", "msg-global", "warning");
});

function catch_parameters()
{
    var data = $(".form-data").serialize();
    data += "&id="+id;
    data += "&id_tipo_catalogo="+id_tipo_catalogo;
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
        //ajax: "{{ route('Catalogos.DataTable') }}",
        //Metodo para filtrado especial
        ajax: {
            url: '../DataTableCatalogos',
            data: function (obj) {
                obj.id_tipo_catalogo = "1";
            }
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
        buttons: [
            //'pageLength', 'excel', 'pdf', 'print', 'colvis'
            /*{
                text: 'Mostrar <i class="icon-list-numbered"></i>',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Mostrar',
                extend: 'pageLength'
            },*/
            {
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
            },
            //btn Import from Excel
            {
                text: '<i class="icon-upload"></i>',
                className: 'rounded btn-success m-2',
                action: function () {
                    ModalImport();
                }
            }
            //{
            //    text: 'My button',
            //    action: function ( e, dt, node, config ) {
            //        alert( 'Button activated' );
            //    }
            //}

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
    $("#title-modal").html("Registrar Nuevo Tipo de Establecimiento");
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
    id=0;

};

function SaveNew() {
    //console.log("Guardando...");
    $.ajax({
        url: "../Catalogos/Create",
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
        url: "../Catalogos/Get",
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
    id= obj.id;
    $("#nombre").val(obj.nombre);
    $("#id_tipo_catalogo").val(obj.id_tipo_catalogo);
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
            url: "../Catalogos/Update",
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
    id= id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "../Catalogos/Delete",
        method: 'get',
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







//===============================================
//              IMPORT EXCEL
//===============================================
function ModalImport() {
    $('#files').val("");
    $('#DatosExcel').html("");
    $('#div-btn').html("");
    $('#modal_importar').modal('show');
}
var result;
function handleFile(e) {
    //Get the files from Upload control
    var files = e.target.files;
    var i, f;
    //Loop through files
    for (i = 0, f = files[i]; i != files.length; ++i) {
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function (e) {
            var data = e.target.result;

            var workbook = XLSX.read(data, {
                type: 'binary'
            });

            var sheet_name_list = workbook.SheetNames;
            sheet_name_list.forEach(function (y) { /* iterate through sheets */
                //Convert the cell value to Json
                var roa = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
                if (roa.length > 0) {
                    result = roa;

                }
            });
            //Get the first column first cell value
            // alert(result[0].Column1);
        };
        reader.readAsArrayBuffer(f);
    }
    $("#div-btn").html('<button class="btn btn-primary" onclick="MostrarDatosExcel();">Mostrar <i class="icon-eye"></i></button>');
}
//Change event to dropdownlist
$(document).ready(function () {
    $('#files').change(handleFile);
});
function MostrarDatosExcel() {
    console.log(result);
    var cadena = "";
    cadena = "<table id='table-excel' class='table'>";
    cadena += "<thead>";
    cadena += "<tr>";
    cadena += "<th>Nombre</th>";
    cadena += "<th>Estado</th>";
    cadena += "</tr>";
    cadena += "</thead>";
    cadena += "<tbody>";
    for (var i = 0; i < result.length; i++) {
        //console.log(result[i]);
        cadena += "<tr>";
        cadena += "<td>" + result[i].Nombre + "</td>";
        cadena += "<td>" + result[i].Estado + "</td>";
        cadena += "</tr>";
    }
    cadena += "</tbody>";
    cadena += "</table>";
    $('#DatosExcel').html(cadena);
    var table= $("#table-excel").DataTable({
        language: {
            "url": "/js/Spanish.json"
        },
    });





};
function Guardar() {

    for (var i = 0; i < result.length; i++) {
        console.log(result[i]);
        var objeto = {
            nro: result[i].Nro,
            nom: result[i].Nombre,
            ape: result[i].Apellido,
            not: result[i].Nota
        };
        //getJSON("/Modulo/GuardarMateria", materia, function (obj) {
        console.log(objeto + 'registrado');
        //});
    }


};