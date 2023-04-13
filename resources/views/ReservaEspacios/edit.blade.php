@extends('layout.main')
@section('title')
Editar Reserva
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
<style>
#adminCat {
	 border-spacing: 10px 20px;
	text-align: center;
	margin-top: 20px;
}
	#adminCat th, td {
  padding: 8px;
}
	#adminCat tbody tr:nth-child(even){
  background: #EEEEEE;
}
</style>
@section('content')
<div class="row">
<div class="col-lg-12">
  <div class="card">
    <div class="card-body mb-0">
      <form id="formuploadajax">
        <div id="secction1" style="display: ">
          <h4 class="mt-0 header-title">Editar Reserva</h4>
          <div id="external-events">
            <p class="text-muted mb-4">Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Nombre del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fab fa-elementor"></i></button>
                  </span>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del evento" value="{{$reservation['title']}}">
                  <input type="hidden" id="res_uID" name="res_uID" class="form-control" placeholder="Nombre del evento" value="{{$reservation['res_uID']}}">
					<input type="hidden" id="res_folio" name="res_folio" class="form-control" placeholder="Nombre del evento" value="{{$reservation['res_folio']}}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="place">Lugar del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                  </span>
                  <select id="place" name="place" class=" form-control" onchange="tableArrangement()">
                    <option value="">Selecciona una opción</option>
                    
					  @if (isset($spaces))
            @foreach ($spaces as $key => $value)
					  @php
					   $select=$reservation['spa_uID'] == $value['spa_uID'] ? "selected" : '';
					  @endphp
                    
                    <option value="{{$value['spa_uID']}}" {{$select}}>{{$value['spa_name']}}</option>
                    
            @endforeach
            @endif
                  
                  </select>
                  <input type="hidden" id="capacidadSpace" name="capacidadSpace" value="{{$number}}" class="form-control" >
                  <input type="hidden" id="spa_uIDBefore" name="spa_uIDBefore" value="{{$reservation['spa_uID']}}" class="form-control" >
                </div>
              </div>
            </div>
          </div>
          @php
          $display=$reservation['res_modality'] >0 ? 'block' : 'none';
          @endphp
          <div class="row">
            <div class="col-md-6" id="tableArrangement" style="display: {{$display}};">
              <div class="form-group">
                <label for="place">Modalidades de mesas <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                  </span>
                  <select id="modality" name="modality" class=" form-control">
                    <option value="" >Selecciona una opción</option>
                    
					  @php
			$select=$reservation['res_modality'] ==1 ? 'selected' : '';
			@endphp
                    
                    <option value="1" {{$select}}>Conferencia</option>
                    
					  @php
				$select=$reservation['res_modality'] ==2 ? 'selected' : '';
			@endphp
                    
                    <option value="2" {{$select}}>Herradura</option>
                    
					  @php
				$select=$reservation['res_modality'] ==3 ? 'selected' : '';
			@endphp
                    
                    <option value="3" {{$select}}>Salón de clases</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6"> </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="dateStart">Fecha inicio del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="far fa-calendar-alt"></i></button>
                  </span> @php
                  $mindate = date("Y-m-d");
                  @endphp
                  <input type="text" id="dateStart" name="dateStart"  placeholder="dd / mm / aaaa"  value="{{$reservation['start']}}" class="form-control" >
                  <input type="hidden" id="dateStartbefore" name="dateStartbefore"  placeholder="dd / mm / aaaa"  value="{{$reservation['start']}}" class="form-control" >
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="timeStart">Hora inicio del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-clock"></i></button>
                  </span>
                  <input type="time" id="timeStart" name="timeStart" min="07:00" max="22:00" step="3600" value="{{$reservation['res_time_start']}}" class="form-control" >
                  <input type="hidden" id="timeStartbefore" name="timeStartbefore" min="07:00" max="22:00" step="3600" value="{{$reservation['res_time_start']}}" class="form-control" >
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="dateEnd">Fecha fin del evento <span class="text-danger">*</span></label>
              <div class="input-group"> <span class="input-group-prepend">
                <button type="button" class="btn btn-primary"><i class="far fa-calendar-alt"></i></button>
                </span>
                <input type="text" id="dateEnd" name="dateEnd" placeholder="dd / mm / aaaa"  value="{{$reservation['end']}}" class="form-control" >
                <input type="hidden" id="dateEndbefore" name="dateEndbefore" placeholder="dd / mm / aaaa"  value="{{$reservation['end']}}" class="form-control" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="timeEnd">Hora fin del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-clock"></i></button>
                  </span>
                  <input type="time" id="timeEnd" name="timeEnd" min="07:00" max="22:00" step="3600" value="{{$reservation['res_time_end']}}" class="form-control" >
                  <input type="hidden" id="timeEndbefore" name="timeEndbefore" min="07:00" max="22:00" step="3600" value="{{$reservation['res_time_end']}}" class="form-control" >
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="number">Número de personas esperadas <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-users"></i></button>
                  </span>
                  <input type="number" id="number" name="number" class="form-control" value="{{$reservation['res_person_number']}}" placeholder="Número de personas esperadas">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="description">Descripción del evento <span class="text-danger">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-audio-description"></i></button>
                  </span>
                  <textarea class="form-control" id="description" name="description" rows="3">{{$reservation['res_description']}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <labemor for="mobiliario">
                ¿Quieres solicitar mobiliario? <span class="text-danger">*</span>
                </label>
                <div class="col-md-9">
                  <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio"> @php
                      $checked=$reservation['resinv'] == 1 ? 'checked' : '';
                      @endphp
                      <input type="radio" id="customRadio7" name="inmobiliario" value="1" {{$checked}} class="custom-control-input">
                      <label class="custom-control-label" for="customRadio7">Si</label>
                    </div>
                  </div>
                  <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio"> @php
                      $checked=$reservation['resinv'] == 2 ? 'checked' : '';
                      @endphp
                      <input type="radio" id="customRadio8" name="inmobiliario" value="2" {{$checked}} class="custom-control-input">
                      <label class="custom-control-label" for="customRadio8">No</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" id="us_uID" name="us_uID"value="{{ $reservation['us_uID'] }}">
          <div class="row">
            <div class="col-sm-12 text-center">
              <button type="button" class="btn btn-primary px-5 py-2" id="validate">Continuar</button>
            </div>
          </div>
        </div>
        <div id="secction2" style="display: none;">
          <div id="external-events"> <br>
            <h4 class="header-title mt-0 mb-3">Mobiliario</h4>
          </div>
          @if (isset($inventories))
          @foreach ($inventories as $keyInv => $valueInv)
          <div class="form-group">
            <label for="inmob">{{$valueInv['inv_name']}}</label>
            <input class="form-control" type="number" value="{{$valueInv['total']}}" name="inmob[{{$valueInv['inv_uID']}}][]" min="1" max="{{$valueInv['inv_number']}}" >
          </div>
          @endforeach
          @endif
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button type="button" class="btn btn-primary px-5 py-2" onClick="returnForm();">Regresar</button>
              </div>
            </div>
            <div class="col-md-6 text-right">
              <div class="form-group">
                <button type="button" class="btn btn-primary px-5 py-2" id="continue">Continuar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      
      <!--modal -->
      <div class="modal fade bs-example-modal-center" id="view_reserva" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content">
            <div class="modal-header"> <span></span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body"> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary waves-effect waves-light" onClick="reservar();">Reservar espacios disponibles</button>
            </div>
          </div>
          <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
      <!-- /.modal --> 
      
    </div>
    <!-- end col --> 
  </div>
  <!--end row--> 
</div>
@endsection
@section('footer') 

<!-- Sweet-Alert  --> 
<script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script> 
<script src="{{ url('/public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> 
<script>

  $(document).ready(function() {

	  var SITEURL = "{{ url('/') }}";
	  $.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	  });

  });
	
	$('#dateStart').datepicker({
			format:'yyyy-mm-dd',
			startDate:new Date(),
			daysOfWeekDisabled: [0]
		});
	    $('#dateEnd').datepicker({
			format:'yyyy-mm-dd',
			startDate:new Date(),
			daysOfWeekDisabled: [0]
		});
	
	/////////////HABILITAR DIV//////////////////
	 function display(number) {
		 element = document.getElementById("viewSpaces");
		  element1 = document.getElementById("newReservation");
	  if(number==1){
		  element.style.display='none';
		  element1.style.display='block';
		 }else{
		   element.style.display='block';
		   element1.style.display='none';
			 }
	   }
	
	
	///////////OBTENEMOS DATOS DEL ESPACIO SELECCIONADO////////////
	 function tableArrangement(){
	var SITEURL = "{{ url('/') }}";
		  var spa_uID = $("#place").val();
		 if(spa_uID=='c03e2fcc-8c8e-4ba0-b40d-e448c23163f0' || spa_uID=='e0287ade-e9e1-4595-8849-418e2d3e79bc' || spa_uID=='f529c394-421f-441a-b7c8-955f14e1e600'){
			document.getElementById("tableArrangement").style.display='block';
			}else{
				document.getElementById("tableArrangement").style.display='none';
			}
		 
		 //////////////OBTENEMOS CAPACIDAD DEL ESPACIO///////////////
		 $.ajax({
       url:SITEURL+'/reserva-espacios/reserva/mostrar/'+spa_uID,
       type: "GET",
       dataType: "json",
       data: {
		   spa_uID:spa_uID
	   },
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(data) {
			 document.getElementById("capacidadSpace").value=data;
		 });
	}
	
	/////////////VALIDACIÓN DE FORMULARIO//////////////////
	 $("#validate").click(function() {
    var name = $("#name").val();
    var place = $("#place").val();
    var placebefore = $("#spa_uIDBefore").val();
    var dateStart = $("#dateStart").val();
    var dateStartbefore = $("#dateStartbefore").val();
    var timeStart = $("#timeStart").val();
    var timeStartbefore = $("#timeStartbefore").val();
    var dateEnd = $("#dateEnd").val();
    var dateEndbefore = $("#dateEndbefore").val();
    var timeEnd = $("#timeEnd").val();
    var timeEndbefore = $("#timeEndbefore").val();
    var number = $("#number").val();
    var description = $("#description").val();
    var us_uID = $("#us_uID").val();
    var modality = $("#modality").val();
    var inmobiliario = $("input[name=inmobiliario]:checked").val();
    var capacidadSpace = $("#capacidadSpace").val();
	const dateH = new Date();
	var day = (dateH.getDate()+ 2).toString().padStart(2, "0");
	var month = (dateH.getMonth() + 1).toString().padStart(2, "0");
	var year = dateH.getFullYear();
	var today= year+ "-" + month + "-" + day;
		 var numberSpaces=Number(capacidadSpace);
		 var numberCapa=Number(number);
		 
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
   }  else if (place == "") {
     Swal.fire({
       title: "Falta indicar el lugar del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#place").focus();
   } else if (place=='c03e2fcc-8c8e-4ba0-b40d-e448c23163f0' && modality=="" || place=='e0287ade-e9e1-4595-8849-418e2d3e79bc' && modality=="" || place=='f529c394-421f-441a-b7c8-955f14e1e600' && modality=="") {
     Swal.fire({
       title: "Falta indicar la modalidad de las mesas",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#place").focus();
   }else if(dateStart=="" || dateStart==undefined){
     Swal.fire({
       title: "Falta indicar la fecha inicio del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#dateStart").focus();
   }else if(timeStart=="" || timeStart==undefined){
     Swal.fire({
       title: "Falta indicar la hora inicio del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#timeStart").focus();
   }else if(dateEnd=="" || dateEnd==undefined){
			Swal.fire({
       title: "Falta indicar la fecha fin del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#dateEnd").focus();
			}else if(timeEnd=="" || timeEnd==undefined){
			Swal.fire({
       title: "Falta indicar la hora fin del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#timeEnd").focus();
			}
			else if(number=="" || number==0){
			Swal.fire({
       title: "Falta indicar el numero de personas esperadas",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#number").focus();
			}
		 else if(numberSpaces < numberCapa){
			Swal.fire({
       title: 'El número de personas no debe ser mayor a '+numberSpaces+'',
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#number").focus();
			}
		 
	 else if (description == "") {
     Swal.fire({
       title: "Falta agregar una descripción del evento",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#description").focus();
   } else if (inmobiliario == "" || inmobiliario==undefined) {
     Swal.fire({
       title: "Falta selecionar una opción",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
     $("#inmobiliario").focus();
   }else if (dateEnd < dateStart) {
     Swal.fire({
       title: "La fecha final debe ser mayor o igual a la fecha inicio",
       text: "Formulario incompleto",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
   }else  if(dateStart <today){
     Swal.fire({
       title: "¡Aviso!",
       text: "El tiempo mínimo para reservar un espacio es de 2 días hábiles con anticipación.",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
   }else if (timeStart < '07:00'){
     Swal.fire({
       title: "¡Aviso!",
       text: "El horario para reservar un espacio es después de las 07:00.",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
   }else if (timeEnd > '22:00'){
     Swal.fire({
       title: "¡Aviso!",
       text: "El horario para terminar una reservar de espacio es antes de las 22:00.",
       type: "warning",
       confirmButtonText: 'Entendido'
     });
   }
	 else {
 var buton = document.getElementById("continue");
		 if(place!=placebefore || dateStart!=dateStartbefore || dateEnd!=dateEndbefore || dateStart!=dateStartbefore || timeStart!=timeStartbefore || timeEnd!=timeEndbefore  ){
			 if(inmobiliario==1){
				  document.getElementById("secction1").style.display='none';
		  document.getElementById("secction2").style.display='block';
				  buton.onclick=preview;
			 }else{
				  preview();
			 }
		 }else{
			  if(inmobiliario==1){
				  document.getElementById("secction1").style.display='none';
		  document.getElementById("secction2").style.display='block';
				  buton.onclick=actualizar;
			  }else{
				  actualizar();
			  }
		 }
		 
   }
	 });

	//////////////REGRESAR FORM/////////////////
	function returnForm(){
		   document.getElementById("secction1").style.display='block';
		  document.getElementById("secction2").style.display='none';
	}


		function preview(){
		 $("#waiting").show();
	var SITEURL = "{{ url('/') }}";
		 var f = $(this);
     var formData = new FormData(document.getElementById("formuploadajax"));
         $.ajax({
       url:SITEURL+"/reserva-espacios/reserva/preview",
       type: "POST",
       dataType: "json",
       data: formData,
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(data) {
			 var text = "";
			 	var nameStyle = document.getElementsByClassName("modal-header")[0].style.background = data[0].color;
   				text += "<row>";
                text += "<div class='col-12'>";
                text += "<h5>"+data[0].place+"</h5>";
                text += "<table id='adminCat' border='0' width='100%' align='center' class='table-striped text-center'>";
				text += "<thead style='background-color: "+data[0].color +"; color: white;'>";
				text += "<th>Día</th>";
				text += "<th>Hora</th>";
				text += "<th>Estatus</th>";
			 if(data[0].inmob!=""){
				text += "<th>Mobiliario Disponible</th>";
				}
			 
                text += "</thead>";
                text += "<tbody>";
			 for (x of data) {
				text += "<tr>";
                text += "<td>"+x.start+"</td>";
                text += "<td>"+x.res_time_start+" a "+x.res_time_end+"</td>";
                text += "<td><span class='badge badge-"+x.status+"'>"+x.textStatus+"</span></td>";
				 
				 if(x.inmob!=""){
                text += "<td>"
					for (i of x.inmob){
						text += i.name+": "+i.number+"<br>";
					}

				text +="</td>";
					}
                text += "</tr>";
			 		}
                text += "</tbody>";
                text += "</table>";
                text += "</div>";
                text += "</row>";
                $(".modal-body").empty().html(text);
            });
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});

        $("#waiting").hide();
	}
	
	function reservar(){
		
        $('#view_reserva').modal('hide');
		  var SITEURL = "{{ url('/') }}";
        Swal.fire({	
       title: "¡Aviso!",
       text: "¿Estás seguro de reservar solo los espacios disponibles?",
       type: "warning",
       confirmButtonText: 'Reservar',
       cancelButtonText: 'Cancelar',
	   showCancelButton: true,
       confirmButtonColor: '#ff5900',
       cancelButtonColor: 'rgb(235, 211, 0)',
        }).then((result) => {
            console.log(result.value);
            if (result.value == true) {
				var f = $(this);
     var formData = new FormData(document.getElementById("formuploadajax"));
         $.ajax({
       url:SITEURL+"/reserva-espacios/reserva/crear",
       type: "POST",
       dataType: "json",
       data: formData,
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(data) {
			 
            console.log(data);
			 json = jQuery.parseJSON(JSON.stringify(data));
         Swal.fire({
           title: json.title,
           text: json.text,
           type: json.type,
			  confirmButtonText: 'Entendido',
           timer: 15000
         }).then(function(){
						window.location.replace(SITEURL+"/reserva-espacios/reserva/crear");
						});
			 
		 })
            }else{
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});
			}
        })
	}
	
	function actualizar(){
		
		  var SITEURL = "{{ url('/') }}";
        Swal.fire({	
       title: "¡Aviso!",
       text: "¿Estás seguro de actualizar la reserva?",
       type: "warning",
       confirmButtonText: 'Actualizar',
       cancelButtonText: 'Cancelar',
	   showCancelButton: true,
       confirmButtonColor: '#ff5900',
       cancelButtonColor: 'rgb(235, 211, 0)',
        }).then((result) => {
            console.log(result.value);
            if (result.value == true) {
				var f = $(this);
     var formData = new FormData(document.getElementById("formuploadajax"));
         $.ajax({
       url:SITEURL+"/reserva-espacios/reserva/editar",
       type: "POST",
       dataType: "json",
       data: formData,
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(data) {
			 
            console.log(data);
			 json = jQuery.parseJSON(JSON.stringify(data));
         Swal.fire({
           title: json.title,
           text: json.text,
           type: json.type,
			  confirmButtonText: 'Entendido',
           timer: 15000
         }).then(function(){
		window.location.replace(SITEURL+"/reserva-espacios/reserva/crear");
						});
			 
		 })
            }
        })
	}
	
	 /////////////FIN VALIDACIÓN DE FORMULARIO//////////////////
	</script> 
@endsection 