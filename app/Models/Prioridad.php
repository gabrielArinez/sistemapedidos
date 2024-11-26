<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;
    protected $table = 'prioridades';
    protected $primaryKey = 'id_prioridad';
    protected $fillable = ['prioridad'];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_prioridad', 'id_prioridad');
    }
}
