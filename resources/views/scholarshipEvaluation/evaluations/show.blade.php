@extends('layout.main')
@section('title')
  UAQ | Listado de Evaluaciones
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="mt-0 header-title">LISTADO DE EVALUACIONES</h4>
          <p class="text-muted mb-4 font-13">
              Available all products.
          </p>

          <table id="coordinadores" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>ID Coordinador</th>
                <th>Nombre</th>
                <th>Área</th>
                <th>Sub Área</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
    </div>
</div>
@endsection