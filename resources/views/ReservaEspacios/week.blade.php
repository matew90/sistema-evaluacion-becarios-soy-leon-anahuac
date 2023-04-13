@extends('layout.main')
@section('title')
Reserva de espacios
@endsection
<link rel="stylesheet" href="{{ url('/public/plugins/fullcalendar/css/fullcalendar.min.css')}}" />
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
<link href="{{ url('/public/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
	.fc-title{
			color: white !important;
		}.cuadrado-3 {
		display: block;
     width: 15px; 
     height: 15px; 
	border-radius: 20px;
}
	.flexContainer {
  display:flex;
  align-items:center;
}

.customSpan {
  margin:0 0 4px 4px;  
}
.customIcon {
  font-size:20px;
}.fc-time-grid-event .fc-time {
  display: none;
}
</style>
@section('content')
<div class="container-fluid"> 
  <!--end row-->
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
           <div class="row">
            <div class="col-md-3">
              <h6 class="mt-lg-0 input-title">Espacios Anáhuac</h6>
              <select class="select2 mb-3 select2-multiple select2-hidden-accessible" style="width: 100%" multiple="" data-placeholder="Espacios Anáhuac" tabindex="-1" aria-hidden="true" id="space_selector" name="event_filter_select">
                
                
				   @if (isset($spaces))
            @foreach ($spaces as $key => $value)
				   
                
                <option id="{{$value['spa_uID']}}" class="event_filter_box" data-type="address_city" value="{{$value['spa_uID']}}">{{$value['spa_name']}} </option>
                
                
            @endforeach
            @endif
				  
                
                <option></option>
              </select>
            </div>
            <div class="col-md-3">
              <h6 class="mt-lg-0 input-title">Creado por</h6>
              <select class="select2 mb-3 select2-multiple select2-hidden-accessible" style="width: 100%" multiple="" data-placeholder="Nombre" tabindex="-1" aria-hidden="true" id="users_selector" name="event_filter_select2">
                
                
				   @if (isset($users))
            @foreach ($users as $keyUsers => $valueUsers)
				   
                
                <option id="{{$valueUsers['us_uID']}}" class="event_filter_box2"  data-type="users" value="{{$valueUsers['us_uID']}}">{{Crypt::decryptString($valueUsers['name'])}} </option>
                
                
            @endforeach
            @endif
				  
                
                <option></option>
              </select>
            </div>
            <div class="col-md-3">
              <h6 class="mt-lg-0 input-title">Área</h6>
              <select class="select2 mb-3 select2-multiple select2-hidden-accessible" multiple="" style="width: 100%" data-placeholder="Áreas" tabindex="-1" aria-hidden="true" id="areas_selector" name="event_filter_select3">
                
                
				   @if (isset($areas))
            @foreach ($areas as $keyAreas => $valueAreas)
				   
                
                <option id="{{$valueAreas['ar_uID']}}" class="event_filter_box" data-type="areas" value="{{$valueAreas['ar_uID']}}">{{$valueAreas['ar_name']}} </option>
                
                
            @endforeach
            @endif
				  
                
                <option></option>
              </select>
            </div>
          </div>
       
    </div>
 
    <div class="col-xl-12">
	  <div id="calendar" style="" class="fc fc-ltr fc-bootstrap"> </div>
    </div>
		   </div>
      </div>
  </div>
  <!-- end col--> 
  
  <!--modal -->
  <div class="modal fade bs-example-modal-center" id="view_reserva" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header" style="display: block;">
		  <div class="modal-title" style="float: right;"></div> <span></span>
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>-->
        </div>
        <div class="modal-body"> </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal --> 
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
<script src="{{ url('/public/plugins/select2/select2.min.js') }}"></script> 
<!-- Plugins js --> 
<script>

  $(document).ready(function() {
	  var foption = $('#users_selector option:first');
    var soptions = $('#users_selector option:not(:first)').sort(function (a, b) {
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    });
    $('#users_selector').html(soptions).prepend(foption);
	    //ordenarSelect('users_selector');
 $(".select2").select2({
         width: '100%'
     });
	  var SITEURL = "{{ url('/') }}";
	  $.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	  });
	 
	   
	 $('#space_selector').on('change',function() {
   $('#calendar').fullCalendar('rerenderEvents');
  });
	  $('#users_selector').on('change',function() {
   $('#calendar').fullCalendar('rerenderEvents');
  });$('#areas_selector').on('change',function() {
   $('#calendar').fullCalendar('rerenderEvents');
  });

	  /////////////JS CALENDAR//////////////////
	  
	 var calendar =  $('#calendar').fullCalendar({
		aspectRatio: 2,
			minTime: "08:00",
			maxTime: "23:00",
		eventLimit: true,
		 views: {
			 month: {
			   eventLimit: 5
			 }
		 },
		slotEventOverlap: false,
		 hiddenDays: [ 0 ],
		defaultView: 'agendaWeek',
        editable:true,
       /* header:{
            left:'prev,next today',
            center:'title',
            //right:'month,agendaWeek,agendaDay'
        },*/
      events:SITEURL+'/reserva-espacios/semanal',
      eventRender: function eventRender( event, element, view ) {
      var display = true;
      var addresses = [];
      var users = [];
      var areas = [];
      // Find all checkbox that are event filters that are enabled
      // and save the values.
      $("select[name='event_filter_select'] option:selected").each(function () {
          // I specified data-type attribute in above HTML to differentiate
          // between locations and kinds of events.

          // Saving each type separately
          if ($(this).data('type') == 'address_city') {
              addresses.push($(this).val());
          }
      });
		  $("select[name='event_filter_select2'] option:selected").each(function () {
          // I specified data-type attribute in above HTML to differentiate
          // between locations and kinds of events.

          // Saving each type separately
          if ($(this).data('type') == 'users') {
              users.push($(this).val());
          }
      });
		  $("select[name='event_filter_select3'] option:selected").each(function () {
          // I specified data-type attribute in above HTML to differentiate
          // between locations and kinds of events.

          // Saving each type separately
          if ($(this).data('type') == 'areas') {
              areas.push($(this).val());
          }
      });

      // If there are locations to check
      if (addresses.length) {
          display = display && addresses.indexOf(event.spa_uID) >= 0;
      } // If there are locations to check
      if (users.length) {
          display = display && users.indexOf(event.us_uID) >= 0;
      }// If there are locations to check
      if (areas.length) {
          display = display && areas.indexOf(event.ar_uID) >= 0;
      }
      return display;
  },
        selectable:true,
        selectHelper: false,
       eventClick:function(event)
        {
			var res_uID = event.res_uID;
			 $.ajax({
       url:SITEURL+'/reserva-espacios/semanal/semanal/'+ res_uID,
                    type:"GET",
                    data:{
                        res_uID:res_uID
                    },
       cache: false,
       contentType: false,
       processData: false
     })
            .done(function(result) {
				 
		  var SITEURL = "{{ url('/') }}";
				for (x of result){
				 }
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
			
			
			 text += '<div class="row">';
                text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Fecha</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.start+'">';
             text += ' </div>';
           text += ' </div>'; 
			text += '<div class="col-md-6">';
              text += '<div class="form-group">';
               text += ' <label for="name">Horario</label>';
                text += '  <input type="text"  class="form-control" readonly value="'+x.time+'">';
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
                text += "</row>";
			
				/*  var text = "";	 
        text += ' <div class="row">';
          text += ' <div class="col-lg-10">';
            text += ' <div class="flexContainer">';
             text += '  <div> <span class="cuadrado-3 customIcon" style="background:'+x.color+'"></span> </div>';
             text += '  <div class="customSpan">';
             text += '    <h4 class="mt-0"><b>'+x.title+'</b></h4>';
             text += '    <p>'+x.place+'</p>';
            text += '   </div>';
          text += '   </div>';
         text += '  </div>';
        text += ' </div>';
        text += ' <div class="row">';
         text += '  <div class="col-lg-6">';
          text += '   <div class="flexContainer">';
              text += ' <div> <span class="fas fa-map-marker-alt customIcon" style="color:'+x.color+'"></span> </div>';
              text += ' <div class="customSpan">';
               text += '  <h4 class="mt-0">'+x.dia+' </h4>';
               text += '  <p>'+x.time+'</p>';
              text += ' </div>';
            text += ' </div>';
          text += ' </div>';
           text += '<div class="col-lg-6">';
             text += '<div class="flexContainer">';
              text += ' <div> <span class="mdi mdi-calendar-check-outline customIcon" style="color:'+x.color+'"></span> </div>';
              text += ' <div class="customSpan">';
              text += '   <p class="mt-0"><b>Creado por: </b>'+x.user+'</p>';
               text += '  <p><b>Área: </b>'+x.area+'</p>';
             text += '  </div>';
            text += ' </div>';
          text += ' </div>';
        text += ' </div>';
                text += "</row>";*/
				 var titleH="";
				 if(x.options==1){
				 titleH+='<a class="btn btn-sm" style="background:#ff5900" href="'+SITEURL+'/reserva-espacios/semanal/editar/'+x.res_uID+'"><i class="far fa-edit text-white"></i></a> &nbsp; <a class="btn btn-sm" style="background:#ff5900" id="'+x.res_uID+'" name="'+x.start+'" onClick="delete_reserva(id,name);"><i class="far fa-trash-alt text-white"></i></a>';
					}
				 $(".modal-title").empty().html(titleH);
                $(".modal-body").empty().html(text);
            });
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});
        }, 
		  
    });
	
	  /////////////FIN JS CALENDAR//////////////////
});
	
	function delete_reserva(res_uID,start) {
		 $('#view_reserva').modal('hide');
		  var SITEURL = "{{ url('/') }}";
        Swal.fire({	
       title: "¿Estás seguro de cancelar la reservación?",
       type: "warning",
       confirmButtonText: 'Si, cancelar',
			 cancelButtonText: 'Cerrar',
	   showCancelButton: true,
       confirmButtonColor: '#ff5900',
       cancelButtonColor: 'rgb(191, 0, 0)',
        }).then((result) => {
            console.log(result.value);
            $("#waiting").show();
            if (result.value == true) {
				const dateH = new Date();
	var day = (dateH.getDate()+ 1).toString().padStart(2, "0");
	var month = (dateH.getMonth() + 1).toString().padStart(2, "0");
	var year = dateH.getFullYear();
	var today= year+ "-" + month + "-" + day;
				if(today<start){
				  $.post(SITEURL+"/reserva-espacios/semanal/eliminar/" + res_uID)
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
						window.location.replace(SITEURL+"/reserva-espacios/semanal");
						})
                });
				   }else{
				   Swal.fire({
                        title: "¡Aviso!",
                        text: "Para cancelar una reservación tiene que ser con dos días de anticipación",
                        type: 'warning',
                        confirmButtonText: 'Entendido',
  						showConfirmButton: "true"
                   })
				
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});
				   }
				
            }else{
        $('#view_reserva').modal({backdrop: 'static', keyboard: false});
			}
        })
    }
	function edit_reserva(res_uID) {
		  var SITEURL = "{{ url('/') }}";
				  $.post(SITEURL+"/reserva-espacios/semanal/editar/" + res_uID)
    }
	</script> 
@endsection 