<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Productos extends Model
{
    //
    use HasUuids;
    protected $table = 'tb_productos';
    protected $primaryKey = 'pk_producto';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pk_producto',
        'fk_dato_fiscal',
        'str_nombre',
        'str_descripcion',
        'int_produccion_mensual',
        'double_ventas_mensuales',
        'double_ventas_anuales'
    ];

    public function datoFiscal()
    {
        return $this->belongsTo(DatosFiscales::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    }
}
