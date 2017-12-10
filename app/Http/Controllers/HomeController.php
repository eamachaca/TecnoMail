<?php

namespace App\Http\Controllers;


use App\EMail;
use App\FolderMail;
use App\Http\Requests\MailRequest;
use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail as Ml;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail()
    {
        $folders = Auth::user()->folderNames;
        $input = Input::get('folder');
        if (!$folder = $folders->where('name', $input)->first()) {
            $folder = $folders->where('name', 'inbox')->first();
        }
        $folder = $folder->folders->where('user_id', Auth::user()->id)->first();
        $mails = FolderMail::where('folder_id', $folder->id);
        $search = null;
        if (!is_null(Input::get('search')) && !empty(trim(Input::get('search')))) {
            $search = Input::get('search');
            $mails->where(function ($query) use ($search) {
                $query->where('e_mail', 'LIKE', "%$search%")->orWhere('subject', 'LIKE', "%$search%");
            });
        }
        $mails = $mails->orderBy('created_at', 'desc')->paginate(10);
        $previous = str_replace('?', '?folder=' . $folder->folderName->name . '&', $mails->previousPageUrl());
        $next = str_replace('?', '?folder=' . $folder->folderName->name . '&', $mails->nextPageUrl());
        if (!is_null($search)) {
            $next = str_replace('?', '?search=' . $search . '&', $next);
            $previous = str_replace('?', '?search=' . $search . '&', $previous);
        }
        return view('mail')->with([
            'folders' => Auth::user()->folders,
            'folder' => $folder,
            'mails' => $mails,
            'previous' => $previous,
            'next' => $next,
            'search' => $search
        ]);
    }

    public function compose()
    {
        $forward_subject = null;
        $forward_text = null;
        $reply_to = null;
        if (count(Input::get()) === 0 || (count(Input::get()) === 1 && (Input::has('forward') || Input::has('reply')))) {
            if (count(Input::get()) == 1) {
                $id = array_values(Input::get())[0];
                $mail = Mail::find($id);
                if (!is_null($mail) && $mail->user_id === Auth::id()) {
                    if (Input::has('forward')) {
                        $forward_text = $mail->body;
                        $forward_subject = $mail->subject;
                    } else
                        $reply_to = $mail->eMail->e_mail;

                } else {
                    return redirect()->route('compose');
                }
            }
            return view('compose')->with([
                'folders' => Auth::user()->folders,
                'subject' => $forward_subject,
                'to' => $reply_to,
                'body' => $forward_text
            ]);
        }
        return redirect()->route('compose');
    }

    public function view()
    {
        $id = Input::get('mail');
        $mailF = FolderMail::find($id);
        if ($mailF !== null && $mailF->folder->user->id === Auth::user()->id) {
            if (!$mailF->readed) {
                $mailF->readed = 1;
                $mailF->save();
                $mailF->folder->readed--;
                $mailF->folder->save();
            }
            return view('view')->with([
                'folders' => Auth::user()->folders,
                'mail' => $mailF->mail,
            ]);;
        }
        return redirect()->route('mail');
    }

    public function send(MailRequest $request)
    {
        $only = $request->only(['email', 'subject', 'body']);
        $message = '';
        if (!is_null($only['body']))
            $message = $only['body'];
        if (empty($message)) {
            $html = new \DOMDocument('1.0', 'ISO-8859-1');
            @$html->loadHTML($message);
            $message = $html->saveHTML();
        }
        $eMail = EMail::where('e_mail', $only['email'])->first();
        if (is_null($eMail)) {
            $eMail = EMail::create(['e_mail' => $only['email'], 'name' => 'Nombre Desconocido']);
        }
        $mail = Mail::create([
            'subject' => $only['subject'],
            'body' => $message,
            'sended' => true,
            'readed' => true,
            'user_id' => $request->user()->id,
            'e_mail_id' => $eMail->id,

        ]);
        //Ml::to($eMail->e_mail)->send(new Mail\All($mail));
        Ml::send('emails.all', ['mail' => $mail], function ($message) use ($mail, $eMail) {
            $message->to($eMail->e_mail, $eMail->name)->subject
            ($mail->body);
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        dd('no quiero terminar xD');
    }
}
