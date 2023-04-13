@extends('layout.main')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mb-0">
              <h4 class="mt-0 header-title">Crear Menú</h4>
              <form  action="{{ route('admin.menu.store') }}" method="post">
                <div class="row">
                    @csrf
                    <div class="col-lg-12">
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label text-right">Estatus<span class="text-danger">*</span></label>
                          <div class="col-sm-10">
                              <select class="custom-select" name="status_id" required>
                                  <option value="">Selecciona una opción</option>
                                  @foreach ($getStatus as $key => $value)
                                      <option value="{{ $value->sta_uID }}">{{ $value->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label text-right">Categoría<span class="text-danger">*</span></label>
                          <div class="col-sm-10">
                              <select class="custom-select" name="category_id" required>
                                  <option value="">Selecciona una opción</option>
                                  @foreach ($getCategory as $key => $value)
                                      <option value="{{ $value->cat_uID }}">{{ $value->cat_name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre del menú <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="slug" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ícono<span class="text-danger">*</span></label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="icon" id="icon"   onKeyUp="edValueKeyPress()" required>
                            </div>
                            <div class="col-1">
                                <i id="previewIcon" class="" style="font-size:30px"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre de la ruta<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="route_name" required>
                            </div>
                        </div>
#b9b9b9
                        <div class="form-group row text-right">
                          <button type="submit" class="btn btn-success text-center">Enviar información</button>
                      </div>
                    </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript">

  function edValueKeyPress()
  {
    var iconName = document.getElementById("icon");
    $("#previewIcon").removeClass().addClass(iconName.value);
    console.log(iconName.value);

  }

</script>
@endsection
