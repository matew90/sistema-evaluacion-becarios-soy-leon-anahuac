@extends('layout.main')
@section('title')
    UAQ | Alta Coordinador
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="container">

    </div>
    <div class="row">
        <div class="col-lg-12">
            <form id="formSendCoordinator">
                @csrf
                <div class="row">


                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Id Global Talent<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="idGlobalTalent" id="idGlobalTalent"
                                        placeholder="Id Global Talent" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                        class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombre" id="nombre"
                                        placeholder="Nombre" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Paterno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                        class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoPat" id="apellidoPat"
                                        placeholder="Apellido Paterno" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Materno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                        class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoMat" id="apellidoMat"
                                        placeholder="Apellido Materno" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Área<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="area_id1" id="area_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="area_id" id="area_id" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_areas as $area)
                                            @if ($area->ar_subname != '')
                                                {
                                                @php
                                                    $subname = 'La subárea es: /' . $area->ar_subname;
                                                @endphp
                                                }
                                            @else
                                                if(){
                                                @php
                                                    $subname = '';
                                                @endphp
                                                }
                                            @endif
                                            <option value="{{ $area->ar_uID }}">{{ $area->ar_name }} {{ $subname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Grado<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="grado_id1" id="grado_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="grado_id" id="grado_id" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_degrees as $degree)
                                            <option value="{{ $degree->deg_uID }}">{{ $degree->deg_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo institucional<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="email" id="email"
                                        placeholder="Correo institucional" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Tipo de usuario<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="tipoUsuario_id1" id="tipoUsuario_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="tipoUsuario_id" id="tipoUsuario_id"
                                        data-select2-id="select2SinglePlaceholder" tabindex="-1" aria-hidden="true"
                                        required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="2">Coordinador</option>
                                        <option value="3">Evaluador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo personal<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="email_personal" id="email_personal"
                                        placeholder="Correo personal" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                                <button class="btn waves-effect waves-light" style="background: #9267DC; color: #ffffff"
                                    type="button" id="validateCoordinador">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    </div>
@endsection
@section('footer')
    <script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>



    <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        $("#validateCoordinador").click(function() {
            var idGlobalTalent = $("#idGlobalTalent").val();
            var nombre = $("#nombre").val();
            var apellidoPat = $("#apellidoPat").val();
            var apellidoMat = $("#apellidoMat").val();
            var area_id = $("#area_id").val();
            var grado_id = $("#grado_id").val();
            var email = $("#email").val();
            var email_personal = $("#email_personal").val();
            var tipoUsuario_id = $("#tipoUsuario_id").val();
            var expReg2 = /^[a-zA-Z0-9._-]+@gmail.com/;
            var expReg = /^[a-zA-Z0-9._-]+@anahuac.mx/;
            var esValido = expReg.test(email);
            var esValid = expReg2.test(email_personal);
            if (idGlobalTalent == "") {
                Swal.fire({
                    title: "Falta poner el Id Global Talent del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#idGlobalTalent").focus();
            } else if (nombre == "") {
                Swal.fire({
                    title: "Falta poner el nombre del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombre").focus();
            } else if (apellidoPat == "") {
                Swal.fire({
                    title: "Falta poner el Apellido Paterno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPat").focus();
            } else if (apellidoMat == "") {
                Swal.fire({
                    title: "Falta poner apellido Materno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMat").focus();
            } else if (area_id == "") {
                Swal.fire({
                    title: "Falta seleccionar la Área a la que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#area_id").focus();
            } else if (email == "") {
                Swal.fire({
                    title: "Falta poner el correo institucional del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email").focus();
            } else if (esValido == false) {
                Swal.fire({
                    title: "El correo institucional es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email").focus();
            } else if (email_personal == "") {
                Swal.fire({
                    title: "Falta poner el correo personal del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personal").focus();
            } else if (esValid == false) {
                Swal.fire({
                    title: "El correo personal es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personal").focus();
            } else if (grado_id == "") {
                Swal.fire({
                    title: "Falta seleccionar el grado academico del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#grado_id").focus();
            } else if (tipoUsuario_id == "") {
                Swal.fire({
                    title: "Falta seleccionar el Tipo de usuario al que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#tipoUsuario_id").focus();
            } else {
                var SITEURL = "{{ url('/') }}";
                var formData = new FormData(document.getElementById("formSendCoordinator"));
                formData.append("idGlobalTalent", idGlobalTalent);
                formData.append("nombre", nombre);
                formData.append("apellidoPat", apellidoPat);
                formData.append("apellidoMat", apellidoMat);
                formData.append("area_id", area_id);
                formData.append("grado_id", grado_id);
                formData.append("email", email);
                formData.append("email_personal", email_personal);
                formData.append("tipoUsuario_id", tipoUsuario_id);
                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/coordinador-evaluador/crear",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {

                        json = jQuery.parseJSON(JSON.stringify(res));
                        Swal.fire({
                            title: json.title,
                            text: json.text,
                            type: json.type,
                            confirmButtonText: 'Entendido',
                            timer: 15000
                        }).then(function() {
                            window.location.replace(SITEURL +
                                "/evaluacion-becarios/coordinador-evaluador");
                        });
                    });
            }

        });
    </script>
@endsection
