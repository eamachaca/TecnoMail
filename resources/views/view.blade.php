@extends('layouts.mail')

@section('scss')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection
@section('more')

    <div class="col-lg-9 animated fadeInRight">
        <div class="mail-box-header">
            <div class="pull-right tooltip-demo">
                <a href="{{route('compose',['reply'=>$mail->id])}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                   title="Print email"><i class="fa fa-print"></i> </a>
                <a href="{{route('mail')}}" class="btn btn-white btn-sm" data-toggle="tooltip"
                   data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a>
            </div>
            <h2>
                View Message
            </h2>
            <div class="mail-tools tooltip-demo m-t-md">


                <h3>
                    <span class="font-normal">Subject: </span>{{$mail->subject}}
                </h3>
                <h5>
                    <span class="pull-right font-normal">{{$mail->created_at}}</span>
                    <span class="font-normal">From: </span>{{$mail->eMail->name .' <'.$mail->eMail->e_mail.'>'}}
                </h5>
            </div>
        </div>
        <div class="mail-box">


            <div class="mail-body">
                {!! $mail->body !!}
            </div>
            @if($mail->files->isNotEmpty())
                <div class="mail-attachment">
                    <p>
                        <span><i class="fa fa-paperclip"></i> 2 attachments - </span>
                        <a href="#">Download all</a>
                        |
                        <a href="#">View all images</a>
                    </p>

                    <div class="attachment">
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="icon">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-name">
                                        Document_2014.doc
                                        <br/>
                                        <small>Added: Jan 11, 2014</small>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="image" class="img-responsive" src="img/p1.jpg">
                                    </div>
                                    <div class="file-name">
                                        Italy street.jpg
                                        <br/>
                                        <small>Added: Jan 6, 2014</small>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>

                                    <div class="image">
                                        <img alt="image" class="img-responsive" src="img/p2.jpg">
                                    </div>
                                    <div class="file-name">
                                        My feel.png
                                        <br/>
                                        <small>Added: Jan 7, 2014</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            @endif
            <div class="mail-body text-right tooltip-demo">
                <a class="btn btn-sm btn-white" href="{{route('compose',['reply'=>$mail->id])}}"><i
                            class="fa fa-reply"></i>
                    Reply</a>
                <a class="btn btn-sm btn-white" href="{{route('compose',['forward'=>$mail->id])}}"><i
                            class="fa fa-arrow-right"></i>
                    Forward</a>
                <button title="" data-placement="top" data-toggle="tooltip" type="button"
                        data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i>
                    Print
                </button>
                <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash"
                        class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove
                </button>
            </div>
            <div class="clearfix"></div>


        </div>
    </div>
@endsection
