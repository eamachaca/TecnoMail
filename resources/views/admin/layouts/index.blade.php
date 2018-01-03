@extends('admin.layouts.home')
@section('more')
    <div class="col-12 animated fadeInRight">
        <div class="mail-box">
            <div class="row">
                <div class="ibox-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <table id="data_table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 1%;">#</th>
                        @yield('th')
                    </tr>
                    </thead>
                    <tbody>
                    @yield('tbody')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.colVis.min.js"></script>
@endpush
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap4.min.css" rel="stylesheet">
@endpush