<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $fillable = ['ci', 'nombre', 'apellido', 'email', 'celular', 'direccion', 'password'];
    public $timestamps = true;
}
