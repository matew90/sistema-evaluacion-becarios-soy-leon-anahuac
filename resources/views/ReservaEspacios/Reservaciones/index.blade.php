@extends('layout.main')
@section('title')
Reservaciones Anáhuac
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
	.teams-span {
  border: #fff 3px solid;
  padding: 5px 20px;
    padding-top: 5px;
  background: #f1f1f1;
}
</style>
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="mt-0 header-title">Reservaciones Anáhuac</h4>
        <table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th class="w-10 p-2">Nombre</th>
              <th class="w-10 p-2">Lugar</th>
              <th class="w-10 p-2">Fecha</th>
              <th class="w-10 p-2">Hora Inicio</th>
              <th class="w-10 p-2">Hora Final</th>
              <th class="w-10 p-2">Capacidad</th>
              <th class="w-10 p-2">Ver</th>
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
            <h5 class="modal-title mt-0" id="exampleModalLabel"></h5>
            <span></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body"> </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
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
         ajax: "{{route('reservaciones.reservaciones.show')}}",
         columns: [
            { data: 'title' },
            { data: 'place' },
            { data: 'start' },
            { data: 'timeStart' },
            { data: 'timeEnd' },
            { data: 'number' },
            { data: 'options' },
         ]
      });

    });
	
	function view_details(res_uID) {
		var SITEURL = "{{ url('/') }}";
        $("#waiting").show();
        $.post(SITEURL+"/reserva-espacios/reservaciones/mostrar/" + res_uID)
            .done(function(data) {
			for(x of data){}
                console.log(data);
                var text = "";
                text += "<row style=' height: 900px;overflow-y: auto;'>";
                text += "<div class='col-12'>";
                text += "<h4 class='mt-0 header-title'>"+x.title+"</h4>";
                text += '<div class="row">';
                text += '<div class="col-md-12">';
              text += '<div class="form-group">';
               text += ' <label for="name">Espacio</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.place+'">';
             text += ' </div>';
           text += ' </div>';
           text += ' </div>';
			
			if(x.modality>0){
				text += "<div class='row'>";
                text += '<div class="col-md-12">';
              text += '<div class="form-group">';
               text += ' <label for="name">Modalidad de mesas</label>';
				switch (x.modality) {
				   case 1:
			text += '  <input type="text"  class="form-control" readonly value="Conferencia">';
						     break;
					   case 2:
			text += '  <input type="text"  class="form-control" readonly value="Herradura">';
						     break;
					   case 3:
			text += '  <input type="text"  class="form-control" readonly value="Salón de clases">';
						     break;
				   }
                
				
             text += ' </div>';
           text += ' </div>';
			
			}
			
			
			 text += '<div class="row">';
                text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Número de personas</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.number+'">';
             text += ' </div>';
           text += ' </div>'; 
			text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Fecha</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.start+'">';
             text += ' </div>';
           text += ' </div>';
           text += ' </div>';
			
			 text += '<div class="row">';
                text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Hora Inicio</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.timeStart+'">';
             text += ' </div>';
           text += ' </div>'; 
			text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Hora Final</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.timeEnd+'">';
             text += ' </div>';
           text += ' </div>';
           text += ' </div>';
			
			 text += '<div class="row">';
                text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Creado por</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.user+'">';
             text += ' </div>';
           text += ' </div>'; 
			text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Área</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.area+'">';
             text += ' </div>';
           text += ' </div>';
           text += ' </div>';
			
			 text += '<div class="row">';
                text += '<div class="col-md-12">';
              text += '<div class="form-group">';
               text += ' <label for="name">Descripción</label>';
                text += '  <textarea  class="form-control" readonly>'+x.description+'</textarea>';
             text += ' </div>';
           text += ' </div>'; 
           text += ' </div>';
			if(x.resinv==1){
			 text += '<div class="row">'; 
                text += "<h4 class='mt-0 header-title'>Mobiliario</h4>";
			text += '</div>';
			
			text += '<div class="row">';
				for( m of x.mobiliario){
					
                text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">'+m.inv_name+'</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+m.res_inv_number+'">';
             text += ' </div>';
           text += ' </div>'; 
				}
				
           text += ' </div>';
			   }
                text += "</row>";
                $(".modal-body").empty().html(text);
            });
        $('#view_details').modal('show');
        $("#waiting").hide();

    }
</script> 
@endsection