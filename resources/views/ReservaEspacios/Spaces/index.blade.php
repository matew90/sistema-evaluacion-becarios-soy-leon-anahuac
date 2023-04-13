@extends('layout.main')
@section('title')
Espacios Anáhuac
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('/public/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<style>
	#datatable tbody tr:nth-child(even){
  background: #ededed;
}
</style>
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mt-0 header-title">Espacios Anáhuac</h4>
        <p class="text-muted mb-4 font-13">Espacios registrados en "Soy León"</code>. </p>
        <table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Capacidad</th>
              <th>Color</th>
              <th>Estatus</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!-- end col --> 
 <!--modal -->
    <div class="modal fade bs-example-modal-center" id="view_details" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="exampleModalLabel">Actualizar espacio</h5>
            <span></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body"> </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary waves-effect waves-light" onClick="updateSpace();">Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!-- end row --> 

@endsection
@section('footer') 
<!-- Sweet-Alert  --> 
<script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script> 
<!-- Required datatable js --> 
<script src="{{ url('/public/plugins/datatables/jquery.dataTables.min.js') }}"></script> 
<script src="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script> 
<!-- Data-Table  --> 
<script src="{{ url('/public/plugins/datatables/dataTables.responsive.min.js') }}"></script> 
<script src="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.js') }}"></script> 
<script>
	 $(document).ready(function(){
$.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	  });
      // DataTable
      $('#datatable').DataTable({
		 "language":{
		 "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
		},
         "processing": true,
         "paging": true,
         ajax: "{{route('espacios.espacios.show')}}",
         columns: [
            { data: 'spa_name' },
            { data: 'spa_person_number' },
            { data: 'spa_color' },
            { data: 'sta_uID' },
            { data: 'options' },
         ]
      });

    });
	
	function delete_space(spa_uID) {
		  var SITEURL = "{{ url('/') }}";
        Swal.fire({	
       title: "¿Estás seguro de eliminar el espacio?",
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
				$.post(SITEURL+"/reserva-espacios/espacios/eliminar/" + spa_uID)
					.done(function(data) {
                    $("#waiting").hide();

                    json = JSON.parse(data);

                    Swal.fire({
                        title: json.title,
                        text: json.text,
                        type: json.type,
                        confirmButtonText: 'Entendido',
  						showConfirmButton: "true"
                   }).then(function(){
						window.location.replace(SITEURL+"/reserva-espacios/espacios");
						})
                });
            }
        })
    }
	
	function view_details(spa_uID) {
		var SITEURL = "{{ url('/') }}";
        $("#waiting").show();
        $.post(SITEURL+"/reserva-espacios/espacios/mostrar/" + spa_uID)
            .done(function(data) {
                console.log(data);
                var text = "";
			 text += '<form id="formuploadajax">';
			 text += '	<div class="form-group row">';
                text += ' <label for="example-text-input" class="col-sm-4 col-form-label text-right">Nombre del espacio <span class="text-danger">* </span></label>';
			 text += '  <input class="form-control" type="hidden" name="spa_uID" id="spa_uID" value="'+data.spa_uID+'">';
              text += '  <div class="col-sm-8">';
              text += '    <input class="form-control" type="text" name="name" id="name" value="'+data.spa_name+'">';
             text += '   </div>';
            text += '  </div>';
            text += '  <div class="form-group row">';
              text += '  <label for="example-text-input" class="col-sm-4 col-form-label">Capacidad <span class="text-danger">*</span></label>';
              text += '  <div class="col-sm-8">';
               text += '   <input class="form-control" type="number" name="number" id="number" value="'+data.spa_person_number+'">';
              text += '  </div>';
             text += ' </div>';
			text += '<div class="row">';
               text += ' <label for="example-text-input" class="col-sm-4 col-form-label text-right">Color <span class="text-danger">*</span></label>';
              text += '  <div class="col-8">';
               text += '   <input class="form-control" type="color" value="'+data.spa_color+'" name="color" id="color">';
               text += ' </div>';
               text += ' <div class="col-1"> <i id="previewIcon" class="" style="font-size:30px"></i> </div>';
             text += ' </div>';
             text += ' </form>';
                $(".modal-body").empty().html(text);
            });
        $('#view_details').modal('show');
        $("#waiting").hide();

    }
	
	function updateSpace() {
		 var SITEURL = "{{ url('/') }}";
    var spa_uID = $("#spa_uID").val();
    var name = $("#name").val();
    var number = $("#number").val();
    var color = $("#color").val();
		var formData = new FormData(document.getElementById("formuploadajax"));
     formData.append("spa_uID", spa_uID);
     formData.append("name", name);
     formData.append("number", number);
     formData.append("color", color);
         $.ajax({
       url:SITEURL+"/reserva-espacios/espacios/editar",
       type: "POST",
       dataType: "json",
       data: formData,
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(res) {
			 console.log(res);
       json = jQuery.parseJSON(JSON.stringify(res));
         Swal.fire({
           title: json.title,
           text: json.text,
           type: json.type,
			  confirmButtonText: 'Entendido'
         }).then(function(){
			window.location.replace(SITEURL+"/reserva-espacios/espacios");
			});
            });
	}
	
</script> 
@endsection