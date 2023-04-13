@extends('layout.main')
@section('title')
Crear Mobiliario
@endsection
<link href="../../public/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body mb-0">
        <h4 class="mt-0 header-title">Crear Mobiliario</h4>
        <form id="formuploadajax">
          <div class="row"> @csrf
            <div class="col-lg-12">
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre de activo<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="name" id="name">
                </div>
              </div>
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label text-right">Cantidad <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input class="form-control" type="number" value="0" name="number" id="number">
                </div>
              </div>
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-2 col-form-label text-right">Responsable <span class="text-danger">*</span></label>
                <div class="col-9">
					<select name="user" id="user" class="form-control">
						<option value="">Selecciona una opción</option>
					@if (isset($getUsers))
            @foreach ($getUsers as $key => $value)
           <option value="{{$value['us_uID']}}">{{Crypt::decryptString($value['name'])}}</option>
            @endforeach
            @endif
					</select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-center">
                  <button type="button" class="btn btn-primary px-5 py-2" id="submit">Agregar</button>
                </div>
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
<!-- Sweet-Alert  -->
<script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>

  $(document).ready(function() {

  var foption = $('#user option:first');
    var soptions = $('#user option:not(:first)').sort(function (a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    });
	  
    $('#user').html(soptions).prepend(foption);
	  var SITEURL = "{{ url('/') }}";
	  $.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	  });

  });
	 /////////////VALIDACIÓN DE FORMULARIO//////////////////
	 $("#submit").click(function() {
		 var SITEURL = "{{ url('/') }}";
    var name = $("#name").val();
    var number = $("#number").val();
    var user = $("#user").val();
   //--------- VALIDACIONES ---------//
	 if (name.length > 255) {
     Swal.fire({
       title: "El nombre es demasiado largo",
       text: "Intenta poner menos palabras en el nombre",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#name").focus();
     return 0;
   }

  if (name == "") {
     Swal.fire({
       title: "Falta poner el nombre del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#name").focus();
   }  else if (number == "" || number==0) {
     Swal.fire({
       title: "Falta indicar la capacidad del espacio",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#number").focus();
   }else if (user == "" || user==undefined) {
     Swal.fire({
       title: "Falta indicar al responsable del mobiliario",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#user").focus();
   }
	 else {
var formData = new FormData(document.getElementById("formuploadajax"));
     formData.append("name", name);
     formData.append("number", number);
     formData.append("user", user);
         $.ajax({
       url:SITEURL+"/reserva-espacios/inventario/crear",
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
         }).then(function(){
						window.location.replace(SITEURL+"/reserva-espacios/inventario");
						});
            });
   }
	 });
	 /////////////FIN VALIDACIÓN DE FORMULARIO//////////////////

	</script>
@endsection
