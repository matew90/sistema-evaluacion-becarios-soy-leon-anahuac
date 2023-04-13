<nav class="navbar navbar-expand-lg m-0 p-0 w-100 ">

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <!-- <ul class="nav nav-tabs m-auto" > -->
    <ul class="nav nav-tabs " >
      <li class="nav-item">
        <a  class="nav-link" data-toggle="modal" data-target=".bd-example-modal-xl"><i class=" typcn typcn-th-small-outline "></i>Menú</a>
      </li>
      @if(isset($info))
        @if($info['act_submenu_route'] != "Inicio")
          @foreach($info['submenus_list'] as $key => $value)
            <li class="nav-item dropdown ">
                  <a   class="nav-link {{ $info['act_submenu_route']==$value[0]['route_name'] ? 'active' : '' }} {{ (count($value)==1)?'':'dropdown-toggle' }}"href="{{ route($value[0]['route_name']) }}" role="button" aria-haspopup="true" aria-expanded="false"  data-toggle="{{ (count($value)==1)?'':'dropdown' }}" >
                      <i class="icon  {{ $value[0]['icon'] }} "></i>
                       {{ $value[0]['name'] }}
                  </a>
                  @if(isset($value['values']))
                  <div class="dropdown-menu">
                    <a  class="dropdown-item" href="{{ route($value[0]['route_name']) }}">{{ $value[0]['name'] }}</a>
                    @foreach($value['values'] as $key2 => $value2)
                    <a  class="dropdown-item" href="{{ route($value2['route_name']) }}">{{ $value2['name'] }}</a>
                    @endforeach

                  </div>

                  @endif

            </li>
          @endforeach
        @endif
      @endif
    </ul>
  </div>
</nav>

  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <!-- <div class="modal fade bd-example-modal-xl show" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: block;" aria-modal="true"> -->
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-body ml-1">
                @if(isset($info))
                  @foreach ($info['submenu'] as $key => $sub)
                    <div class="row mt-3 mb-2">
                      <h1 class="col-12 header-title mb-2">{{ $sub[0]->menu->men_name }}<br></h1>
                        @foreach($sub as $key2 => $value_sub)
                        <a href="{{ route($value_sub->sub_route) }}" class="col-lg-2 col-md-3 col-sm-4 col-xs-6 d-flex mb-2 div-menu-modal pl-0">
                            <i class="icon-main-div  {{ $value_sub->sub_icon }}  p-3 rounded"></i>
                            <p class="menu-modal-title mt-auto mb-auto ml-2 mr-0">{{ $value_sub->sub_name }}</p>
                        </a>
                        @endforeach
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
  </div>
