@extends('layout.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <form  action="{{ route('admin.role.store') }}" method="post">  @csrf
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre de los usuarios asignados <span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <select class="us_name w-100" name="us_uID[]" multiple="multiple">
                  @foreach ($getUsers as $key => $value)
                    <option value="{{ $value->us_uID }}">{{ Crypt::decryptString($value->name) }} - {{ $value->area->ar_name }}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre del rol <span class="text-danger">*</span></label>
              <div class="col-sm-10">
                  <input class="form-control" type="text" name="rol_name" required>
              </div>
          </div>
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">First Submenu <span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <select class="form-control" name="first_submenu_id">
                @foreach ($na as $menKey => $submenus)
                  @foreach ($submenus as $key => $value)
                    @for ($i=0; $i < count($value); $i++)
                        <option value="{{$value[$i]->sub_uID}}">{{ $value[$i]->sub_name }}</option>
                    @endfor
                  @endforeach
                 @endforeach
               </select>
              </div>
          </div>

          <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" >
            <thead>
              <tr>
                <th style="background:#5D428C; color:#fff !important">Menú</th>
                <th style="background:#5D428C; color:#fff !important">Sub uID</th>
                <th style="background:#5D428C; color:#fff !important">Submenú</th>
                <th style="background:#5D428C; color:#fff !important">Propiedad</th>
              </tr>

            </thead>
            @foreach ($na as $menKey => $submenus)
              @foreach ($submenus as $key => $value)
                @for ($i=0; $i < count($value); $i++)
                    <tr>
                      <td>{{$value[$i]->menu->men_name}}</td>
                      <td><input value="{{$value[$i]->sub_uID}}" disabled class="w-100 text_center" name="{{$value[$i]->sub_uID}}_subuID" style="border:0px solid #fff"></td>
                      <td>{{$value[$i]->sub_name}}</td>
                      <td>
                        <select class="form-control" name="property[]">
                          <option value="{{$value[$i]->sub_uID}}_none">Ninguno</option>
                          <option value="{{$value[$i]->sub_uID}}_own">Propio</option>
                          <option value="{{$value[$i]->sub_uID}}_subarea">Sub-Área</option>
                          <option value="{{$value[$i]->sub_uID}}_area">Área</option>
                          <option value="{{$value[$i]->sub_uID}}_all">Todos</option>
                        </select>
                      </td>
                     </tr>
                @endfor
              @endforeach
             @endforeach

          </table>



          <div class="form-group row ">
            <button type="submit" class="btn btn-success text-center">Enviar información</button>
        </div>
    </form>


@endsection


@section('footer')

<script src="{{ url('/public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/public/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Data-Table  -->
<script src="{{ url('/public/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/public/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	 $(document).ready(function(){
         $('.us_name').select2();
      // $('#datatable').DataTable();
    });


    </script>

    @endsection
