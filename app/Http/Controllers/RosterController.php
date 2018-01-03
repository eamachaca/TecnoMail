<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Folder;
use App\Http\Requests\RosterRequest;
use App\Roster;
use Illuminate\Support\Facades\Auth;

class RosterController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = Folder::find($id);
        if (is_null($folder) && $folder->user->id != Auth::user()->id)
            return redirect()->route('folder.index');

        $counter = Counter::where('user_id', Auth::user()->id)->where('place', 'rosterView')->first();
        if (is_null($counter)) {
            $counter = Counter::create([
                'user_id' => Auth::user()->id,
                'place' => 'rosterView'
            ]);
        }
        $counter->quantity++;
        $counter->save();
        return view('mail.roster.index')->with([
            'folder' => $folder,
            'folders' => Auth::user()->folders,
            'tittle' => __('Rosters'),
            'count'=>$counter->quantity
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RosterRequest $request)
    {
        $folder = Folder::find($request->folder);
        if (!is_null($folder) && $folder->user->id === $request->user()->id) {
            $roster = Roster::find($request->id);
            if (is_null($request->id) || intval($request->id)===0) {
                $roster = new Roster();
                $roster->user_id = $request->user()->id;
                $roster->folder_id = $request->folder;
            }
            if ($roster->user->id == $request->user()->id) {
                $roster->is_mail = $request->has('rules');
                $roster->data = $request->name;
                $roster->save();
            }
            return redirect()->back();
        }
        return redirect()->route('folder.index');
    }
}
