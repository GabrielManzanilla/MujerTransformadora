<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class DatosFiscales extends Model
{
    use HasUuids;
    protected $table = 'tb_datos_fiscales';
    protected $primaryKey = 'pk_dato_fiscal';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = true;
    protected $fillable = [
        'fk_user',
        'str_regimen',
        'str_actividad_economica',
        'str_nombre_comercial',
        'int_numero_empleados',
        'str_razon_social',
        'str_clave_imss',
        'str_clave_impi',
        'str_clave_affy',
        'str_clave_sat',
        'str_clave_cif',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user', 'id');
    }
    
    // public function files()
    // {
    //     return $this->morphMany(FileModel::class, 'fileable');
    // }
    // public function domicilios()
    // {
    //     return $this->hasMany(Domicilio::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    // }
    // public function productos()
    // {
    //     return $this->hasMany(Producto::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    // }
    // public function redesSociales()
    // {
    //     return $this->hasMany(RedSocial::class, 'fk_dato_fiscal', 'pk_dato_fiscal');
    // }

}
