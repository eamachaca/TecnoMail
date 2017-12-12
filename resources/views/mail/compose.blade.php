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
                   data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> {{__('Draft')}}</a>
                <a href="{{route('mail')}}" class="btn btn-danger btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Discard email"><i class="fa fa-times"></i> {{__('Discard')}}</a>
            </div>
            <h2>
                Compose mail
            </h2>
        </div>
        <div class="mail-box">

            <form class="form-horizontal" action="{{route('send')}}" method="post" onsubmit="return isValid();">

                <div class="mail-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group"><label class="col-sm-2 control-label">{{__('To')}}:</label>

                        <div class="col-sm-10">
                            <input name="email" type="email" class="form-control"
                                   value="{{$to}}" required
                            >
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">{{__('Subject')}}:</label>

                        <div class="col-sm-10">
                            <input name="subject" type="text" class="form-control"
                                   value="{{$subject}}" required
                            >
                        </div>
                    </div>
                </div>

                <input id="body" name="body" type="text" value="{{$body}}" hidden>
                <div class="mail-text h-200">

                    <div id="summernote"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="mail-body text-right tooltip-demo">
                    <button type="submit" class="btn btn-sm btn-primary"
                            data-toggle="tooltip"
                            data-placement="top" title="Send"><i class="fa fa-reply"></i> Send
                    </button>
                    <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                       data-placement="top" title="Discard email"><i class="fa fa-times"></i> Discard</a>
                    <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                       data-placement="top" title="Move to draft folder"><i class="fa fa-pencil"></i> Draft</a>
                </div>
                <div class="clearfix"></div>

                <input name="_token" type="text" value="{{csrf_token()}}" hidden>


            </form>
        </div>
    </div>
@endsection
@section('jss')
    <script>
        var summernote;

        function isValid() {
            if (summernote.summernote('isEmpty')) {
                if (confirm('¿Estas seguro de dejar el campo vacío?')) {
                    $('#body').val('');
                    return true;
                }
                return false;
            }
            $('#body').val(summernote.summernote('code'));
            return true;
        }
    </script>
    <!--    <script src="js/app.js"></script>
-->

    <!-- Mainly scripts -->
    <!--  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>-->
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- SUMMERNOTE -->
    <script src="{{ asset('js/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/lang/summernote-es-ES.js') }}"></script>

@endsection
@push('ready')
    summernote=$('#summernote').summernote({
    lang: 'es-ES',
    placeholder: 'Escriba su Mensaje, Puede editarlo con las opciones ↑ ;    ',
    });
    @if(!is_null($body))
        summernote.summernote("code",'{!!$body!!}');
    @endif
@endpush
