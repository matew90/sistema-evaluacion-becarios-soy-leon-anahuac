@extends('layout.main-full-width')

@section('title')
    UAQ | Historial de convocatorias
@endsection

<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.5/js/buttons.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{ url('/public/vendor/datatables/buttons.server-side.js') }}" crossorigin="anonymous"></script>
<style>
    #asignacionBecarios {
        display: block;
    }

    #importarBecarios {
        display: none;
    }

    #asignarBecarios {
        display: none;
    }

    #importarCoordinadores {
        display: none;
    }

    #importarCoordinadores1 {
        display: none;
    }

    #asignacionBecarios th {
        background-color: #9267DC !important;
        color: #ffffff;
    }

    #becarios th {
        background-color: #9267DC !important;
        color: #ffffff;
    }
    #evaluacionesAsignados th{
        background-color: #9267DC !important;
        color: #ffffff;
    }
</style>

<!-- DataTables -->
<link href="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('/public/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@section('filter')
    <div class="row">
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_asignaciones" onclick="asignacionBecarios();" class="btn btn-lg btn-block"
                    style="border-color:#8c34ea ;color: #8c34ea;">
                    Becarios asignados <i id="link_asignaciones" class="mdi mdi-account-check mdi-24px"
                        style="color: #8c34ea"></i>

                </button>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_asignar" onclick="asignarBecarios();" class="btn btn-lg btn-block btn-outline-success">
                    Asignar becarios <i id="link_asignar" class="mdi mdi-account-multiple-plus mdi-24px"
                        style="color: #208890;"></i>
                    <input type="hidden" id="conv_uID">
                </button>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_importar" onclick="importarBecarios();" class="btn btn-lg btn-block btn-outline-primary">
                    Importar excel <i id="link_importar" class="ti-import mdi-24px" style="color: #FF5900;"></i>
                </button>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-4">
            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="btn_evaluaciones" onclick="importarCoordinadores();"
                    class="btn btn-lg btn-block btn-outline-info">
                    Ver Evaluaciones <i id="link_evaluaciones" class="mdi mdi-bookmark-check mdi-24px"
                        style="color: #1F8890;"></i>
                </button>
            </div>
        </div>
    </div>
@endsection



