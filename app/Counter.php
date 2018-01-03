<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'user_id', 'place',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hourHumans()
    {
        Carbon::setLocale('es');
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}
