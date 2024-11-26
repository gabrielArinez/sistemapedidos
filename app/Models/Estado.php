<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    protected $fillable = ['estado'];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_estado', 'id_estado');
    }
}
