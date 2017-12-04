<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folder_name_id',
        'user_id',
    ];

    public $timestamps = false;


    public function folderName()
    {
        return $this->belongsTo(FolderName::class);
    }

    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }

    public function folderMails()
    {
        return $this->hasMany(folderMails::class);
    }
}
