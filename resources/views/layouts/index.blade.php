@extends('layouts.mail')
@section('scss')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection
@section('more')
    <div class="col-lg-9 animated fadeInRight">
        <div class="mail-box">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="pull-right">
                                    <button data-toggle="modal" data-target="#myModal"
                                            class="btn btn-success">{{__('Create')}}</button>
                                </div>
                                <h2>{{$tittle}}</h2>
                            </div>
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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
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
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <form action="@yield('route')" method="post" onsubmit="return isValid();">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        @yield('content_modal')
                        <input name="_token" type="text" value="{{csrf_token()}}" hidden>
                        <input name="id" type="text" value="" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">{{__('Save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection