<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mail_id', 'folder_id', 'subject', 'e_mail', 'readed'];
    public $timestamps = false;


    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

}
