@extends('layout.main')
@section('title')
    UAQ | Actualización de Coordinador/Evaluador
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form data-user-id="{{ $user->id }}" id="formSendCoordinator">
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
                                    <input readonly class="form-control" type="text" name="idGlobalTalent" id="idGlobalTalent"
                                        value="{{ base64_decode($user->us_banner_id) }}" placeholder="Id Global Talent"
                                        required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                        class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombre" id="nombre"
                                        value="{{ Crypt::decryptString($user->name) }}" placeholder="Nombre" required>
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
                                                class="far fa-building"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="area_id" id="area_id" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="{{$user->area->ar_uID}}">{{ $user->area->ar_name }}</option>
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
                                        @foreach ($lista_degrees as $degree)
                                            <option @if($user->degrees->deg_uID == $degree->deg_uID) selected @endif value="{{ $degree->deg_uID }}">{{ $degree->deg_name }}</option>
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
                                    <button type="button" class="btn btn-primary"> <img src="{{ url('public/img/logos/a-anahuac.png') }}" style="width:15px"
                                        alt=""></button>
                                    <input class="form-control" type="text" name="email" id="email"
                                        value="{{ base64_decode($user->email) }}" placeholder="Correo institucional"
                                        required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Tipo de usuario<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="tipoUsuario_id1" id="tipoUsuario_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary"><i
                                                class="mdi mdi-account-group mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="tipoUsuario_id" id="tipoUsuario_id"
                                        data-select2-id="select2SinglePlaceholder" tabindex="-1" aria-hidden="true"
                                        required>
                                        <option @if($user->rol_uID == 2) selected @endif value="2">Coordinador</option>
                                        <option @if($user->rol_uID == 3) selected @endif  value="3">Evaluador</option>
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
                                            class="fas fa-at 2x"></i></button>
                                    <input class="form-control" type="text" name="email_personal" id="email_personal"
                                        value="{{ base64_decode($user->emailPersonal) }}" placeholder="Correo personal"
                                        required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                                <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                    type="button" id="validateCoordinador">Actualizar</button>
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
            var area_id = $("#area_id").val();
            var grado_id = $("#grado_id").val();
            var email = $("#email").val();
            var email_personal = $("#email_personal").val();
            var tipoUsuario_id = $("#tipoUsuario_id").val();
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
            } else if (email_personal == "") {
                Swal.fire({
                    title: "Falta poner el correo personal del Coordinador/Evaluador",
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
                var convocatoria = "{{$convocatoria}}"
                var formData = new FormData(document.getElementById("formSendCoordinator"));
                var user_id = $("#formSendCoordinator").data("userId");

                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/coordinador-evaluador/update/"+user_id+"/"+convocatoria,
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
                        });
                    });
            }

        });
    </script>
@endsection
