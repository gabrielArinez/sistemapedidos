<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'id_promocion',
        'nombre',
        'precio',
        'stock',
        'disponible',
        'descripcion',
        'imagen'
    ];

    public function categoria_producto()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function promociones()
    {
        return $this->belongsTo(Promocion::class, 'id_promocion');
    }
}
