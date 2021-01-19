<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    //Relación uno a uno
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
