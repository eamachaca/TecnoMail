@extends('layouts.index')
@section('route',route('roster.store'))
@section('th')
    <th>{{__('Name')}}</th>
    <th>Tipo Busqueda</th>
    <th style="width: 20%">Acciones</th>
@endsection
@section('tbody')
    @foreach($folder->rosters as $roster)
        <tr id="{{$roster->id}}">
            <td>{{$loop->index+1}}</td>
            <td>{{$roster->data}}</td>
            @if($roster->is_mail)
                <td>Por EMail</td>
            @else
                <td>Por Palabra</td>
            @endif
            <td>
                <button onclick="addId(this)" data-dismiss="modal" class="btn btn-primary">{{__('Edit')}}</button>
                <button class="btn btn-danger">{{__('Delete')}}</button>
            </td>
        </tr>
    @endforeach
@endsection
@section('content_modal')
    <div class="form-group">
        <label for="folder" class="col-sm-2 control-label">{{__('Name')}}:</label>

        <div class="col-10">
            <input id="name" name="name" type="text" class="form-control"
                   value="" required
            >

        </div>
    </div>
    <div class="form-group">
        <label for="rules" class="col-sm-2 control-label">{{__('Filter for')}}:</label>

        <div class="col-10">
            <input type="checkbox" checked name="rules" id="checkbox_id" value="eMail">
            <label id="rules" for="checkbox_id">Email</label>

        </div>
    </div>

    <input id="folder" name="folder" type="text" value="{{$folder->id}}" hidden>
@endsection
@section('jss')
    <script>
        function validateCheck(bool) {
            $('#checkbox_id')[0].checked = bool;
            if (bool) {
                $('#rules').html('Email');
            } else {
                $('#rules').html('Palabra');

            }
        }

        function isValid() {
            if ($('#id').val() === null || $('#id').val() === '')
                $('#id').val('0');
            return true;
        }

        function addId(td) {
            id = $(td).parents('tr').attr('id');
            $('#myModal').modal("show");
            $('#id').val(id);
            let prev = $(td).parents('td').prev();
            $('#name').val(prev.prev().html());
            validateCheck(prev.html() === 'Por EMail');
        }
    </script>
@endsection
@push('ready')
    $("#myModal").on('hide.bs.modal', function () {
    $('#id').val('0');
    });
    $('#checkbox_id').change(function(){
    validateCheck(this.checked);
    });
@endpush