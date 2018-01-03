@extends('layouts.index')
@section('route',route('folder.store'))
@section('th')
    <th style="height: 60%;">{{__('Name')}}</th>
    <th>{{__('Actions')}}</th>
@endsection
@section('tbody')
    @foreach($folders as $folder)
        <tr id="{{$folder->id}}">
            <td>{{$loop->index+1}}</td>
            <td>{{__($folder->folderName->name)}}</td>
            <td>
                @if($folder->folderName->id>4)
                    <a href="{{route('roster.show',$folder->id)}}" class="btn btn-warning">{{__('Rules')}}</a>
                    <button onclick="addId(this)" data-dismiss="modal" class="btn btn-primary">{{__('Edit')}}</button>
                @endif
            </td>
        </tr>
    @endforeach
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
            $('#myModal').modal("show");
            $('#id').val(id);
            $('#name').val($(td).parents('td').prev().html());
        }
    </script>
@endsection

@push('ready')
    $("#myModal").on('hide.bs.modal', function () {
    $('#id').val('0');
    });
@endpush