@section('content')
    <div class="container-fluid" id="container-wrapper">
        <form>
            <div id="importarCoordinadores1">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mb-0">
                            <div class="mt-0 header-title">
                                Importación de Coordinadores
                            </div>
                            <div class="col-lg-12 ">
                                <div class="row justify-content-center mb-4">
                                    <form action=" {{ route('evaluacion-becarios.coordinador-evaluador.import') }} "
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="file" id="import_Coordinators" name="import_Coordinators"
                                                class="form-control" accept=".csv" required>
                                        </div>
                                        <br>
                                        <div class="row justify-content-center mb-4">
                                            <button id="validate" type="submit" class="btn btn-primary">
                                                Importar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="importarCoordinadores">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mb-0">
                            <div class="py-2 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="mt-2  text-primary">EVALUACIONES</h6>
                            </div>
                            <div class="pt-3">

                            </div>
                            <table id="evaluacionesAsignados" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id alumno</th>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                        <th>Id coordinador</th>
                                        <th>Nombre</th>
                                        <th>Área</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12">
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}

                        </div>
                    @endif
                </div>

            </div>

            <div id="importarBecarios">
                <div class="row col-lg-12">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body mb-0">
                                <h5 class="mt-2  text-primary">IMPORTAR BECARIOS</h5>
                                <a class="btn btn_button float-right" style="background:#9267DC; color:#ffffff"
                                    href="https://docs.google.com/spreadsheets/d/1B7fTDhxPqeAmjsSvfth4Y84VobvNTD8mzu_quLDQHDA/edit?usp=sharing">Consultar
                                    ejemplo <i class="fas fa-cloud"></i></a>
                                <div class="container">
                                    <p>Indicaciones:
                                        <br>
                                        1.- Descarga el ejemplo del Excel que debes subir, en el siguiente enlace:
                                        <br>
                                        2.- Verifique que el documento que desea subir cumpla con lo solicitado en el
                                        ejemplo
                                        <br>
                                        3. Seleccione el documento correcto y de clic al botón importar
                                        <br>
                                        4. Para verificar que los datos se hayan subido correctamente puede consultar el
                                        apartado listado o asignar becarios
                                    </p>
                                </div>

                                <div class="col-lg-12">

                                    <div class="row justify-content-center mb-4">
                                        <form action=" {{ route('evaluacion-becarios.becarios.import') }} " method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                                id="conv_uID">
                                            <div class="row">
                                                <input type="file" id="import_Scholarship" name="import_Scholarship"
                                                    class="form-control" accept=".csv" required>
                                            </div>
                                            <br>
                                            <div class="row justify-content-center mb-4">
                                                <button id="validate" type="submit"
                                                    class="btn waves-effect waves-light"
                                                    style="background: #FF5900; color: #ffffff">
                                                    Importar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body mb-0">
                                <h5 class="mt-2  text-primary">IMPORTAR COORDINADORES</h5>
                                <a class="btn btn_button float-right" style="background:#9267DC; color:#ffffff"
                                    href="https://docs.google.com/spreadsheets/d/1B7fTDhxPqeAmjsSvfth4Y84VobvNTD8mzu_quLDQHDA/edit?usp=sharing">
                                    Consultar ejemplo <i class="fas fa-cloud"></i> </a>
                                <div class="container">
                                    <p>Indicaciones:
                                        <br>
                                        1.- Descarga el ejemplo del Excel que debes subir, en el siguiente enlace:
                                        <br>
                                        2.- Verifique que el documento que desea subir cumpla con lo solicitado en el
                                        ejemplo
                                        <br>
                                        3. Seleccione el documento correcto y de clic al botón importar
                                        <br>
                                        4. Para verificar que los datos se hayan subido correctamente puede consultar el
                                        apartado listado o asignar becarios
                                    </p>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="row justify-content-center mb-4">

                                        <form action=" {{ route('evaluacion-becarios.coordinador-evaluador.import') }} "
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                                id="conv_uID">
                                            <div class="row">
                                                <input type="file" id="import_Coordinators" name="import_Coordinators"
                                                    class="form-control" accept=".csv" required>
                                            </div>
                                            <br>
                                            <div class="row justify-content-center mb-4">
                                                <button id="validate" type="submit"
                                                    class="btn waves-effect waves-light"
                                                    style="background: #FF5900; color: #ffffff;">
                                                    Importar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div id="asignacionBecarios">
                <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                            id="conv_uID">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body mb-0">
                            <form method="POST"
                                action="{{ route('evaluacion-becarios.convocatoria-becarios.export') }}">
                                @csrf
                                <div class="py-2 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="mt-2  text-primary">BECARIOS ASIGNADOS</h6>
                                    <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                        id="conv_uID">

                                    <button
                                    class="btn waves-effect waves-light"
                                    style="background: #FF5900; color: #ffffff" type="submit">Generar
                                        reporte</button>
                                </div>
                            </form>
                            <table id="asignacionesBecarios" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id alumno</th>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                        <th>Id alumno</th>
                                        <th>Nombre Coordinador</th>
                                        <th>Área</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div id="asignarBecarios">
                <form id="formAjax" method="" action="">
                    <div class="row col-lg-12">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="py-2 d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="mt-2  text-primary">ASIGNAR BECARIOS</h5>
                                        <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                            id="conv_uID">
                                        <div class="d-flex flex-row float-right">
                                            <select name="select_coordinador" id="select_coordinador"
                                                class=" mb-3 select2-single-placeholder form-control select2-hidden-accessible mt-2 mr-2"
                                                aria-label="Default select example">
                                                <option selected disabled required> Listado de Coordinadores / Evaluadores
                                                </option>
                                                @if ($coordinadores != '')
                                                    @foreach ($coordinadores as $coord)
                                                        <option value="{{ $coord['us_uID'] }}">
                                                            {{ $coord['us_name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="d-flex flex-row align-items-right  justify-content-between">
                                                <a class="btn mb-3 float-right mt-2"
                                                    style="background: #FF5900;color:#ffffff"  type="submit" onclick="asignar()">Asignar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $convocatorias->conv_uID }}" name="conv_uID"
                                        id="conv_uID">

                                    <table id="becarios" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" name="ejemplo" id="ejemplo"
                                                        value="">
                                                </th>
                                                <th>Id alumno</th>
                                                <th>Nombre</th>
                                                <th>Carrera</th>
                                        </thead>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between"
                                        style="background: #9267DC; color: #ffffff">
                                        <form class="d-flex" role="search">
                                            <input name="buscarpor" class="form-control mr-3" type="search"
                                                placeholder="Buscar" aria-label="Buscar">

                                            <button class="btn btn-info" type="submit">Buscar</button>
                                        </form>
                                    </div>
                                    <div class="customer-message align-items-center mt-3">
                                        @if ($coordinadores != '')
                                            @foreach ($coordinadores as $coord1)
                                                @csrf
                                                <p id="titulo-buscador" style="font-size:13px;">ID:
                                                    {{ $coord1['us_banner_id'] }}<b style="color: #66bb6a;"> :
                                                        {{ $coord1['us_name'] }}</b></p>
                                                <div class="text-primary" style="font-size:14px;"> Área:
                                                    {{ $coord1['ar_uID'] }}</div>

                                                <hr>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div style="height:890px; width: auto; overflow: scroll;" id="mySection">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </form>
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
        function importarBecarios() {
            document.getElementById('importarBecarios').style.display = 'block';
            document.getElementById('asignacionBecarios').style.display = 'none';
            document.getElementById('asignarBecarios').style.display = 'none';
            document.getElementById('importarCoordinadores').style.display = 'none';
            document.getElementById('btn_importar').style.background = "#FF5900";
            document.getElementById('btn_importar').style.color = "#ffffff";
            document.getElementById('link_importar').style.color = "#ffffff";
            document.getElementById('btn_asignaciones').style.background = "#ffffff";
            document.getElementById('btn_asignaciones').style.color = "#9267DC";
            document.getElementById('link_asignaciones').style.color = "#9267DC";
            document.getElementById('btn_evaluaciones').style.background = "#ffffff";
            document.getElementById('btn_evaluaciones').style.color = "#1F8890";
            document.getElementById('link_evaluaciones').style.color = "#1F8890";
            document.getElementById('btn_asignar').style.background = "#ffffff";
            document.getElementById('btn_asignar').style.color = "#1BB4A4";
            document.getElementById('link_asignar').style.color = "#1BB4A4";
        }
    </script>
    <script>
        function importarCoordinadores() {
            document.getElementById('importarBecarios').style.display = 'none';
            document.getElementById('asignacionBecarios').style.display = 'none';
            document.getElementById('asignarBecarios').style.display = 'none';
            document.getElementById('importarCoordinadores').style.display = 'block';
            document.getElementById('btn_evaluaciones').style.background = "#1F8890";
            document.getElementById('btn_evaluaciones').style.color = "#ffffff";
            document.getElementById('link_evaluaciones').style.color = "#ffffff";
            document.getElementById('btn_asignaciones').style.background = "#ffffff";
            document.getElementById('btn_asignaciones').style.color = "#9267DC";
            document.getElementById('link_asignaciones').style.color = "#9267DC";
            document.getElementById('btn_importar').style.background = "#ffffff";
            document.getElementById('btn_importar').style.color = "#FF5900";
            document.getElementById('link_importar').style.color = "#FF5900";
            document.getElementById('btn_asignar').style.background = "#ffffff";
            document.getElementById('btn_asignar').style.color = "#1BB4A4";
            document.getElementById('link_asignar').style.color = "#1BB4A4";
        }
    </script>
    <script>
        function asignacionBecarios() {
            document.getElementById('importarBecarios').style.display = 'none';
            document.getElementById('asignacionBecarios').style.display = 'block';
            document.getElementById('asignarBecarios').style.display = 'none';
            document.getElementById('importarCoordinadores').style.display = 'none';
            document.getElementById('btn_asignaciones').style.background = "#9267DC";
            document.getElementById('btn_asignaciones').style.color = "#ffffff";
            document.getElementById('link_asignaciones').style.color = "#ffffff";
            document.getElementById('btn_evaluaciones').style.background = "#ffffff";
            document.getElementById('btn_evaluaciones').style.color = "#1F8890";
            document.getElementById('link_evaluaciones').style.color = "#1F8890";
            document.getElementById('btn_asignar').style.background = "#ffffff";
            document.getElementById('btn_asignar').style.color = "#1BB4A4";
            document.getElementById('link_asignar').style.color = "#1BB4A4";
            document.getElementById('btn_importar').style.background = "#ffffff";
            document.getElementById('btn_importar').style.color = "#FF5900";
            document.getElementById('link_importar').style.color = "#FF5900";
        }
    </script>
    <script>
        function asignarBecarios() {
            document.getElementById('importarBecarios').style.display = 'none';
            document.getElementById('asignacionBecarios').style.display = 'none';
            document.getElementById('asignarBecarios').style.display = 'block';
            document.getElementById('importarCoordinadores').style.display = 'none';
            document.getElementById('btn_asignar').style.background = "#1BB4A4";
            document.getElementById('btn_asignar').style.color = "#ffffff";
            document.getElementById('link_asignar').style.color = "#ffffff";
            document.getElementById('btn_asignaciones').style.background = "#ffffff";
            document.getElementById('btn_asignaciones').style.color = "#9267DC";
            document.getElementById('link_asignaciones').style.color = "#9267DC";
            document.getElementById('btn_evaluaciones').style.background = "#ffffff";
            document.getElementById('btn_evaluaciones').style.color = "#1F8890";
            document.getElementById('link_evaluaciones').style.color = "#1F8890";
            document.getElementById('btn_importar').style.background = "#ffffff";
            document.getElementById('btn_importar').style.color = "#FF5900";
            document.getElementById('link_importar').style.color = "#FF5900";
        }
    </script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                ajax: "{{ route('evaluacion-becarios.convocatoria-becarios.student', ['conv' => $convocatorias]) }}",
                columns: [{
                        data: 'options'
                    },
                    {
                        data: 'us_banner_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'ar_uID'
                    },
                ],

            });
            $('#asignacionesBecarios').DataTable({
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
                ajax: "{{ route('evaluacion-becarios.convocatoria-becarios.asignaciones', ['conv' => $convocatorias]) }}",
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
                        data: 'us_banner_id1'
                    },
                    {
                        data: 'name1'
                    },
                    {
                        data: 'ar_uID1'
                    },
                    {
                        data: 'options'
                    },
                ]
            });
            $('#evaluacionesAsignados').DataTable({
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
                ajax: "{{ route('evaluacion-becarios.convocatoria-becarios.evaluaciones', ['conv' => $convocatorias]) }}",
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
                        data: 'us_banner_id1'
                    },
                    {
                        data: 'name1'
                    },
                    {
                        data: 'ar_uID1'
                    },
                    {
                        data: 'options2'
                    },
                ]
            });

        });
        $(function() {
            $('#ejemplo').change(function() {
                $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
            });
        });

        function asignar() {
            var SITEURL = "{{ url('/') }}";

            var f = $(this);
            var formData = new FormData(document.getElementById("formAjax"));
            $.ajax({
                url: SITEURL + "/evaluacion-becarios/convocatoria/historial/asignar",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(data) {
                console.log(data);
                json = jQuery.parseJSON(JSON.stringify(data));
                Swal.fire({
                    title: json.title,
                    text: json.text,
                    type: json.type,
                    confirmButtonText: 'Entendido',
                    timer: 15000
                }).then(function() {
                    //window.location.replace(SITEURL + "/evaluacion-becarios/convocatoria");
                    window.location.reload();
                });
            })
        }


        function show_evaluation(assig_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Deseas visualizar la evaluación?",
                type: "warning",

                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    window.location.replace(SITEURL + "/evaluacion-becarios/convocatoria/evaluations/" + assig_uID);

                }
            })
        }

        function evaluation(assig_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Deseas realizar la evaluación?",
                type: "info",

                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
                confirmButtonColor: '#4E5CC4',
                cancelButtonColor: '#F93B7A',
            }).then((result) => {
                console.log(result.value);
                $("#waiting").show();

                if (result.value == true) {
                    window.location.replace(SITEURL + "/evaluacion-becarios/convocatoria/evaluations1/" +
                    assig_uID);

                }
            })
        }

        function delete_assigment(assig_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de eliminar el becario asignado?",
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
                    $.post(SITEURL + "/evaluacion-becarios/convocatoria/eliminar/" + assig_uID)
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
                                //window.location.replace(SITEURL +
                                //   "/evaluacion-becarios/convocatoria");
                                window.location.reload();
                            })
                        });
                }
            })
        }
        $(document).on("change", "input[accept='.csv']", function(e) {
            if (hasExtension(this)) {

            } else {
                this.value = "";
                Swal.fire({
                    title: "Error",
                    text: "Extensión no permitida",
                    type: "warning",
                    confirmButtonText: 'Entendido',
                    showConfirmButton: "true"
                })
            }

        });

        function hasExtension(input) {
            var exts = [".csv"];
            var fileName = input.value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
    </script>
    <script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
@endsection
