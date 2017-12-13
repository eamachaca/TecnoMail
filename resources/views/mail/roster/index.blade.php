@extends('layouts.index')
@section('route',route('folder.store'))
@section('th')
    <th style="height: 60%;">Nombre</th>
    <th>Acciones</th>
@endsection
@section('tbody')

@endsection
@section('content_modal')
    <div class="form-group"><label for="folder" class="col-sm-2 control-label">{{__('Name')}}:</label>

        <div class="col-sm-10">
            <input id="name" name="name" type="text" class="form-control"
                   value="" required
            >
        </div>
    </div>
@endsection
@section('jss')
    <script>
        function isValid() {
            if(isEmpty($('#id').val()))
                $('#id').val('0');
            return true;
        }

        function addId(td) {
            id = $(td).parents('tr').attr('id');
            $('#myModal').modal("show")
            $('#id').val(id);
        }
    </script>
@endsection

@push('ready')
    $("#myModal").on('hide.bs.modal', function () {
    $('#id').val('0');
    });
@endpush
