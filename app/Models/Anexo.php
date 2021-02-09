<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table = "anexos";

    protected $fillable = [
    ];

    public function documentos(){
        return $this->hasMany(Documento::class,'anexo_id');
    }

    public function archivo(){
        return $this->belongsTo(Archivo::class,'archivo_id');
    }
}
