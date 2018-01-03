@extends('admin.layouts.index')
@section('page_heading',__('Counts Peer User').': '.$user->name)
@section('th')
    <th>{{__('Place')}}</th>
    <th>{{__('Quantity Entries')}}</th>
    <th>{{__('Last Use')}}</th>
@endsection
@section('tbody')
    @foreach($user->counters as $counter)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{__($counter->place)}}</td>
            <td>{{__($counter->quantity)}}</td>
            <td>{{$counter->hourHumans()}}</td>
        </tr>
    @endforeach
@endsection
@push('js')
    <script>
        var table;
        $(document).ready(function () {
            table = $('#data_table').DataTable({
                dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                lengthMenu: [[5, 10, 20, -1], ["Cinco", "Diez", "Veinte", "All"]],
                language: {
                    url: "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    buttons: {
                        copy: 'Copiar',
                        colvis: 'Columnas Visibles',
                        print: 'Imprimir'
                    }
                },
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ]
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-sm-6:eq(0)');
        });
    </script>
@endpush