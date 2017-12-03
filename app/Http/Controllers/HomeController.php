<?php

namespace App\Http\Controllers;


use App\EMail;
use App\Folder;
use App\FolderMail;
use App\FolderName;
use App\Mail;
use App\Roster;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $mails = $mails->get();
        return view('mail')->with([
            'folders' => $folders,
            'folder'=>$folder->folderName->name,
            'mails' => $mails,
            'search' => $search
        ]);
    }

    public function compose()
    {
        $folders = Auth::user()->folderNames;
        return view('compose')->with([
            'folders' => $folders,
        ]);;
    }

    public function view()
    {
        $folders = Auth::user()->folderNames;
        return view('view')->with([
            'folders' => $folders,
        ]);;
    }
}
