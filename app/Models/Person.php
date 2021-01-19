<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $primaryKey = 'id';
    //Llenar todos los campos con formulario
    protected $fillable = [
        'cui',
        'identification_card',
        'name',
        'last_name',
        'birthdate',
        'address',
        'phone',
        'department',
        'township',
        'email',
        'picture',
        'password',
    ];
    //Relación uno a uno
    public function request()
    {
        return $this->hasOne(Request::class);
    }
}
