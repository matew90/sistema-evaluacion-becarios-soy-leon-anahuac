@extends('layout.main')
@section('title')
Reserva de espacios
@endsection
<link rel="stylesheet" href="../../public/plugins/fullcalendar/css/fullcalendar.min.css" />
<link href="../../public/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link href="../../public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
<!-- Plugins css -->

<style>
#adminCat {
	 border-spacing: 10px 20px;
	text-align: center;
	margin-top: 20px;
}
	#adminCat tbody tr:nth-child(even){
  background: #EEEEEE;
}
</style>
@section('content')
<div class="container-fluid">
  <!--end row-->
  <div class="row mb-4">
    <div class="col-xl-4">
      <div class="card" id="viewSpaces" style="    height: 900px;overflow-y: auto;">
        <div class="card-body">
          <div class="d-grid">
            <button class="btn btn-outline-primary btn-round waves-effect waves-light" id="btn-new-event" onClick="display(1);"><i class="mdi mdi-plus-circle-outline"></i> Nueva Reserva</button>
          </div>
          <div id="external-events"> <br>
            <h4 class="header-title mt-0 mb-3">Espacios Anáhuac</h4>
            @if (isset($spaces))
            @foreach ($spaces as $key => $value)
            <div class="external-event fc-event" style="background-color: {{$value['spa_color']}};"> <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i> {{$value['spa_name']}} </div>
            @endforeach
            @endif


						<table class="w-100" style="font-size:16px">
							<thead style="background: #ff5900; color: #fff">
								<td class="w-50 p-2">Espacio</td>
								<td class="w-25 p-2">Inicio</td>
								<td class="w-25 p-2">Fin</td>
							</thead>
							<tbody>
								<tr>
									<td class="w-50 p-2"><i class="mdi mdi-checkbox-blank-circle font-size-11 me-2" style="color: #52F2B8"></i> Aula Magna A</td>
									<td class="w-25 p-2">07:00</td>
									<td class="w-25 p-2">10:00</td>
								</tr>
								<tr style="background: #ededed">
									<td class="w-50 p-2"><i class="mdi mdi-checkbox-blank-circle font-size-11 me-2" style="color: #FDAFCC"></i> Aula Magna A</td>
									<td class="w-25 p-2">07:00</td>
									<td class="w-25 p-2">10:00</td>
								</tr>
							</tbody>
						</table>c
					</div>
          <!--<div class="mt-5">
                <h5 class="font-size-14 mb-4">Recent activity :</h5>
                <ul class="list-unstyled activity-feed ms-1">
                  <li class="feed-item">
                    <div class="feed-item-list">
                      <div>
                        <div class="date">15 Jul</div>
                        <p class="activity-text mb-0">Responded to need “Volunteer Activities”</p>
                      </div>
                    </div>
                  </li>
                  <li class="feed-item">
                    <div class="feed-item-list">
                      <div>
                        <div class="date">14 Jul</div>
                        <p class="activity-text mb-0">neque porro quisquam est <a href="javascript:void(0);" class="text-success">@Christi</a> dolorem ipsum quia dolor sit amet</p>
                      </div>
                    </div>
                  </li>
                  <li class="feed-item">
                    <div class="feed-item-list">
                      <div>
                        <div class="date">14 Jul</div>
                        <p class="activity-text mb-0">Sed ut perspiciatis unde omnis iste natus error sit “Volunteer Activities”</p>
                      </div>
                    </div>
                  </li>
                  <li class="feed-item">
                    <div class="feed-item-list">
                      <div>
                        <div class="date">13 Jul</div>
                        <p class="activity-text mb-0">Responded to need “Volunteer Activities”</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>-->
        </div>
      </div>
      <!-- CREAR RESERVA-->
      <div class="card" id="newReservation" style="display: none">
        <div class="card-body">
          <div class="d-grid">
            <button class="btn btn-outline-primary btn-round waves-effect waves-light" id="btn-new-event" onClick="display(2);"><i class="mdi mdi-plus-circle-outline"></i> Ver Espacios Anáhuac</button>
          </div>
          <form id="formuploadajax">
            <div id="secction1">
              <div id="external-events"> <br>
                <h4 class="header-title mt-0 mb-3">Reservar Espacio</h4>
                <p class="text-muted mb-4">Los campos marcados con <span class="r-red">*</span> son obligatorios.</p>
              </div>
              <div class="form-group">
                <label for="name">Nombre del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fab fa-elementor"></i></button>
                  </span>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del evento">
                </div>
              </div>
              <div class="form-group">
                <label for="place">Lugar del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                  </span>
                  <select id="place" name="place" class=" form-control" onchange="tableArrangement()">
                    <option value="">Selecciona una opción</option>

					  @if (isset($spaces))
            @foreach ($spaces as $key => $value)

                    <option value="{{$value['spa_uID']}}">{{$value['spa_name']}}</option>

            @endforeach
            @endif

                  </select>
                </div>
              </div>

              <div class="form-group" id="tableArrangement" style="display: none;">
                <label for="place">Modalidades de mesas <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i></button>
                  </span>
                  <select id="place" name="place" class=" form-control">
                    <option value="">Selecciona una opción</option>
                    <option value="1">Conferencia</option>
                    <option value="2">Herradura</option>
                    <option value="3">Salón de clases</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="dateStart">Fecha inicio del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="far fa-calendar-alt"></i></button>
                  </span> @php
                  $mindate = date("Y-m-d");
                  @endphp
                  <input type="text" id="dateStart" name="dateStart"  placeholder="dd / mm / aaaa"  class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label for="timeStart">Hora inicio del evento <span class="r-red">*</span></label>
                <div class="input-group"> 
                  <span class="input-group-prepend">
                    <button type="button" class="btn btn-primary"><i class="fas fa-clock"></i></button>
                  </span>
                  <input type="time" id="timeStart" name="timeStart" min="07:00" max="22:00" step="3600" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label for="dateEnd">Fecha fin del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="far fa-calendar-alt"></i></button>
                  </span>
                  <input type="text" id="dateEnd" name="dateEnd" placeholder="dd / mm / aaaa" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label for="timeEnd">Hora fin del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-clock"></i></button>
                  </span>
                  <input type="time" id="timeEnd" name="timeEnd" min="07:00" max="22:00" step="3600" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <label for="number">Número de personas esperadas <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-users"></i></button>
                  </span>
                  <input type="number" id="number" name="number" class="form-control" placeholder="Número de personas esperadas">
                </div>
              </div>
              <div class="form-group">
                <label for="description">Descripción del evento <span class="r-red">*</span></label>
                <div class="input-group"> <span class="input-group-prepend">
                  <button type="button" class="btn btn-primary"><i class="fas fa-audio-description"></i></button>
                  </span>
                  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <labemor="inmobiliario">¿Quieres solicitar mobiliario? <span class="r-red">*</span></label>
                <div class="col-md-9">
                  <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio7" name="inmobiliario" value="1" class="custom-control-input">
                      <label class="custom-control-label" for="customRadio7">Si</label>
                    </div>
                  </div>
                  <div class="form-check-inline my-1">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="customRadio8" name="inmobiliario" value="2" class="custom-control-input">
                      <label class="custom-control-label" for="customRadio8">No</label>
                    </div>
                  </div>
                </div>

            <div class="row">
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-outline-primary btn-round waves-effect waves-light" id="validate">Continuar <i class="mdi mdi-arrow-right mr-2"></i></button>
              </div>
            </div>
              </div>
              <!-- <div class="form-group">
              <label for="manager">Responsable del evento <span class="r-red">*</span></label>
              <div class="input-group"> <span class="input-group-prepend">
                <button type="button" class="btn btn-primary"><i class="fas fa-user"></i></button>
                </span>
                <input type="text" id="manager" name="manager" readonly class="form-control" placeholder="Encargado del evento" value="{{ Crypt::decryptString(auth()->user()->name)}}">
              </div>
            </div>
            <div class="form-group">
              <label for="email">Correo de contacto <span class="r-red">*</span></label>
              <div class="input-group"> <span class="input-group-prepend">
                <button type="button" class="btn btn-primary"><i class="fas fa-envelope"></i></button>
                </span>
                <input type="text" id="email" name="email" readonly class="form-control" placeholder="example@anahuac.mx" value="{{ base64_decode(auth()->user()->email) }}">
              </div>
            </div>
            <div class="form-group">
              <label for="area">Área encargada del evento <span class="r-red">*</span></label>
              <div class="input-group"> <span class="input-group-prepend">
                <button type="button" class="btn btn-primary"><i class="fas fa-book-reader"></i></button>
                </span>
                <input type="text" id="area" readonly name="area" class="form-control" placeholder="Área encargada del evento" value="{{ auth()->user()->area->ar_name }}">
              </div>
            </div>-->
              <input type="hidden" id="us_uID" name="us_uID"value="{{ auth()->user()->us_uID }}">
            </div>
            <div id="secction2" style="display: none;">
              <div id="external-events"> <br>
   		       <h4 class="header-title mt-0 mb-3">Mobiliario</h4>
              </div>
				@if (isset($inventories))
            @foreach ($inventories as $keyInv => $valueInv)
              <div class="form-group">
                <label for="inmob">{{$valueInv['inv_name']}}</label>
                <input class="form-control" type="text" value="0" name="inmob[{{$valueInv['inv_uID']}}][]" max="{{$valueInv['inv_number']}}" id="example-number-input">
              </div>
				@endforeach
            @endif


            <div class="row">
              <div class="col-xl-4 text-left">
				  <button type="button" class="btn btn-outline-primary btn-round waves-effect waves-light" onClick="returnForm();"><i class="mdi mdi-arrow-left mr-2"></i>Regresar</button>
              </div>
				<div class="col-xl-2 text-left"> </div>
				<div class="col-xl-4 text-right">
               <button type="button" class="btn btn-outline-primary btn-round waves-effect waves-light" onClick="sendForm();">Continuar <i class="mdi mdi-arrow-right mr-2"></i></button>
              </div>
            </div>
            </div>
          </form>
        </div>
        <!--end card-body-->
      </div>
      <!-- FIN CREAR RESERVA-->
    </div>
    <!-- end col-->
    <!--modal -->
    <div class="modal fade bs-example-modal-center" id="view_details" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="exampleModalLabel" style="color: white;">Previsualización de reservas</h5>
            <span></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body"> </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary waves-effect waves-light">Reservar espacios disponibles</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

	  <!--modal -->
    <div class="modal fade bs-example-modal-center" id="view_reserva" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <span></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body"> </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="col-xl-8">
      <div class="card mt-4 mt-xl-0 mb-0">
        <div class="card-body">
          <div id="calendar" style="" class="fc fc-ltr fc-bootstrap"> </div>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!--end row-->
