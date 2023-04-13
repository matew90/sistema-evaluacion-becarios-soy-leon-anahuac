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
  background: #ededed;
}
	#reservTable tbody tr:nth-child(even){
  background: #ededed;	
}
	.fc-title{
			color: white !important;
		}
</style>
@section('content')
<div class="container-fluid"> 
  <!--end row-->
  <div class="row mb-4">
    <div class="col-xl-4">
      <div class="card" id="viewSpaces" style=" height: 900px;overflow-y: auto;">
        <div class="card-body">
          <div class="d-grid">
          </div>
          <div id="external-events"> <br>
			  <h4 class="header-title mt-0 mb-3">Selecciona un día para visualizar las reservas</h4>
            <table class="w-100" style="font-size:16px; display:none" id="reservTable">
              <thead style="background: #ff5900; color: #fff">
              <td class="w-50 p-2">Espacio</td>
                <td class="w-50 p-2">Evento</td>
                <td class="w-25 p-2">Inicio</td>
                <td class="w-25 p-2">Fin</td>
                  </thead>
              <tbody id="table-body">
              </tbody>
            </table>
          </div>
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
                <div class="input-group"> <span class="input-group-prepend">
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
                <labemor for="inmobiliario">
                ¿Quieres solicitar mobiliario? <span class="r-red">*</span>
                </label>
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
          <div class="modal-header"> <span></span>
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
		defaultView: 'month',
        editable:true,
       /* header:{
            left:'prev,next today',
            center:'title',
            //right:'month,agendaWeek,agendaDay'
        },*/
        events:SITEURL+'/reserva-espacios/mensual/',
        selectable:true,
        selectHelper: false,
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
			
			var today = event.start;
			const dateH = new Date(today);
	var day = (dateH.getDate()+ 1).toString().padStart(2, "0");
	var month = (dateH.getMonth() + 1).toString().padStart(2, "0");
	var year = dateH.getFullYear();
	var start= year+ "-" + month + "-" + day;
			 $.ajax({
       url:SITEURL+'/reserva-espacios/mensual/mensual/'+ start
     })
            .done(function(result) {
				 
				 document.getElementById('reservTable').style.display="block";
				 let tableBody = document.getElementById('table-body');
				 tableBody.innerHTML='';
				for (let i = 0; i < result.length; i++) {
    // Creando los 'td' que almacenará cada parte de la información del usuario actual
					
    let name = `<td class="w-55 p-2"><i class="mdi mdi-checkbox-blank-circle font-size-11 me-2" style="color:${result[i].color}"></i> ${result[i].place}</td>`;
    let lastName = `<td class="w-20 p-2">${result[i].title}</td>`;
    let age = `<td class="w-20 p-2">${result[i].timeStart}</td>`;
    let country = `<td class="w-20 p-2">${result[i].timeEnd}</td>`;

    tableBody.innerHTML += `<tr>${name + lastName + age + country}</tr>`;
} 
            });
        }

    });
	  /////////////FIN JS CALENDAR//////////////////

});

	</script> 
@endsection 