@extends('layout.main')
@section('title')
    UAQ | Evaluación
@endsection
<link href="{{ url('/public/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
@section('content')
    @csrf
    @foreach ($data as $key => $value)
        <div class="row">
            <div class="col-lg-12 pt-3">
                <div class="tab-pane mt-4">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="{{ url('public/img/user/leo_user2.png') }}" alt="" height="150"
                                class="d-block mx-auto">
                        </div>
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-block" style="background:#9267DC; color:#fff"><i
                                class="dripicons-user">   DATOS DEL ALUMNO</i></button>
                            <ul class="list-unstyled">
                                <li class="font-11 text-muted">
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ $value['name'] . '     |   ID BANNER : ' . $value['us_banner_id'] }}'
                                        disabled>
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ 'CARRERA : ' . $value['ar_uID'] }}' disabled>
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ 'CORREO INSTITUCIONAL : ' . $value['email'] }}' disabled>
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ $value['sch_type'] . '     |   PORCENTAJE DE BECA : ' . $value['sch_porcentage'].'%' }}'
                                        disabled>
                                </li>
                            </ul>


                        </div>
                        <!--end col-->
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-block" style="background:#9267DC; color:#fff"><i
                                class="dripicons-user-group"> DATOS DEL EVALUADOR</i></button>
                            <ul class="list-unstyled">
                                <li class="font-11 text-muted">
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ 'EVALUADOR/COORDINADOR :   ' . $value['name1'] }}' disabled>
                                    <input class="form-control text-muted"
                                        style="background:#fff; border-color:#fff; !important" type="text"
                                        value='{{ 'ID BANNER : ' . $value['us_banner_id1'] }}' disabled>
                                </li>
                            </ul>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
            </div>

        </div>






        <h5 class="mt-2  text-primary">EVALUACIÓN</h5>
        <form id="formSendEvaluation">
            @csrf
            <input type="hidden" id="assig_uID" name="assig_uID" value='{{ $value['assig_uID'] }}'>
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="periodo" class="col-sm-2 col-form-label text-justify">Fecha</label>
                        <div class="form-group">
                            <span class="input-group-prepend">
                                <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                    class="mdi mdi-calendar-check-outline mdi-18px"></i></button>
                                <input class="form-control" type="text" id="fecha" name="fecha" value='{{ $value['updated_at'] }}' required>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="col-sm-3 col-form-label text-justify">Desempeño<span
                                class="text-danger">*</span></label>
                        <div class="input-group " name="question_id1" id="question_id1">
                            <div class="input-group-prepend">
                                <button type="button" class="btn" style="background:#FF5900; color:#fff">
                                    <i class="mdi mdi-school mdi-18px"></i>
                                </button>
                            </div>
                            <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                name="question_1" id="question_1" data-select2-id="select2SinglePlaceholder"
                                tabindex="-1" aria-hidden="true" required>
                                <option value="">{{ $value['eval_Question1'] }}</option>
                                <option value="Muy satisfactorio">Muy satisfactorio</option>
                                <option value="Satisfactorio">Satisfactorio</option>
                                <option value="Bueno">Bueno</option>
                                <option value="Regular">Regular</option>
                                <option value="Malo">Malo</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="periodo" class="col-sm-6 col-form-label text-justify">Funciones,
                            actividades y
                            proyectos desempeñados</label>
                        <div class="form-group">
                            <span class="input-group-prepend">
                                <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                    class="mdi mdi-creation mdi-18px"></i></button>
                                <input class="form-control" type="text" id="question_2" name="question_2"
                                value='{{ $value['eval_Question2'] }}'>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="email" class="col-sm-6 col-form-label text-justify">Aspectos
                            formativos
                            logrados en el alumno</label>
                        <span class="input-group-prepend">
                            <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                class="mdi mdi-summit mdi-18px"></i></button>
                            <input class="form-control" type="text" id="question_3" name="question_3"
                            value='{{ $value['eval_Question3'] }}'  >
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="col-sm-6 col-form-label text-justify">¿Desea que continue en el área?<span
                                class="text-danger">*</span></label>
                        <div class="input-group " name="question_id2" id="question_id2">
                            <div class="input-group-prepend">
                                <button type="button" class="btn" style="background:#FF5900; color:#fff">
                                    <i class="far fa-building 2x"></i>
                                </button>
                            </div>
                            <select class="select2-single-placeholder form-control select2-hidden-accessible"
                                name="question_4" id="question_4" data-select2-id="select2SinglePlaceholder"
                                tabindex="-1" aria-hidden="true" required>
                                <option value="">{{ $value['eval_Question4'] }}</option>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="email" class="col-sm-10 col-form-label text-justify">¿Por
                            qué?(En caso de que debiera ser cambiado, ¿a cuál sugiere?) *</label>
                        <span class="input-group-prepend">
                            <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                class="mdi mdi-comment-question mdi-18px"></i></button>
                            <input class="form-control" type="text" id="question_5" name="question_5" placeholder=""
                            value='{{ $value['eval_Question5'] }}'   >
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="periodo" class="col-sm-5 col-form-label text-justify">Comentarios y/o
                            Sugerencias</label>
                        <div class="form-group">
                            <span class="input-group-prepend">
                                <button type="button" class="btn" style="background:#FF5900; color:#fff"><i
                                    class="mdi mdi-comment mdi-18px"></i></button>
                                <input class="form-control" type="text" id="question_6" name="question_6"
                                value='{{ $value['eval_Question6'] }}'    >
                            </span>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    @endforeach
@endsection
@section('footer')
@endsection
