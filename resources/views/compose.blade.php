@extends('layouts.mail')

@section('scss')

    <link href="{{ asset('css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
@endsection
@section('more')

    <div class="col-lg-9 animated fadeInRight">
        <div class="mail-box-header">
            <div class="pull-right tooltip-demo">
                <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
                <a href="{{route('mail')}}" class="btn btn-danger btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
            </div>
            <h2>
                Compse mail
            </h2>
        </div>
        <div class="mail-box">


            <div class="mail-body">

                <form class="form-horizontal" method="get">
                    <div class="form-group"><label class="col-sm-2 control-label">To:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   @if(isset($to))
                                   value="{{$to}}"
                                   @else
                                   value=""
                                    @endif
                            >
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10"><input type="text" class="form-control"
                                                      @if(isset($subject))
                                                      value="{{$subject}}"
                                                      @else
                                                      value=""
                                    @endif
                            >
                        </div>
                    </div>
                </form>

            </div>

            <div class="mail-text h-200">

                <div class="summernote">
                    @if(isset($message))
                        {{$message}}
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="mail-body text-right tooltip-demo">
                <a href="{{route('mail')}}" class="btn btn-sm btn-primary" data-toggle="tooltip"
                   data-placement="top" title="Send"><i class="fa fa-reply"></i> Send</a>
                <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
            </div>
            <div class="clearfix"></div>


        </div>
    </div>
@endsection
@section('js')
    <!--    <script src="js/app.js"></script>
-->

    <!-- Mainly scripts -->
    <!--  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>-->
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- SUMMERNOTE -->
    <script src="{{ asset('js/plugins/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.summernote').summernote();

        });

    </script>

@endsection
