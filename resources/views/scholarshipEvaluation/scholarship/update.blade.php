@extends('layout.main')
@section('title')
    UAQ | Actualizar Becario
@endsection

<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form data-user-id="{{ $user->id }}" data-user-uuid="{{ $user->us_uID }}"  id="formSendBecario" >
                @csrf

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-2 col-form-label text-justify">Id SIU<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input readonly class="form-control" type="text" name="id_SIU" id="id_SIU"
                                        value="{{ base64_decode($user->us_banner_id) }}" required>
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                        class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombre" id="nombre"
                                        value="{{ Crypt::decryptString($user->name) }}" required>
                                </span>
                            </div>

                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Carrera<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="area_id1" id="area_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary"><i
                                                class="fas fa-chalkboard-teacher"></i></button>
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
                                <label class="col-sm-2 col-form-label text-justify">Tipo de beca<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="fas fa-list"></i></button>
                                    <input class="form-control" type="text" name="tipo_beca" id="tipo_beca" required value="{{ $user->recordActive($convocatoria)->sch_type}}">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Porcentaje de beca<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i
                                            class="mdi mdi-percent mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="porcentaje_beca" id="porcentaje_beca" value="{{ $user->recordActive($convocatoria)->sch_porcentage}}"
                                        required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo Institucional<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><img src="{{ url('public/img/logos/a-anahuac.png') }}" style="width:15px"
                                        alt=""></button>
                                    <input class="form-control" type="text" name="email_Institucional"
                                        id="email_Institucional" value="{{ base64_decode($user->email) }}" required>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo personal<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-at 2x"></i></button>
                                    <input class="form-control" type="text" name="email_personal" id="email_personal"
                                        value="{{ base64_decode($user->emailPersonal) }}" required>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 text-right">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                            <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                type="button" id="validate">Actualizar</button>


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
        $("#validate").click(function() {

            var id_SIU = $("#id_SIU").val();
            var us_uID = $("#formSendBecario").data("userUuid");
            var user_id = $("#formSendBecario").data("userId");
            var nombre = $("#nombre").val();
            var apellidoPat = $("#apellidoPat").val();
            var apellidoMat = $("#apellidoMat").val();
            var area_id = $("#area_id").val();
            var tipo_beca = $("#tipo_beca").val();
            var porcentaje_beca = $("#porcentaje_beca").val();
            var email_Institucional = $("#email_Institucional").val();
            var email_personal = $("#email_personal").val();
            if (id_SIU == "") {
                Swal.fire({
                    title: "Falta poner el Id SIU del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#id_SIU").focus();
            } else if (nombre == "") {
                Swal.fire({
                    title: "Falta digitar el nombre del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombre").focus();

            } else if (apellidoPat == "") {
                Swal.fire({
                    title: "Falta indicar el apellido paterno del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPat").focus();

            } else if (apellidoMat == "") {
                Swal.fire({
                    title: "Falta indicar el apellido materno del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMat ").focus();
            }  else if (tipo_beca == "") {
                Swal.fire({
                    title: "Falta seleccionar la carrera a la que pertenece el becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#carrera_id").focus();
            } else if (porcentaje_beca == "") {
                Swal.fire({
                    title: "Falta digitar el porcentaje de la beca",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#porcentaje_beca").focus();
            } else if (email_Institucional == "") {
                Swal.fire({
                    title: "Falta digitar el correo institucional del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_Institucional").focus();
            } else if (email_personal == "") {
                Swal.fire({
                    title: "Falta digitar el correo personal del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personal").focus();
            } else {
                var SITEURL = "{{ url('/') }}";
                var convocatoria = "{{$convocatoria}}"
                var formData = new FormData(document.getElementById("formSendBecario"));
                formData.append("id_SIU", id_SIU);
                formData.append("nombre", nombre);
                formData.append("apellidoPat", apellidoPat);
                formData.append("apellidoMat", apellidoMat);
                formData.append("area_id", area_id);
                formData.append("tipo_beca", tipo_beca);
                formData.append("porcentaje_beca", porcentaje_beca);
                formData.append("email_personal", email_personal);
                formData.append("email_Institucional", email_Institucional);
                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/becarios/update/" + user_id+"/"+convocatoria,
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
                            timer: 6000
                        });
                    });
            }

        });
        //  #Fin validación de formulario

        //--------------VALIDACIONES-------------------------//
    </script>
@endsection
