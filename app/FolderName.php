<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FolderName extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'folders');
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
