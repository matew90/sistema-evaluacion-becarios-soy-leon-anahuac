@extends('layout.main')

@section('content')
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form  action="{{ isset($sub_edit)?route('admin.submenu.update', $sub_edit->sub_uID):route('admin.submenu.store') }}" method="post">
          @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Menú</label>
            <div class="col-sm-10">
                <select class="custom-select" name="men_uID">
                    <option value="">Selecciona una opción</option>
                    @foreach ($getMenu as $key => $value)
                        <option value="{{ $value->men_uID }}" {{ isset($sub_edit)&&($sub_edit->men_uID==$value->men_uID)?'selected':'' }}>{{ $value->men_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">Status</label>
            <div class="col-sm-10">
                <select class="custom-select" name="status">
                    <option value="">Selecciona una opción</option>
                    @foreach ($getStatus as $key => $value)
                        <option value="{{ $value->sta_uID }}" {{ isset($sub_edit)&&($sub_edit->sta_uID==$value->sta_uID)?'selected':'' }}>{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre del submenú</label>
              <div class="col-sm-10">
                  <input class="form-control" type="text" value="{{ isset($sub_edit)?$sub_edit->sub_name:'' }} " name="name">
              </div>
          </div>
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre ruta</label>
              <div class="col-sm-10">
                  <input class="form-control" type="text" value="{{ isset($sub_edit)?$sub_edit->sub_route:'' }}" name="route">
              </div>
          </div>
          <div class="form-group row">
              <label for="example-text-input" class="col-sm-2 col-form-label text-right">Prefix</label>
              <div class="col-sm-10">
                  <input class="form-control" type="text" value="{{ isset($sub_edit)?$sub_edit->sub_slug:'' }}" name="slug">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label text-right">Visible</label>
              <div class="col-sm-10">
                  <select class="custom-select" name="visible">
                      <option value="">Selecciona una opción</option>
                      <option value="1" {{ isset($sub_edit)&&($sub_edit->sub_visible==1)?'selected':'' }}>Si</option>
                      <option value="0" {{ isset($sub_edit)&&($sub_edit->sub_visible==0)?'selected':'' }}>No</option>
                  </select>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-2 col-form-label text-right">Submenu al que se liga</label>
              <div class="col-sm-10">
                  <select class="custom-select" name="sub_parent_uID">
                      <option value="">Selecciona una opción</option>
                      @foreach ($getSubmenu as $key => $value)
                          <option value="{{ $value->sub_uID }}" {{ isset($sub_edit)&&($sub_edit->sub_uID==$value->sta_uID)?'selected':'' }}>{{ $value->sub_name }}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="form-group row ">
            <button type="submit" class="btn btn-success text-center">Enviar información</button>
        </div>
    </form>
  </div>
</div>


@endsection
