<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'e_mail', 'name',
    ];

    public $timestamps = false;

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }
}
