<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function index()
    {
        return view('admin.layouts.home')->with(['tittle' => 'pruebas']);
    }

    public function users()
    {
        $users = User::where('prioridad', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.users')->with([
            'tittle' => 'pruebas',
            'users' => $users
        ]);
    }

    public function show($id)
    {
        dd($id);
        return view('admin.users')->with(['tittle' => 'pruebas']);
    }

    public function counts()
    {
        $users = User::where('prioridad', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.counts')->with(['tittle' => 'pruebas', 'users' => $users]);
    }

    public function count($id)
    {
        $user = User::find($id);
        if (is_null($user))
            return redirect()->route('admin.counts.index');
        return view('admin.count')->with(['tittle' => 'pruebas', 'user' => $user]);
    }

    public function user($id)
    {
        $user = User::find($id);
        if (is_null($user))
            return redirect()->route('admin.users.index');
        return view('admin.user')->with(['tittle' => 'pruebas', 'user' => $user]);
    }

}
