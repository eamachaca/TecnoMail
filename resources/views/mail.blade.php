@extends('layouts.mail')

@section('more')
    <div class="col-lg-9 animated fadeInRight">
        <div class="mail-box-header">

            <form method="get" action="{{route('mail')}}" class="pull-right mail-search">
                <div class="input-group">
                    @if(!is_null($folder))
                        <input type="text" name="folder" value="{{$folder->folderName->name}}" hidden>
                    @endif
                    <input type="text" class="form-control input-sm" name="search"
                           placeholder="Search email">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <h2>
                {{$folder->folderName->name}} <strong>({{$folder->readed}})</strong>
            </h2>
            <div class="mail-tools tooltip-demo m-t-md">
                <div class="btn-group pull-right">
                    <label class="pull-left m-r-sm">Mostrando {{$mails->firstItem()}}-{{$mails->lastItem()}} de {{$mails->total()}}</label>
                    @if(empty($previous))
                        <button class="btn btn-white btn-sm" disabled><i class="fa fa-arrow-left"></i></button>
                    @else
                        <a href="{{$previous}}" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></a>
                    @endif
                    @if(empty($next))
                        <button class="btn btn-white btn-sm" disabled><i class="fa fa-arrow-right"></i></button>
                    @else
                        <a href="{{$next}}" class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></a>
                    @endif

                </div>
                <a href="{{route('mail',['folder'=>$folder->folderName->name,'search'=>$search])}}" class="btn btn-white btn-sm"
                   data-toggle="tooltip"
                   data-placement="left"
                   title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh
                </a>
                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                        title="Mark as read"><i class="fa fa-eye"></i></button>
                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                        title="Mark as important"><i class="fa fa-exclamation"></i></button>
                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top"
                        title="Move to trash"><i class="fa fa-trash-o"></i></button>

            </div>
        </div>
        <div class="mail-box">

            <table class="table table-hover table-mail">
                <tbody>
                @forelse ($mails as $mail)
                    @if($mail->readed)
                        <tr class="read">
                    @else
                        <tr class="unread">
                            @endif
                            <td class="check-mail">
                                <input type="checkbox" class="i-checks">
                            </td>
                            <td class="mail-contact">
                                <a href="{{route('view',['mail'=>$mail->id])}}">{{$mail->e_mail}}</a>
                            </td>
                            <td class="mail-subject">
                                <a href="{{route('view',['mail'=>$mail->id])}}">{{$mail->subject}}</a>
                            </td>
                            <td class="">@empty(!$mail->rosters)<i class="fa fa-paperclip">@endempty</i></td>
                            <td class="text-right mail-date">{{$mail->hourHumans()}}</td>
                        </tr>
                        @empty
                            <tr class="unread">
                                <td class="mailbox-content" colspan="4">
                                    No hay mensajes
                                </td>
                            </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection