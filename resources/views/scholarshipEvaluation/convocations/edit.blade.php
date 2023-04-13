@extends('layout.main')
@section('title')
    UAQ | Modificar Convocatoria
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('evaluacion-becarios.convocatoria-becarios.update', $conv) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="periodo" class="col-sm-2 col-form-label text-justify">Periodo<span
                                        class="text-danger">*</span></label>
                                <div class="form-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                        <input class="form-control" type="number" id="periodo" name="periodo"
                                            placeholder="Periodo" value="{{ $conv->conv_period }}" required>
                                    </span>
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
                                            class="dripicons-user mdi-18px"></i></button>
                                    <input class="form-control" type="text" id="nombre" name="nombre"
                                        placeholder="Nombre" minlength="5" maxlength="50" value="{{ $conv->conv_name }}">
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label for="email" class="col-sm-3 col-form-label text-justify">Correo de contacto<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-email-mark-as-unread mdi-18px"></i></button>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Correo de contacto" value="{{ base64_decode($conv->conv_email) }}">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="fecha_inicio" class="col-sm-2 col-form-label text-justify">Fecha inicio<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-calendar-check-outline mdi-18px"></i></button>
                                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio"
                                        value="{{ $conv->conv_start_date }}">
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label for="fecha_fin" class="col-sm-2 col-form-label text-justify">Fecha final<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-calendar-check-outline mdi-18px"></i></button>
                                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin"
                                        value="{{ $conv->conv_end_date }}">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <table width="100%">
                            <tbody>


                                <table width="100%" style="border: 1px  border-radius: 10px; ">
                                    <tbody>
                                        <tr>
                                            <td class="borde-right text-center"><label class="datInfo"><b>Porcentaje de
                                                        beca</b><span style="color: #8c34ea;"> *</span></label></td>
                                            <td class="borde-right text-center"><label class="datInfo"><b>Horas a la
                                                        semana</b></label></td>
                                            <td class="text-center"><label class="datInfo"><b>Horas al
                                                        semestre</b></label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center borde-right">
                                                @php
                                                    $arrayConv = explode(',', $conv->conv_porcentage);
                                                    foreach ($porcBeca as $key => $conv_porcenta) {
                                                        $soyFacChecked = in_array($key, $arrayConv) ? 'checked=checked' : '';
                                                        echo '
                                                <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="porcBecab' .
                                                            $key .
                                                            '" name="porcentage[]" value="' .
                                                            $key .
                                                            '" ' .
                                                            $soyFacChecked .
                                                            ' required/>
                                                <label class="custom-control-label" for="porcBecab' .
                                                            $key .
                                                            '">' .
                                                            $conv_porcenta .
                                                            '</label>
                                               </div>';
                                                    }
                                                @endphp
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

                                <label for="comentarios" class="col-sm-1 col-form-label text-justify">Comentarios<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-comment mdi-18px"></i></button>
                                    <textarea class="form-control" id="comentarios" name="comentarios" placeholder="Escribe algún comentario" value="{{ $conv->conv_comments }}"></textarea>
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
                                type="submit" id="validate">Actualizar</button>
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
            var periodo = $("#periodo").val();
            var nombre = $("#nombre").val();
            var email = $("#email").val();
            var fecha_inicio = $("#fecha_inicio").val();
            var fecha_fin = $("#fecha_fin").val();
            var check1 = $("#check1").val();
            var check2 = $("#check2").val();
            var check3 = $("#check3").val();
            var check4 = $("#check4").val();
            var comentarios = $("#comentarios").val();

            const date = new Date();
            var day = (date.getDate()).toString().padStart(2, "0");
            var month = (date.getMonth()).toString().padStart(2, "0");
            var year = date.getFullYear();
            var today = year + "-" + month + "-" + day;


            if (nombre.length > 50) {
                Swal.fire({
                    title: "El nombre es demasiado largo",
                    text: "Intenta poner menos palabras en el nombre",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombre").focus();
                return 0;
            }
            if (nombre == "") {
                Swal.fire({
                    title: "Falta poner el nombre de la convocatoria",
                    text: "Formulario incompleto",
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

            } else if (email == "") {
                Swal.fire({
                    title: "Falta indicar el correo de la convocatoria",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email").focus();

            } else if (periodo < 0 || periodo == 0) {
                Swal.fire({
                    title: "Periodo inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();
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
            } else if (periodo < 0 || periodo == 0) {
                Swal.fire({
                    title: "Periodo inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#periodo").focus();
            } else{
                Swal.fire({
                    title: "Convocatoria actualizada correctamente",
                    text: "Registro actualizado",
                    type: "success",
                    confirmButtonText: 'Entendido'
                });
            }
            /* else {
                            var SITEURL = "{{ url('/') }}";
                            var formData = new FormData(document.getElementById("actualizar_convocatoria"));
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
                                    url: SITEURL + "/evaluacion-becarios/convocatoria-becarios/update",
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
                                        window.location.replace(SITEURL + "/evaluacion-becarios/convocatoria-becarios");
                                    });
                                });*/
        });
        //  #Fin validación de formulario

        //--------------VALIDACIONES-------------------------//
    </script>
@endsection
