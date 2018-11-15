<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="css/fontello.css" rel="stylesheet">
<meta name="_token" content="{{csrf_token()}}" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-auto">
                            <button class="btn btn-dark" id="btn-test">Test</button>
                            <button class="btn btn-outline-success" onclick="Test();">Test2</button>
                        </div>
                    </div>


                    <h4>Usuarios Registrados:</h4>
                    <table id="users-table" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>




<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script>

    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.users') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                }
            ],
            dom: 'Bfrtip',
            buttons: [
                'pageLength', 'excel', 'pdf', 'print', 'colvis'
            ],
        });
    });
    $(document).ready(function () {
        $('#btn-test').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/usuarios/create') }}",
                method: 'post',
                data: {
                    name: "test6",
                    email: "test6@test.com",
                    password: "123456"
                },
                success: function (result) {
                    console.log(result);
                },
                error: function (result) {
                    console.log(result);
                },

            });
        });
    });
</script>