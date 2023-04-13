@extends('layout.main')
@section('title')
    UAQ | Historial de Becarios
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/public/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    #listado_becarios {
        display: block;
    }

    #listado_coordinadores {
        display: none;
    }
    #becarios th{
        background-color: #9267DC !important;
        color: #ffffff;
    }
    #coordinadores th{
        background-color: #9267DC !important;
        color: #ffffff;
    }
</style>
@section('filter')
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_becarios" onclick="listado_becarios();" class="btn btn-lg btn-block"
                    style="border-color:#8c34ea ;color: #8c34ea;">
                    Listado Becarios <i id="link_becario" class="mdi mdi-school mdi-24px" style="color: #8c34ea"></i>
                </button>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_coordinadores" onclick="listado_coordinadores();" class="btn btn-lg btn-block"
                    style="border-color:#8c34ea ;color: #8c34ea;">
                    Listado Coordinadores <i id="link_coordinador" class="mdi mdi-account-group mdi-24px" style="color: #8c34ea"></i>

                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row pt-2" id="listado_becarios">
        <div class="col-lg-12">
            <table id="becarios" class="table table-bordered dt-responsive nowrap text-center"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>ID alumno</th>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Correo</th>
                        <th>Tipo de Beca</th>
                        <th>% beca</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_arr as $key => $value)
                        <tr>
                            <td>{{ $value['us_banner_id'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['ar_uID'] }}</td>
                            <td>{{ $value['email'] }}</td>
                            <td>{{ $value['sch_type'] }}</td>
                            <td>{{ $value['sch_porcentage'] }}</td>
                            <td>

                                <span id='{{ $value['us_uID'] }}' conv="{{ $convocatoria }}" class='btn btn-outline-purple waves-effect waves-light mr-2' onclick='update_becario(this, this.id)''><i
                                        class='mdi mdi-circle-edit-outline mdi-24px' style='color:#7043c1'></i></span>
                                <span id='{{ $value['us_uID'] }}' conv="{{ $convocatoria }}"  class='btn btn-outline-purple waves-effect waves-light' onclick='delete_becario(this, id)'><i
                                        class='mdi mdi-trash-can mdi-24px ' style='color:#7043c1'></i></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row pt-2" id="listado_coordinadores">
        <div class="col-lg-12">
            <table id="coordinadores" class="table table-bordered dt-responsive nowrap text-center"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>ID alumno</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_coo as $key => $value)
                        <tr>
                            <td>{{ $value['us_banner_id'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td>{{ $value['ar_uID'] }}</td>
                            <td>{{ $value['email'] }}</td>
                            <td>{{ $value['rol_uID'] }}</td>
                            <td>
                                <span id='{{ $value['us_uID'] }}' conv="{{ $convocatoria }}" class='btn btn-outline-purple waves-effect waves-light mr-2' data-toggle="tooltip" data-placement="top" title="Actualizar registro" onclick='update_coordinador(this, this.id)''><i
                                        class='mdi mdi-circle-edit-outline mdi-24px' style='color:#7043c1'></i></span>
                                <span id='{{ $value['us_uID'] }}' conv="{{ $convocatoria }}" class='btn btn-outline-purple waves-effect waves-light' data-toggle="tooltip" data-placement="top" title="Eliminar registro" onclick='delete_coordinador(this, this.id)'><i
                                        class='mdi mdi-trash-can mdi-24px ' style='color:#7043c1'></i></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
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
        function listado_becarios() {
            document.getElementById('listado_becarios').style.display = 'block';
            document.getElementById('listado_coordinadores').style.display = 'none';
            document.getElementById('btn_becarios').style.background ="#9267DC";
            document.getElementById('btn_becarios').style.color ="#ffffff";
            document.getElementById('btn_coordinadores').style.background ="#ffffff";
            document.getElementById('btn_coordinadores').style.color ="#9267DC";
            document.getElementById('link_becario').style.color="#ffffff";
            document.getElementById('link_coordinador').style.color="#9267DC";
        }
    </script>

    <script>
        function listado_coordinadores() {
            document.getElementById('listado_becarios').style.display = 'none';
            document.getElementById('listado_coordinadores').style.display = 'block';
            document.getElementById('btn_coordinadores').style.background ="#9267DC";
            document.getElementById('btn_coordinadores').style.color ="#ffffff";
            document.getElementById('btn_becarios').style.background ="#ffffff";
            document.getElementById('btn_becarios').style.color ="#9267DC";
            document.getElementById('link_coordinador').style.color="#ffffff";
            document.getElementById('link_becario').style.color="#9267DC";
        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // DataTable

            $('#becarios').DataTable({
                "language": {
                    "lengthMenu": " Mostrar _MENU_ registros por página",
                    "zeroRecords": "No hay coincidencias - disculpa",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "processing": true,
                "paging": true,
            });
            $('#coordinadores').DataTable({
                "language": {
                    "lengthMenu": " Mostrar _MENU_ registros por página",
                    "zeroRecords": "No hay coincidencias - disculpa",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "processing": true,
                "paging": true,
            });

        });

        function delete_becario(element, us_uID) {
            let conv = $(element).attr("conv");
            if(conv == undefined || conv == null){
                Swal.fire({
                title: "Espere un momento...",
                text: "Espere un momento, el sitio aun no carga",
                type: "warning"});
                return;
            }
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de eliminar el becario?",
                type: "warning",
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    $.post(SITEURL + "/evaluacion-becarios/becarios/eliminar/" + us_uID+"/"+conv)
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
                              //  window.location.replace(SITEURL + "/evaluacion-becarios/becarios/");
                                window.location.reload();
                            })
                        });
                }
            })
        }
        function delete_coordinador(element,coord_uID) {
            let conv = $(element).attr("conv");
            if(conv == undefined || conv == null){
                Swal.fire({
                title: "Espere un momento...",
                text: "Espere un momento, el sitio aun no carga",
                type: "warning"});
                return;
            }
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de eliminar el coordinador'?",
                type: "warning",
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    $.post(SITEURL + "/evaluacion-becarios/coordinador-evaluador/eliminar/" + coord_uID + "/"+ conv)
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
                                //window.location.replace(SITEURL + "/evaluacion-becarios/coordinador-evaluador/");
                                window.location.reload();
                            })
                        });
                }
            })
        }

        function update_becario(element, us_uID) {
            let conv = $(element).attr("conv");
            if(conv == undefined || conv == null){
                Swal.fire({
                title: "Espere un momento...",
                text: "Espere un momento, el sitio aun no carga",
                type: "warning"});
                return;
            }
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "Actualizar becario",
                text: "¿Estás seguro de actualizar al Becario?",
                type: "warning",
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Actualizar',

                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    window.location.replace(SITEURL + "/evaluacion-becarios/becarios/editar/" + us_uID+'/'+conv);

                }
            })
        }
        function update_coordinador(element, us_uID) {
            let conv = $(element).attr("conv");
            if(conv == undefined || conv == null){
                Swal.fire({
                title: "Espere un momento...",
                text: "Espere un momento, el sitio aun no carga",
                type: "warning"});
                return;
            }
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "Actualizar coordinador",
                text: "¿Estás seguro de actualizar al coordinador?",
                type: "warning",
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Actualizar',

                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    window.location.replace(SITEURL + "/evaluacion-becarios/coordinador-evaluador/editar/" + us_uID+'/'+conv);

                }
            })
        }
    </script>
@endsection
