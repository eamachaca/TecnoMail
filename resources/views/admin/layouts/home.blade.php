@extends('layouts.dashboard')
@section('page_heading',__('Dashboard'))
@section('section')

    <!-- /.row -->
    <div class="col-sm-12">
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
            </div>
            <div class="panel-body">
                @yield('more')
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
@endsection
