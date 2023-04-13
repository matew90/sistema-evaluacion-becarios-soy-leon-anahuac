@extends('layout.main')
@section('title')
    UAQ | Listado coordinadores
@endsection
<link href="../../public/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body mb-0">
                    <div class="mt-0 header-title">
                        Importación Coordinadores/Evaluador
                    </div>
                    <div class="col-lg-12">
                        <div class="row justify-content-center mb-4">
                            <form action=" {{ route('evaluacion-becarios.coordinador-evaluador.import') }} " method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-4 justify-content-center mb-4">
                                    <input type="file" id="import_Coordinators" name="import_Coordinators"
                                        class="form-control" accept=".csv" required>
                                </div>
                                <br>
                                <div class="row justify-content-center mb-4">
                                    <button type="submit" class="btn btn-primary">
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
@endsection
<script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
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
            var import_Coordinators= $("#import_Coordinators").val();

            if (import_Coordinators == '') {
                Swal.fire({
                    title: "Seleccione un arhivo",
                    text: "Formulario invalido",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#import_Coordinators").focus();
            }

        });
    </script>
@endsection