</div>
<!-- container -->
@endsection


@section('footer')

<!-- Calendar init -->

<script src="{{ url('/public/plugins/fullcalendar/js/moment.min.js') }}"></script>
<script src="{{ url('/public/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
<script src="{{ url('/public/plugins/fullcalendar/js/fullcalendar-es.js') }}"></script>
<!-- Sweet-Alert  -->
<script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ url('/public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>



<!-- Plugins js -->
<script>

  $(document).ready(function() {

	  var SITEURL = "{{ url('/') }}";
	  $.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
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

	  /////////////JS CALENDAR//////////////////
	   var calendar =  $('#calendar').fullCalendar({
		eventLimit: true,
		 views: {
			 month: {
			   eventLimit: 5
			 }
		 },
		slotEventOverlap: false,
		 hiddenDays: [ 0 ],
		//defaultView: 'agendaWeek',
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:SITEURL+'/reserva-espacios/reserva/mostrar',
        selectable:true,
        selectHelper: true,
        /*eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
*/
       eventClick:function(event)
        {
			var spa_uID = event.spa_uID;
			 $.ajax({
       url:SITEURL+'/reserva-espacios/reserva/mostrar/'+ spa_uID,
                    type:"GET",
                    data:{
                        spa_uID:spa_uID
                    },
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(result) {
				 alert(result);
				/* for (x of result){
				 }
			var text = "";
   				text += "<row>";
                text += "<div class='col-12'>";
                text += ' <div class="text-center">';
                text += '<h5>'+result.title+'</h5>';
                text += '<p class="mb-0 text-muted"><i class="fas fa-map-marker-alt mr-2" style="color: '+x.color+'"></i>'+x.place+'</p>';
                text += '<p class="mb-0 text-muted"><i class="fas fa-clock mr-2" style="color: '+x.color+'"></i>'+x.time+'</p>';
                text += '<p class="mb-0 text-muted"><i class="fas fa-user mr-2" style="color: '+x.color+'"></i>'+x.user+'</p>';
                text += '<p class="mb-0 text-muted"><i class="fas fa-book-reader mr-2" style="color: '+x.color+'"></i>'+x.area+'</p>';
                text += '</div>';
                text += '</div>';

				 if(x.options==1){
                text += '<div class="card-body pb-0 px-0">';
                text += '<div class="row text-center border-top m-0">';
                text += '<div class="col-6 border-right border-left p-3 bg-light">';
                text += '<a href="#">';
                text += '<i class="fas fa-user-plus text-primary font-20"></i> ';
                text += '</a>          ';
                text += '</div>';
                text += '<div class="col-6 border-right  border-left p-3 bg-light">';
                text += ' <a href="#">';
                text += '<i class="fas fa-comment-alt text-info font-20"></i>';
                text += '</a>';
                text += ' </div>';
                text += '</div>';
                text += '</div>';
			 }
                text += "</row>";
                $(".modal-body").empty().html(text);*/
            });
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});
        }

    });
	  /////////////FIN JS CALENDAR//////////////////

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
	 /////////////FIN JS CALENDAR//////////////////

	 /////////////VALIDACIÓN DE FORMULARIO//////////////////
	 $("#validate").click(function() {
    var name = $("#name").val();
    var place = $("#place").val();
    var dateStart = $("#dateStart").val();
    var timeStart = $("#timeStart").val();
    var dateEnd = $("#dateEnd").val();
    var timeEnd = $("#timeEnd").val();
    var number = $("#number").val();
    var description = $("#description").val();
    var us_uID = $("#us_uID").val();
    var inmobiliario = $("input[name=inmobiliario]:checked").val();
	const dateH = new Date();
	var day = (dateH.getDate()+ 2).toString().padStart(2, "0");
	var month = (dateH.getMonth() + 1).toString().padStart(2, "0");
	var year = dateH.getFullYear();
	var today= year+ "-" + month + "-" + day;
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

		 //--------- FORMULARIO DE INMOBILIARIO ---------//
		if(inmobiliario==1){
		   document.getElementById("secction1").style.display='none';
		  document.getElementById("secction2").style.display='block';
		   }else{
		   sendForm();
		   }
   }
	 });

	//////////////REGRESAR FORM/////////////////
	function returnForm(){
		   document.getElementById("secction1").style.display='block';
		  document.getElementById("secction2").style.display='none';
	}


		function sendForm(){
		 $("#waiting").show();
	  var SITEURL = "{{ url('/') }}";
			var name = $("#name").val();
    var place = $("#place").val();
    var dateStart = $("#dateStart").val();
    var timeStart = $("#timeStart").val();
    var dateEnd = $("#dateEnd").val();
    var timeEnd = $("#timeEnd").val();
    var number = $("#number").val();
    var description = $("#description").val();
    var us_uID = $("#us_uID").val();
    var inmob = $("#inmob").val();
    var inmobiliario = $("input[name=inmobiliario]:checked").val();
		 var f = $(this);
     var formData = new FormData(document.getElementById("formuploadajax"));
     formData.append("name", name);
     formData.append("place", place);
     formData.append("dateStart", dateStart);
     formData.append("timeStart", timeStart);
     formData.append("dateEnd", dateEnd);
     formData.append("timeEnd", timeEnd);
     formData.append("number", number);
     formData.append("description", description);
     formData.append("us_uID", us_uID);
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
				text += "<th>Mobiliario Disponible</th>";
                text += "</thead>";
                text += "<tbody>";
			 for (x of data) {
				text += "<tr>";
                text += "<td>"+x.start+"</td>";
                text += "<td>"+x.res_time_start+" a "+x.res_time_end+"</td>";
                text += "<td><span class='badge badge-"+x.status+"'>"+x.textStatus+"</span></td>";
                text += "<td>"
					for (i of x.inmob){
						text += i.name+": "+i.number+"<br>";
					}

				"</td>";
                text += "</tr>";
			 		}
                text += "</tbody>";
                text += "</table>";
                text += "</div>";
                text += "</row>";
                $(".modal-body").empty().html(text);
            });
        $('#view_details').modal({backdrop: 'static', keyboard: false});

        $("#waiting").hide();

  /* $("#waiting").show();

     $.ajax({
       url:SITEURL+"/store-reserva-espacios",
       type: "POST",
       dataType: "json",
       data: formData,
       cache: false,
       contentType: false,
       processData: false
     })
     .done(function(res) {
       $("#waiting").hide();

       json = jQuery.parseJSON(JSON.stringify(res));

		   Swal.fire({
  		   title: json.title,
           text: json.text,
           type: json.type,
		   showConfirmButton: "true",
		   confirmButtonText: 'Entendido',
			}).then(function(){
				//window.location="{{url('/reserva-espacios')}}";
			})

     });

		 */
	}
	 /////////////FIN VALIDACIÓN DE FORMULARIO//////////////////

	</script>
@endsection
