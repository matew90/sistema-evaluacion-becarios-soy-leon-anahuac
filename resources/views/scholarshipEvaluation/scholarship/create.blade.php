@extends('layout.main')
@section('title')
    UAQ | Alta de Becario/ Evaluador
@endsection

<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ url('/public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
<style>
    #altaBecarios {
        display: block;
    }

    #altaCoordinadores {
        display: none;
    }

    #altaEvaluadores {
        display: none;
    }
</style>
@section('filter')
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">

            <div class="h5 mb-0 font-weight-bold">
                <button id="botonBecario" onclick="altaBecarios();" class="btn btn-lg btn-block"
                    style="border-color:#9267DC; border-bottom: 3px solid #9267DC; color: #9267DC;" type="checkbox"
                    checked="">
                    Alta Becario <i id="link_becario" class="mdi mdi-school mdi-24px" style="color: #8c34ea"></i>
                </button>
            </div>

        </div>

        <div class="col-xl-4 col-md-4 mb-4">

            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="botonCoordinador" onclick="altaCoordinadores();" class="btn btn-lg btn-block"
                    style="border-color:#9267DC; border-bottom: 3px solid #9267DC; color: #9267DC;">
                    Alta coordinador <i id="link_coordinador" class="mdi mdi-account-group mdi-24px"
                        style="color: #8c34ea"></i>

                </button>
            </div>

        </div>
        <div class="col-xl-4 col-md-4 mb-4">

            <div class="h5 mb-0 font-weight-bold text-gray-800">
                <button id="botonEvaluador" onclick="altaEvaluadores();" class="btn btn-lg btn-block"
                    style="border-color:#9267DC; border-bottom: 3px solid #9267DC; color: #9267DC;">
                    Alta Evaluador <i id="link_evaluador" class="mdi mdi-account-multiple-check mdi-24px"
                        style="color: #8c34ea"></i>
                </button>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="altaBecarios">
        <div class="col-lg-12">
            <form id="formSendBecario">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <input class="form-control" value="{{ $id_conv->conv_uID }}" type="hidden" id="conv_uID"
                                name="conv_uID">
                            <div class="col-lg-6">
                                <label class="col-sm-2 col-form-label text-justify">Id SIU<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="id_SIUB" id="id_SIUB" maxlength="8"
                                        minlength="6" required>
                                </span>
                            </div>

                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombreB" id="nombreB" maxlength="30"
                                        minlength="3" required>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Paterno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoPatB" id="apellidoPatB"
                                        required maxlength="30" minlength="5">
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Materno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoMatB" id="apellidoMatB"
                                        required maxlength="30" minlength="5">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Carrera<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="area_id1B" id="area_id1B">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="fas fa-chalkboard-teacher  "></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="area_idB" id="area_idB" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_carreras as $area)
                                            @if ($area->ar_subname != '')
                                                {
                                                @php
                                                    $subname = 'La subárea es: /' . $area->ar_subname;
                                                @endphp
                                                }
                                            @else
                                                if(){
                                                @php
                                                    $subname = '';
                                                @endphp
                                                }
                                            @endif
                                            <option value="{{ $area->ar_uID }}">{{ $area->ar_name }}
                                                {{ $subname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-2 col-form-label text-justify">Tipo de beca<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i class="fas fa-list"></i></button>
                                    <input class="form-control" type="text" name="tipo_becaB" id="tipo_becaB"
                                        required maxlength="30" minlength="6">
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Porcentaje de beca<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-percent mdi-18px"></i></button>
                                    <input class="form-control" type="number" name="porcentage_becaB"
                                        id="porcentage_becaB" required maxlength="3" minlength="2">
                                </span>

                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo Institucional<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff">
                                        <img src="{{ url('public/img/logos/a-anahuac.png') }}" style="width:15px"
                                            alt="">
                                    </button>
                                    <input class="form-control" type="text" name="email_InstitucionalB"
                                        id="email_InstitucionalB" required>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo personal<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i class="fas fa-at 2x"></i></button>
                                    <input class="form-control" type="text" name="email_personalB"
                                        id="email_personalB" required>
                                </span>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 text-right">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                                <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                    type="button" id="validateB">Registrar</button>


                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" id="altaCoordinadores">
        <div class="col-lg-12">
            <form id="formSendCoordinator">
                @csrf
                <div class="row">


                    <div class="col-lg-12">
                        <div class="form-group row">
                            <input class="form-control" value="{{ $id_conv->conv_uID }}" type="hidden" id="conv_uIDC"
                                name="conv_uIDC">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Id Global Talent<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="idGlobalTalentC"
                                        id="idGlobalTalentC" placeholder="Id Global Talent" maxlength="8"
                                        minlength="6" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombreC" id="nombreC"
                                        placeholder="Nombre" minlength="3" maxlength="30" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Paterno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoPatC" id="apellidoPatC"
                                        placeholder="Apellido Paterno" minlength="4" maxlength="30" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Materno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoMatC" id="apellidoMatC"
                                        placeholder="Apellido Materno" minlength="4" maxlength="30" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Área<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="area_id1C" id="area_id1C">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="far fa-building 2x"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="area_idC" id="area_idC" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_areas as $area)
                                            @if ($area->ar_subname != '')
                                                {
                                                @php
                                                    $subname = 'La subárea es: /' . $area->ar_subname;
                                                @endphp
                                                }
                                            @else
                                                if(){
                                                @php
                                                    $subname = '';
                                                @endphp
                                                }
                                            @endif
                                            <option value="{{ $area->ar_uID }}">{{ $area->ar_name }} {{ $subname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Grado<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="grado_id1" id="grado_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="grado_idC" id="grado_idC" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_degrees as $degree)
                                            <option value="{{ $degree->deg_uID }}">{{ $degree->deg_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo institucional<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff">
                                        <img src="{{ url('public/img/logos/a-anahuac.png') }}" style="width:15px"
                                            alt="">
                                    </button>
                                    <input class="form-control" type="email" name="emailC" id="emailC"
                                        placeholder="Correo institucional" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <input type="hidden" value="2" name="tipoUsuario_idC" id="tipoUsuario_idC">
                                <label class="col-sm-3 col-form-label text-justify">Correo personal<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i class="fas fa-at 2x"></i></button>
                                    <input class="form-control" type="email" name="email_personalC"
                                        id="email_personalC" placeholder="Correo personal" required>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 text-right">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                                <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                    type="button" id="validateCoordinador">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" id="altaEvaluadores">
        <div class="col-lg-12">
            <form id="formSendCoordinator">
                @csrf
                <div class="row">


                    <div class="col-lg-12">
                        <div class="form-group row">
                            <input class="form-control" value="{{ $id_conv->conv_uID }}" type="hidden" id="conv_uIDC"
                                name="conv_uIDC">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Id Global Talent<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="mdi mdi-school mdi-18px"></i></button>
                                    <input class="form-control" type="text" name="idGlobalTalentE"
                                        id="idGlobalTalentE" placeholder="Id Global Talent" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Nombre (s)<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="nombreE" id="nombreE"
                                        placeholder="Nombre" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Paterno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoPatE" id="apellidoPatE"
                                        placeholder="Apellido Paterno" required>
                                </span>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Apellido Materno<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                            class="dripicons-user 2x"></i></button>
                                    <input class="form-control" type="text" name="apellidoMatE" id="apellidoMatE"
                                        placeholder="Apellido Materno" required>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Área<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="area_id1E" id="area_id1E">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="far fa-building"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="area_idE" id="area_idE" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_areas as $area)
                                            @if ($area->ar_subname != '')
                                                {
                                                @php
                                                    $subname = 'La subárea es: /' . $area->ar_subname;
                                                @endphp
                                                }
                                            @else
                                                if(){
                                                @php
                                                    $subname = '';
                                                @endphp
                                                }
                                            @endif
                                            <option value="{{ $area->ar_uID }}">{{ $area->ar_name }} {{ $subname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Grado<span
                                        class="text-danger">*</span></label>
                                <div class="input-group " name="grado_id1" id="grado_id1">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                                class="mdi mdi-school mdi-18px"></i></button>
                                    </div>
                                    <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                        name="grado_idE" id="grado_idE" data-select2-id="select2SinglePlaceholder"
                                        tabindex="-1" aria-hidden="true" required>
                                        <option value="">Selecciona una opción</option>
                                        @foreach ($lista_degrees as $degree)
                                            <option value="{{ $degree->deg_uID }}">{{ $degree->deg_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo institucional<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff">
                                        <img src="{{ url('public/img/logos/a-anahuac.png') }}" style="width:15px"
                                            alt="">
                                    </button>
                                    <input class="form-control" type="text" name="emailE" id="emailE"
                                        placeholder="Correo institucional" required>
                                </span>
                            </div>
                            <input type="hidden" value="1" name="tipoUsuario_idE" id="tipoUsuario_idE">

                            <div class="col-lg-6">
                                <label class="col-sm-3 col-form-label text-justify">Correo personal<span
                                        class="text-danger">*</span></label>
                                <span class="input-group-prepend">
                                    <button type="button" class="btn" style="background:#FF5900; color:#fff"><i class="fas fa-at 2x"></i></button>
                                    <input class="form-control" type="text" name="email_personalE"
                                        id="email_personalE" placeholder="Correo personal" required>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 text-right">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button class="btn btn-outline-primary  waves-effect waves-light">Cancelar</button>
                                <button class="btn waves-effect waves-light" style="background: #FF5900; color: #ffffff"
                                    type="button" id="validateEvaluador">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>

    <script>
        function altaBecarios() {
            document.getElementById('altaBecarios').style.display = 'block';
            document.getElementById('altaCoordinadores').style.display = 'none';
            document.getElementById('altaEvaluadores').style.display = 'none';
            document.getElementById('botonBecario').style.background = "#9267DC";
            document.getElementById('botonBecario').style.color = "#ffffff";
            document.getElementById('botonEvaluador').style.background = "#ffffff";
            document.getElementById('botonEvaluador').style.color = "#9267DC";
            document.getElementById('botonCoordinador').style.background = "#ffffff";
            document.getElementById('botonCoordinador').style.color = "#7043c1";
            document.getElementById('link_becario').style.color = "#ffffff";
            document.getElementById('link_evaluador').style.color = "#9267DC";
            document.getElementById('link_coordinador').style.color = "#9267DC";
        }
    </script>
    <script>
        function altaEvaluadores() {
            document.getElementById('altaBecarios').style.display = 'none';
            document.getElementById('altaCoordinadores').style.display = 'none';
            document.getElementById('altaEvaluadores').style.display = 'block';
            document.getElementById('botonEvaluador').style.background = "#9267DC";
            document.getElementById('botonEvaluador').style.color = "#ffffff";
            document.getElementById('botonBecario').style.background = "#ffffff";
            document.getElementById('botonBecario').style.color = "#9267DC";
            document.getElementById('botonCoordinador').style.background = "#ffffff";
            document.getElementById('botonCoordinador').style.color = "#7043c1";
            document.getElementById('link_evaluador').style.color = "#ffffff";
            document.getElementById('link_becario').style.color = "#9267DC";
            document.getElementById('link_coordinador').style.color = "#9267DC";
        }
    </script>
    <script>
        function altaCoordinadores() {
            document.getElementById('altaBecarios').style.display = 'none';
            document.getElementById('altaCoordinadores').style.display = 'block';
            document.getElementById('altaEvaluadores').style.display = 'none';
            document.getElementById('botonCoordinador').style.background = "#9267DC";
            document.getElementById('botonCoordinador').style.color = "#ffffff";
            document.getElementById('botonBecario').style.background = "#ffffff";
            document.getElementById('botonBecario').style.color = "#9267DC";
            document.getElementById('botonEvaluador').style.background = "#ffffff";
            document.getElementById('botonEvaluador').style.color = "#9267DC"
            document.getElementById('link_coordinador').style.color = "#ffffff";
            document.getElementById('link_becario').style.color = "#9267DC";
            document.getElementById('link_evaluador').style.color = "#9267DC";
        }
    </script>

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        $("#validateB").click(function() {

            var id_SIUB = $("#id_SIUB").val();
            var nombreB = $("#nombreB").val();
            var apellidoPatB = $("#apellidoPatB").val();
            var apellidoMatB = $("#apellidoMatB").val();
            var area_idB = $("#area_idB").val();
            var tipo_becaB = $("#tipo_becaB").val();
            var porcentage_becaB = $("#porcentage_becaB").val();
            var email_InstitucionalB = $("#email_InstitucionalB").val();
            var email_personalB = $("#email_personalB").val();
            var conv_uID = $("#conv_uID").val();
            var expReg2 = /^[a-zA-Z0-9._-]+@gmail.com/;
            var expReg = /^[a-zA-Z0-9._-]+@anahuac.mx/;
            var req = /^[a-zA-Z]/;
            var esValido = expReg.test(email_InstitucionalB);
            var esNombre = req.test(nombreB);
            var esMaterno = req.test(apellidoMatB);
            var esPaterno = req.test(apellidoPatB);
            if (id_SIUB == "") {
                Swal.fire({
                    title: "Falta poner el Id SIU del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#id_SIUB").focus();
            } else if (nombreB == "") {
                Swal.fire({
                    title: "Falta digitar el nombre del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreB").focus();

            } else if (esNombre == false) {
                Swal.fire({
                    title: "El nombre es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreB").focus();
            } else if (apellidoPatB == "") {
                Swal.fire({
                    title: "Falta indicar el apellido paterno del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatB").focus();

            } else if (esPaterno == false) {
                Swal.fire({
                    title: "El apellido paterno es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatB").focus();
            } else if (apellidoMatB == "") {
                Swal.fire({
                    title: "Falta indicar el apellido materno del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMatB ").focus();
            } else if (esMaterno == false) {
                Swal.fire({
                    title: "El apellido materno es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreB").focus();
            } else if (area_idB == "") {
                Swal.fire({
                    title: "Falta seleccionar la carrera a la que pertenece el becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#area_idB").focus();
            } else if (tipo_becaB == "") {
                Swal.fire({
                    title: "Falta indicar el tipo de beca",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#tipo_becaB").focus();
            } else if (porcentage_becaB == "") {
                Swal.fire({
                    title: "Falta digitar el porcentaje de la beca",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#porcentage_becaB").focus();
            } else if (email_InstitucionalB == "") {
                Swal.fire({
                    title: "Falta digitar el correo institucional del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_InstitucionalB").focus();
            } else if (esValido == false) {
                Swal.fire({
                    title: "El correo institucional es inválido, debe ser extensión @anahuac.mx",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_Institucional").focus();
            } else if (email_personalB == "") {
                Swal.fire({
                    title: "Falta digitar el correo personal del becario",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personalB").focus();
            } else {
                //alert(1);
                var SITEURL = "{{ url('/') }}";
                var formData = new FormData(document.getElementById("formSendBecario"));
                formData.append("id_SIUB", id_SIUB);
                formData.append("nombreB", nombreB);
                formData.append("apellidoPatB", apellidoPatB);
                formData.append("apellidoMatB", apellidoMatB);
                formData.append("area_idB", area_idB);
                formData.append("tipo_becaB", tipo_becaB);
                formData.append("porcentage_becaB", porcentage_becaB);
                formData.append("email_personalB", email_personalB);
                formData.append("email_InstitucionalB", email_InstitucionalB);
                formData.append("conv_uID", conv_uID);
                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/becarios/crear",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {

                        json = jQuery.parseJSON(JSON.stringify(res));
                        Swal.fire({
                            title: json.title,
                            text: json.text,
                            type: json.type,
                            confirmButtonText: 'Entendido',
                            timer: 15000
                        }).then(function() {
                            window.location.reload();
                        });
                    });

            }
            formSendBecario.reset();
        });
        $("#validateCoordinador").click(function() {
            var idGlobalTalentC = $("#idGlobalTalentC").val();
            var nombreC = $("#nombreC").val();
            var apellidoPatC = $("#apellidoPatC").val();
            var apellidoMatC = $("#apellidoMatC").val();
            var area_idC = $("#area_idC").val();
            var grado_idC = $("#grado_idC").val();
            var emailC = $("#emailC").val();
            var conv_uIDC = $("#conv_uIDC").val();
            var email_personalC = $("#email_personalC").val();
            var tipoUsuario_idC = $("#tipoUsuario_idC").val();
            var expReg2 = /^[a-zA-Z0-9._-]+@gmail.com/;
            var expReg = /^[a-zA-Z0-9._-]+@anahuac.mx/;
            var req = /^[a-zA-Z]/;
            var esValido = expReg.test(emailC);
            var esValid = expReg2.test(email_personalC);
            var esNombre = req.test(nombreC);
            var esMaterno = req.test(apellidoMatC);
            var esPaterno = req.test(apellidoPatC);
            if (idGlobalTalentC == "") {
                Swal.fire({
                    title: "Falta poner el Id Global Talent del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#idGlobalTalentC").focus();
            } else if (nombreC == "") {
                Swal.fire({
                    title: "Falta poner el nombre del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreC").focus();
            } else if (esNombre == false) {
                Swal.fire({
                    title: "El nombre es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreC").focus();
            } else if (apellidoPatC == "") {
                Swal.fire({
                    title: "Falta poner el Apellido Paterno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatC").focus();
            } else if (esPaterno == false) {
                Swal.fire({
                    title: "El nombre es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatC").focus();
            } else if (apellidoMatC == "") {
                Swal.fire({
                    title: "Falta poner apellido Materno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMatC").focus();
            } else if (esMaterno == false) {
                Swal.fire({
                    title: "El nombre es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMatC").focus();
            } else if (area_idC == "") {
                Swal.fire({
                    title: "Falta seleccionar la Área a la que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#area_idC").focus();
            } else if (emailC == "") {
                Swal.fire({
                    title: "Falta poner el correo institucional del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#emailC").focus();
            } else if (esValido == false) {
                Swal.fire({
                    title: "El correo institucional es inválido, debe ser extensión @anahuac.mx",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#emailC").focus();
            } else if (email_personalC == "") {
                Swal.fire({
                    title: "Falta poner el correo personal del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personalC").focus();
            } else if (esValid == false) {
                Swal.fire({
                    title: "El correo personal es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personalC").focus();
            } else if (grado_idC == "") {
                Swal.fire({
                    title: "Falta seleccionar el grado academico del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#grado_idC").focus();
            } else if (tipoUsuario_idC == "") {
                Swal.fire({
                    title: "Falta seleccionar el Tipo de usuario al que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#tipoUsuario_idC").focus();
            } else {
                var SITEURL = "{{ url('/') }}";
                var formData = new FormData(document.getElementById("formSendCoordinator"));
                formData.append("idGlobalTalentC", idGlobalTalentC);
                formData.append("nombreC", nombreC);
                formData.append("apellidoPatC", apellidoPatC);
                formData.append("apellidoMatC", apellidoMatC);
                formData.append("area_idC", area_idC);
                formData.append("grado_idC", grado_idC);
                formData.append("emailC", emailC);
                formData.append("email_personalC", email_personalC);
                formData.append("tipoUsuario_idC", tipoUsuario_idC);
                formData.append("conv_uIDC", conv_uIDC);
                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/coordinador-evaluador/crear",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {

                        json = jQuery.parseJSON(JSON.stringify(res));
                        Swal.fire({
                            title: json.title,
                            text: json.text,
                            type: json.type,
                            confirmButtonText: 'Entendido',
                            timer: 15000
                        }).then(function() {

                            window.location.reload();
                        });
                    });

            }
            formSendCoordinator.reset();
        });
        $("#validateEvaluador").click(function() {
            var idGlobalTalentE = $("#idGlobalTalentE").val();
            var nombreE = $("#nombreE").val();
            var apellidoPatE = $("#apellidoPatE").val();
            var apellidoMatE = $("#apellidoMatE").val();
            var area_idE = $("#area_idE").val();
            var grado_idE = $("#grado_idE").val();
            var emailE = $("#emailE").val();
            var conv_uIDC = $("#conv_uIDC").val();
            var email_personalE = $("#email_personalE").val();
            var tipoUsuario_idE = $("#tipoUsuario_idE").val();
            var expReg2 = /^[a-zA-Z0-9._-]+@gmail.com/;
            var expReg = /^[a-zA-Z0-9._-]+@anahuac.mx/;
            var req = /^[a-zA-Z]/;
            var esValido = expReg.test(emailE);
            var esValid = expReg2.test(email_personalE);
            var esNombre = req.test(nombreE);
            var esMaterno = req.test(apellidoMatE);
            var esPaterno = req.test(apellidoPatE);
            if (idGlobalTalentE == "") {
                Swal.fire({
                    title: "Falta poner el Id Global Talent del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#idGlobalTalentE").focus();
            } else if (nombreE == "") {
                Swal.fire({
                    title: "Falta poner el nombre del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreE").focus();
            } else if (esNombre == false) {
                Swal.fire({
                    title: "El nombre es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#nombreE").focus();
            } else if (apellidoPatE == "") {
                Swal.fire({
                    title: "Falta poner el Apellido Paterno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatE").focus();
            } else if (esPaterno == false) {
                Swal.fire({
                    title: "El apellido paterno es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoPatE").focus();
            } else if (apellidoMatE == "") {
                Swal.fire({
                    title: "Falta poner apellido Materno del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMatE").focus();
            } else if (esMaterno == false) {
                Swal.fire({
                    title: "El apellido materno es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#apellidoMatE").focus();
            } else if (area_idE == "") {
                Swal.fire({
                    title: "Falta seleccionar la Área a la que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#area_idE").focus();
            } else if (emailE == "") {
                Swal.fire({
                    title: "Falta poner el correo institucional del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#emailE").focus();
            } else if (esValido == false) {
                Swal.fire({
                    title: "El correo institucional es inválido, debe ser extensión @anahuac.mx",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#emailC").focus();
            } else if (email_personalE == "") {
                Swal.fire({
                    title: "Falta poner el correo personal del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personalE").focus();
            } else if (esValid == false) {
                Swal.fire({
                    title: "El correo personal es inválido",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#email_personalE").focus();
            } else if (grado_idE == "") {
                Swal.fire({
                    title: "Falta seleccionar el grado academico del Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#grado_idE").focus();
            } else if (tipoUsuario_idE == "") {
                Swal.fire({
                    title: "Falta seleccionar el Tipo de usuario al que pertenece el Coordinador/Evaluador",
                    text: "Formulario incompleto",
                    type: "warning",
                    confirmButtonText: 'Entendido'
                });
                $("#tipoUsuario_idE").focus();
            } else {
                var SITEURL = "{{ url('/') }}";
                var formData = new FormData(document.getElementById("formSendCoordinator"));
                formData.append("idGlobalTalentE", idGlobalTalentE);
                formData.append("nombreE", nombreE);
                formData.append("apellidoPatE", apellidoPatE);
                formData.append("apellidoMatE", apellidoMatE);
                formData.append("area_idE", area_idE);
                formData.append("grado_idE", grado_idE);
                formData.append("emailE", emailE);
                formData.append("email_personalE", email_personalE);
                formData.append("tipoUsuario_idE", tipoUsuario_idE);
                formData.append("conv_uIDC", conv_uIDC);
                $.ajax({
                        url: SITEURL + "/evaluacion-becarios/coordinador-evaluador/evaluador",
                        type: "POST",
                        dataType: "json",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {

                        json = jQuery.parseJSON(JSON.stringify(res));
                        Swal.fire({
                            title: json.title,
                            text: json.text,
                            type: json.type,
                            confirmButtonText: 'Entendido',
                            timer: 15000
                        }).then(function() {
                            window.location.reload();
                        });
                    });

            }
            formSendCoordinator.reset();
        });
        //  #Fin validación de formulario

        //--------------VALIDACIONES-------------------------//
    </script>
@endsection
