@extends('layout.main')
@section('title')
    UAQ | Importar Becarios
@endsection
<link href="../../public/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body mb-0">
                    <div class="mt-0 header-title">
                        Importación Becarios
                    </div>

                    <div class="col-lg-12">
                        <div class="row justify-content-center mb-4">

                            <form action=" {{ route('evaluacion-becarios.becarios.import') }} " method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="file" id="import_Scholarship" name="import_Scholarship" class="form-control" accept=".csv">
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
            var import_Scholarship = $("#import_Scholarship").val();

            if (import_Scholarship== '') {
                Swal.fire({
                    title: "Seleccione un arhivo",
                    text: "Formulario invalido",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#import_Scholarship").focus();
            } 
            
        });
    </script>
@endsection
