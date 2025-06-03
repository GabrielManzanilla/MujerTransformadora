<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PerfilUsuario extends Model
{
    //
    use HasUuids;

    protected $table = 'tb_perfiles';
    protected $primaryKey = 'pk_perfil_id';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'str_nombre',
        'str_apellido_paterno',
        'str_apellido_materno',
        'dt_fecha_nacimiento',
        'str_curp',
        'str_municipio_nacimiento',
        'str_estado_nacimiento',
        'str_sexo',
        'bool_es_mayahablante',
        'str_telefono',
    ];
    protected $casts = [
        'dt_fecha_nacimiento' => 'date',
        'bool_es_mayahablante' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function files()
    {
        return $this->morphMany(FileModel::class, 'fileable');
    }
}
