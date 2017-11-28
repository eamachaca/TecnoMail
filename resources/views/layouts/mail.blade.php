@extends('layouts.app')

@section('css')
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div id="wrapper" class="gray-bg">
        <div id="page">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content mailbox-content">
                            <div class="file-manager">
                                <a class="btn btn-block btn-primary compose-mail" href="mail_compose.html">Compose
                                    Mail</a>
                                <div class="space-25"></div>
                                <h5>Folders</h5>
                                <ul class="folder-list m-b-md" style="padding: 0">
                                    <li><a href="#"> <i class="fa fa-inbox "></i> Inbox <span
                                                    class="label label-black pull-right"> Mensaje loco xD 16</span> </a></li>
                                </ul>
                                <h5>Categories</h5>
                                <ul class="category-list" style="padding: 0">
                                    <li><a href="#"> <i class="fa fa-circle text-navy"></i> Work </a></li>
                                    <!--
                                    <li><a href="#"> <i class="fa fa-circle text-white"></i> Work </a></li>
                                    <li><a href="#"> <i class="fa fa-circle text-danger"></i> Documents</a></li>
                                    <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                                    <li><a href="#"> <i class="fa fa-circle text-info"></i> Advertising</a></li>
                                    <li><a href="#"> <i class="fa fa-circle text-warning"></i> Clients</a></li>
                                    -->
                                </ul>

                                <h5 class="tag-title">Labels</h5>
                                <ul class="tag-list" style="padding: 0">
                                    <li><a href="#"><i class="fa fa-tag"></i>Some Tag</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('more')
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
