@extends('layout.main')

@section('content')

<div class="row">
    <!--<div class="col-lg-6">
        <div class="card">
            <div class="card-body mb-0">
              <h4 class="mt-0 header-title">Crear Menú</h4>
                <div class="row">
                  <div class="col-lg-12">
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre del menú</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" id="example-text-input">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" id="example-text-input">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ícono</label>
                          <div class="col-9">
                              <input class="form-control" type="text" value="" id="example-text-input">
                          </div>
                          <div class="col-1">
                              <i id="preview-icon"></i>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" id="example-text-input">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-sm-2 col-form-label text-right">Status</label>
                          <div class="col-sm-10">
                              <select class="custom-select">
                                  <option value="">Selecciona una opción</option>
                                  @foreach ($getStatus as $key => $value)
                                      <option value="{{ $value->sta_uID }}">{{ $value->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row ">
                        <button type="button" class="btn btn-success text-center">Enviar información</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>-->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mb-0">
              <h4 class="mt-0 header-title">Crear Submenú</h4>
                <div class="row">
                  <div class="col-lg-8 offset-lg-2">
                    <form  action="{{ route('admin.submenu.store') }}" method="post">
                      @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right">Menú</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="menu">
                                <option value="">Selecciona una opción</option>
                                @foreach ($getMenu as $key => $value)
                                    <option value="{{ $value->men_uID }}">{{ $value->men_name }}</option>
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
                                    <option value="{{ $value->sta_uID }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre del submenú</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" name="name">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" name="route">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta (slug)</label>
                          <div class="col-sm-10">
                              <input class="form-control" type="text" value="" name="slug">
                          </div>
                      </div>

                      <h5>Browse / index</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta / slug</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_b">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="public_b">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_b">
                          </div>
                      </div>

                      <h5>Read / show</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_r">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="public_r">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_r">
                          </div>
                      </div>

                      <h5>Edit / edit</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_e">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="public_e">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_e">
                          </div>
                      </div>

                      <h5>Edit / update</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_u">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_u">
                          </div>
                      </div>

                      <h5>Add / create</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_a">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="public_a">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_a">
                          </div>
                      </div>
                      <h5>Add / store</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_s">
                          </div>
                      </div>
                    <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_s">
                          </div>
                      </div>

                      <h5>Delete / delete</h5>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Ruta</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="slug_d">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="example-text-input" class="col-sm-2 col-form-label text-right">Nombre interno</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="text" value="" name="name_d">
                          </div>
                      </div>


                      <div class="form-group row ">
                        <button type="submit" class="btn btn-success text-center">Enviar información</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection
