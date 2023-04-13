@extends('layout.main')
@section('title')
  UAQ | Reserva de espacios
@endsection
<link rel="stylesheet" href="./public/css/fullcalendar.min" />
@section('content') 
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body new-user order-list">
              <h4 class="header-title mt-0 mb-3">Calendario Mensual</h4>
            </div>
            <!--end card-body--> 
          </div>
          <!--end card--> 
        </div>
        <!--end col--> 
      </div>
      <!--end row-->
      <div class="row mb-4">
        <div class="col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-grid">
                <button class="btn btn-primary" id="btn-new-event"><i class="mdi mdi-plus-circle-outline"></i> Create New
                Event</button>
              </div>
              <div id="external-events"> <br>
				  <h4 class="header-title mt-0 mb-3">Espacios Anáhuac</h4>
				  @if (isset($spaces))
        				@foreach ($spaces as $key => $value)
				  <div class="external-event fc-event" style="background-color: {{$value['spa_color']}};"> <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i> {{$value['spa_name']}} </div>
				   		@endforeach
     				 @endif
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
        </div>
        <!-- end col-->
        
        <div class="col-xl-9">
          <div class="card mt-4 mt-xl-0 mb-0">
            <div class="card-body">
              <div id="calendar" style="" class="fc fc-ltr fc-bootstrap">
				  
              </div>
            </div>
          </div>
        </div>
        <!-- end col --> 
        
      </div>
    </div>
    <!-- container -->
@endsection


@section('footer')

<!-- Calendar init --> 

<script src="./public/js/moment.min.js"></script> 
<script src="./public/js/fullcalendar.min.js"></script> 
<script src="./public/js/fullcalendar-es.js"></script> 
<script>
		
  $(document).ready(function() {
	  var SITEURL = "{{ url('/') }}";
	  $.ajaxSetup({
		  headers:{
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
	  });
		  
	   var calendar =  $('#calendar').fullCalendar({
		 eventLimit: true,
		 views: {
			 month: {
			   eventLimit: 5
			 }
		 },
		slotEventOverlap: false,
		//defaultView: 'agendaWeek',
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:SITEURL +'/reserva-espacios',
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

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }*/
    });

});
	</script>
@endsection 