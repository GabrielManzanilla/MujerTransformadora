<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domicilios extends Model
{
    //
    protected $table = 'tb_domicilios';
    protected $primaryKey = 'pk_domicilio';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'pk_domicilio',
        'fk_dato_fiscal',
        'str_direccion',
        'str_estado',
        'str_municipio',
        'str_localidad'
    ];

    public function datoFiscal()
    {
        return $this->belongsTo(DatosFiscales::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    }
}
