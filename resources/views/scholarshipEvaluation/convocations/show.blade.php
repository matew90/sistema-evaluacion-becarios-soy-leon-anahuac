@extends('layout.main')
@section('title')
    UAQ | Historial de Convocatorias
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">


            <div class="table-responsive p-3">
                <div class="dataTable_wrapper dt-boostrap-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">

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
            <div class="row">
                @foreach ($convocatorias as $conv)
                    @csrf


                    <div class="col-lg-4">

                        <div class="card profile-card">
                            <div class="card-body bg-soft-info p-0">
                                <div class="media p-3  align-items-center" style="background: #9267DC; color: #ffffff">
                                    <div class="media-body ml-3  align-self-center">
                                        <h4 class="mb-1">Convocatoria
                                            <br>
                                            {{ $conv->conv_name }}
                                        </h4>
                                        <p class="mb-0 font-12">{{ base64_decode($conv->conv_email) }}</p>
                                    </div>

                                    <div class="btn-group mb-2 mb-md-0">
                                        <button type="button" class="btn btn-soft dropdown-toggle"
                                            style="background:#ffffff; color:#7043c1" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"> Opciones </button>

                                        <div class="dropdown-menu">

                                            <form
                                                action="{{ route('evaluacion-becarios.convocatoria-becarios.show', [$conv->conv_uID]) }}">
                                                <button class="btn btn-round mr-1"
                                                    style="background:#ffffff; color:#7043c1"><i
                                                        class="mdi dripicons-scale mdi-18px" style="color:#7043c1"></i>
                                                    Asignaciones </button>
                                            </form>
                                            <form
                                                action="{{ route('evaluacion-becarios.becarios.show', [$conv->conv_uID]) }}">

                                                <button class="btn btn-round mr-1"
                                                    style="background:#ffffff; color:#7043c1"><i
                                                        class="mdi mdi-format-list-bulleted-type mdi-18px"
                                                        style="color:#7043c1"></i> Lista registros</button>
                                            </form>
                                            <form action="{{ route('evaluacion-becarios.becarios.create') }}">
                                                <input type="hidden" value="{{ $conv->conv_uID }}" name="conv">
                                                <button class="btn btn-round mr-1"
                                                    style="background:#ffffff; color:#7043c1"><i
                                                        class="mdi mdi-account mdi-18px" style="color:#7043c1"></i> Alta registro
                                                </button>
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form
                                                action="{{ route('evaluacion-becarios.convocatoria-becarios.edit', [$conv->id]) }}">
                                                <button class="btn btn-round mr-1"
                                                    style="background:#ffffff; color:#7043c1"><i
                                                        class="mdi mdi-circle-edit-outline mdi-18px"
                                                        style="color:#7043c1"></i> Editar conv. </button>
                                            </form>
                                            <form
                                                action="{{ route('evaluacion-becarios.convocatoria-becarios.delete_conv', [$conv->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-round mr-1"
                                                    style="background:#ffffff; color:#7043c1"><i
                                                        class="mdi mdi-trash-can mdi-18px " style="color:#7043c1"></i>
                                                    Eliminar conv. </button>

                                            </form>

                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="card-body socials-data p-0">
                                <div class="row text-center m-0">

                                    <div class="col-md-4 col-sm-12 border-right py-3">
                                        <h5 class="mt-0 mb-1">Periodo</h5>
                                        <span class="font-14 text-muted">{{ $conv->conv_period }}</span>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-4 col-sm-12 border-right py-3">
                                        <h5 class="mt-0 mb-1">Fecha inicio</h5>
                                        <span class="font-14 text-muted">{{ $conv->conv_start_date }}</span>
                                    </div>
                                    <!--end col-->

                                    <div class="col-md-4 col-sm-12 border-right py-3">
                                        <h5 class="mt-0 mb-1">Fecha Final</h5>
                                        <span class="font-14 text-muted">{{ $conv->conv_end_date }}</span>
                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->

                        </div>
                        <!--end col-->
                    </div>
                    <!--end col-lg-4-->
                @endforeach
            </div>


        </div>
    </div>
@endsection
@section('footer')
    <!-- Sweet-Alert  -->
    <script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

    <script>

        $('.formulario-eliminar').submit(function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estas seguro de eliminar esta convocatoria?',
                text: "¡No se puede revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '¡Cancelar!',
                confirmButtonText: '¡Si, guardar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
        function delete_convocatoria(conv_uID) {
            var SITEURL = "{{ url('/') }}";
            Swal.fire({
                title: "¿Estás seguro de eliminar la convocatoria'?",
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
                    $.post(SITEURL + "/evaluacion-becarios/coordinador-evaluador/borrar/" + conv_uID)
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
    </script>
@endsection
