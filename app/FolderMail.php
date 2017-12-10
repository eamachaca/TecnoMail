<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FolderMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mail_id', 'folder_id', 'subject', 'e_mail', 'readed'];


    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function hourHumans()
    {
        Carbon::setLocale('es');
        return Carbon::parse($this->created_at)->diffForHumans();
    }

}
