<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Folder;
use App\FolderName;
use App\Http\Requests\FolderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counter = Counter::where('user_id', Auth::user()->id)->where('place', 'folderView')->first();
        if (is_null($counter)) {
            $counter = Counter::create([
                'user_id' => Auth::user()->id,
                'place' => 'folderView'
            ]);
        }
        $counter->quantity++;
        $counter->save();
        return view('mail.folder.index')->with([
            'folders' => Auth::user()->folders,
            'tittle' => __('Folders'),
            'count'=>$counter->quantity
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderRequest $request)
    {
        $folder = new Folder();
        if (!is_null($request->get('id')))
            $folder = Folder::find($request->get('id'));
        $fn = FolderName::firstOrCreate(['name' => $request->get('name')]);
        $folder->folder_name_id = $fn->id;
        $folder->user_id = $request->user()->id;
        $folder->save();
        return redirect()->route('folder.index');
    }
}
