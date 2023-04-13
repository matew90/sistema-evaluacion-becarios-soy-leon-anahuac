@extends('layout.main')
@section('title')
    UAQ | Crear Convocatoria
@endsection
<link href="../../public/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12 pt-4">
            <form id="formuploadajax">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="periodo" class="col-sm-2 col-form-label text-justify">Periodo<span
                                        class="text-danger">*</span></label>

                                <div class="input-group " name="periodo_id1" id="periodo_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="periodo" id="periodo" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="202360">202360</option>
                                        <option value="202430">202430</option>
                                        <option value="202460">202460</option>
                                        <option value="202530">202530</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="nombre" class="col-sm-2 col-form-label text-justify">Nombre<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-book-open-page-variant mdi-18px"></i></button>
                                    <input class="form-control" type="text" id="nombre" name="nombre"
                                        placeholder="Nombre" minlength="5" maxlength="25">
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label for="email" class="col-sm-3 col-form-label text-justify">Correo de
                                    contacto<span class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-email-mark-as-unread mdi-18px"></i></button>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Correo de contacto">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="fecha_inicio" class="col-sm-2 col-form-label text-justify">Fecha
                                    inicio<span class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-calendar-check-outline mdi-18px"></i></button>
                                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio">
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label for="fecha_fin" class="col-sm-2 col-form-label text-justify">Fecha final<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-calendar-check-outline mdi-18px"></i></button>
                                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <table width="100%">
                            <tbody>


                                <table width="100%" style=" border-radius: 10px;">
                                    <tbody>
                                        <tr>
                                            <td class="borde-right text-center"><label class="datInfo"><b>Porcentaje
                                                        de beca</b><span style="color: #8c34ea;"> *</span></label>
                                            </td>
                                            <td class="borde-right text-center"><label class="datInfo"><b>Horas a la
                                                        semana</b></label></td>
                                            <td class="text-center"><label class="datInfo"><b>Horas al
                                                        semestre</b></label></td>
                                        </tr>
                                        <tr>

                                            <td class="borde-right text-center">

                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="porcBecab"
                                                        name="porcentage[]" value="b" required>
                                                    <label class="custom-control-label" for="porcBecab">5% a
                                                        25%</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="porcBecac"
                                                        name="porcentage[]" value="c" required>
                                                    <label class="custom-control-label" for="porcBecac">26% a
                                                        50%</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="porcBecad"
                                                        name="porcentage[]" value="d" required>
                                                    <label class="custom-control-label" for="porcBecad">51% a
                                                        75%</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="porcBecae"
                                                        name="porcentage[]" value="e" required>
                                                    <label class="custom-control-label" for="porcBecae">76% a
                                                        100%</label>
                                                </div>
                                            </td>

                                            <td class="text-center borde-right">
                                                <div> 2 </div>
                                                <div> 4 </div>
                                                <div> 6 </div>
                                                <div> 8 </div>
                                            </td>
                                            <td class="text-center">
                                                <div> 30 </div>
                                                <div> 60 </div>
                                                <div> 90 </div>
                                                <div> 120 </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-12">

                                <label for="comentarios" class="col-sm-1 col-form-label text-justify">Comentarios</label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-comment mdi-18px"></i></button>
                                    <textarea class="form-control" id="comentarios" name="comentarios" placeholder="Escribe algún comentario"
                                        type="text" maxlength="250"></textarea>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 text-right">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                            <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                type="button" id="validate">Registrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
            var periodo = $("#periodo").val();
            var nombre = $("#nombre").val();
            var email = $("#email").val();
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();
            var check1 = $("#check1").val();
            var check2 = $("#check2").val();
            var check3 = $("#check3").val();
            var check4 = $("#check4").val();
            var expReg2 = /^[a-zA-Z0-9._-]+@gmail.com/;
            var expReg = /^[a-zA-Z0-9._-]+@anahuac.mx/;
            var esValido = expReg.test(email);

            const date = new Date();
            var day = (date.getDate()).toString().padStart(2, "0");
            var month = (date.getMonth()).toString().padStart(2, "0");
            var year = date.getFullYear();
            var today = year + "-" + month + "-" + day;

            if (periodo.length > 8) {
                Swal.fire({
                    title: "El periodo inválido",
                    text: "Intenta poner 8 caracteres",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();
            } else if (nombre.length > 25) {
                Swal.fire({
                    title: "El nombre es demasiado largo",
                    text: "Intenta poner menos palabras en el nombre",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombre").focus();
            } else if (periodo == "") {
                Swal.fire({
                    title: "Falta indicar el periodo de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();

            } else if (periodo < 0 || periodo == 0) {
                Swal.fire({
                    title: "Periodo inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();
            } else if (nombre == "") {
                Swal.fire({
                    title: "Falta poner el nombre de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombre").focus();
            } else if (email == "") {
                Swal.fire({
                    title: "Falta indicar el correo de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email").focus();

            } else if (esValido == false) {
                Swal.fire({
                    title: "El correo institucional es inválido, recuerda debe ser extensión @anahuac.mx",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email").focus();
            } else if (fecha_inicio == "" || fecha_inicio == undefined) {
                Swal.fire({
                    title: "Falta indicar la fecha inicio de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#fecha_inicio").focus();
            } else if (fecha_fin == "" || fecha_fin == undefined) {
                Swal.fire({
                    title: "Falta indicar la fecha fin de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#fecha_fin").focus();
            } else if (fecha_fin < fecha_inicio) {
                Swal.fire({
                    title: "La fecha final debe ser mayor a la fecha inicio",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#fecha_fin").focus();
            } else if (fecha_inicio < today) {
                Swal.fire({
                    title: "La fecha inicio debe ser ",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#fecha_inicio").focus();
            } else if (periodo < 0 || periodo == 0) {
                Swal.fire({
                    title: "Periodo inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();
            } else {

                var SITEURL = "{{ url('/') }}";
                var formData = new FormData(document.getElementById("formuploadajax"));
                formData.append("perido", periodo);
                formData.append("nombre", nombre);
                formData.append("email", email);
                formData.append("fecha_inicio", fecha_inicio);
                formData.append("fecha_fin", fecha_fin);
                formData.append("check1", check1);
                formData.append("check2", check2);
                formData.append("check3", check3);
                formData.append("check4", check4);
                formData.append("comentarios", comentarios)

                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/convocatoria/crear",
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
                            window.location.replace(SITEURL + "/evaluacion-becarios/convocatoria");
                        });
                    });
            }

        });
        //  #Fin validación de formulario

        //--------------VALIDACIONES-------------------------//
    </script>
@endsection
