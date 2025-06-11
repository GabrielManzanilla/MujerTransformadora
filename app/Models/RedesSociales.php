<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RedesSociales extends Model
{
    //
    use HasUuids;
    protected $table = 'tb_redes_sociales';
    protected $primaryKey = 'pk_redes_sociales';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'fk_dato_fiscal',
        'str_nombre_red_social',
        'str_perfil_red_social',
        'str_url_red_social'
    ];

    public function datoFiscal()
    {
        return $this->belongsTo(DatosFiscales::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    }
}
