@extends('layout.main')
@section('title')
    UAQ | Importar Becarios
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body mb-0">
                    <div class="mt-0 header-title">
                        Importación Becarios
                    </div>
                    <div class="col-lg-12">
                        <div class="row justify-content-center mb-4">
                            <form action="" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="file" name="archivo" class="form-control" accept=".csv">
                                </div>
                                <br>
                                <div class="row justify-content-center mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        Importar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function() {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>
