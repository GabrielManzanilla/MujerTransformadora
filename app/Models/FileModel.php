<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FileModel extends Model
{
    //
    use HasUuids;
    protected $table = 'tb_files';
    protected $primaryKey = 'pk_file_id';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'fk_uuid',
        'fk_origin',
        'str_path_archivo',
        'str_categoria_archivo',
        'str_nombre_archivo',
    ];

    public function fileable(){
        return $this->morphTo();
    }
}
