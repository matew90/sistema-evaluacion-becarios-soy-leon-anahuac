@extends('layout.main')
@section('title')
    UAQ | Listado coordinadores
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/public/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />



@section('content')
    <div class="row">
        <div class="col-lg-12">

            <table id="coordinadores" class="table table-bordered dt-responsive nowrap text-center"
                style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Área/Sub área</th>
                        <th>Estatus</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection
@section('footer')
    <!-- Sweet-Alert  -->
    <script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ url('/public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Data-Table  -->
    <script src="{{ url('/public/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // DataTable
            $('#coordinadores').DataTable({
                "language": {
                    "lengthMenu": " Mostrar _MENU_ registros por página",
                    "zeroRecords": "No hay coincidencias - disculpa",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate":{
                        "next":"Siguiente",
                        "previous":"Anterior"
                    }
                },
                "processing": true,
                "paging": true,
                ajax: "{{ route('evaluacion-becarios.coordinador-evaluador.show') }}",
                columns: [{
                        data: 'us_banner_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'ar_uID'
                    },
                    {
                        data: 'sta_uID'
                    },
                    {
                        data: 'rol_uID'
                    },
                    {
                        data: 'options'
                    }
                ]
            });

        });

        function delete_coordinator(us_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de eliminar el Coordinador/Evaluador?",
                type: "warning",
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                confirmButtonColor: 'rgb(191, 0, 0)', 
                cancelButtonColor: 'rgb(235, 211, 0)',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    $.post(SITEURL + "/evaluacion-becarios/coordinador-evaluador/eliminar/" + us_uID)
                        .done(function(data) {
                            $("#waiting").hide();

                            json = JSON.parse(data);

                            Swal.fire({
                                title: json.title,
                                text: json.text,
                                type: json.type,
                                confirmButtonText: 'Entendido',
                                showConfirmButton: "true"
                            }).then(function() {
                                window.location.replace(SITEURL +
                                    "/evaluacion-becarios/coordinador-evaluador");
                            })
                        });
                }
            })
        }

        function update_coordinator(us_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de actualizar al Coordinador/Evaluador?",
                type: "warning",
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Actualizar',

                showCancelButton: true,
                confirmButtonColor: 'rgb(146, 103, 220)',
                cancelButtonColor: 'rgb(235, 211, 0)',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    window.location.replace(SITEURL + "/evaluacion-becarios/coordinador-evaluador/editar/" +
                    us_uID);

                }
            })
        }
    </script>
@endsection
