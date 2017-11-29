@extends('layouts.mail')

@section('css')
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

@endsection
@section('more')
    <div class="col-lg-9 animated fadeInRight">
        <div class="mail-box-header">

            <form method="get" action="index.html" class="pull-right mail-search">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" name="search"
                           placeholder="Search email">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Search
                        </button>
                    </div>
                </div>
            </form>
            <h2>
                Inbox (16)
            </h2>
            <div class="mail-tools tooltip-demo m-t-md">
                <div class="btn-group pull-right">
                    <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                    <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                </div>
                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left"
                        title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh
                </button>
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
                <tr class="unread">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">Anna Smith</a></td>
                    <td class="mail-subject"><a href="mail_detail.html">Lorem ipsum dolor noretek imit
                            set.</a></td>
                    <td class=""><i class="fa fa-paperclip"></i></td>
                    <td class="text-right mail-date">6.10 AM</td>
                </tr>
                <tr class="read">
                    <td class="check-mail">
                        <input type="checkbox" class="i-checks">
                    </td>
                    <td class="mail-ontact"><a href="mail_detail.html">Facebook</a> <span
                                class="label label-warning pull-right">Clients</span></td>
                    <td class="mail-subject"><a href="mail_detail.html">Many desktop publishing packages and
                            web page editors.</a></td>
                    <td class=""></td>
                    <td class="text-right mail-date">Jan 16</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <!--    <script src="{{ asset('js/app.js') }}"></script>
-->

@endsection
