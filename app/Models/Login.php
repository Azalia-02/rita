<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;  

class Login extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    protected $table = 'tb_login';
    protected $primaryKey = 'id';
    protected $fillable =  [
        'nombre',
        'apellido',
        'email',
        'password',
        'rol',
    ];
}
