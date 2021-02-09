<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumental extends Model
{
    protected $table = "tipos_documentales";

    protected $fillable = [
    ];

    public function seccion(){
        return $this->belongsTo(Seccion::class,'seccion_id');
    }

    public function documentos(){
        return $this->hasMany(Documento::class,'tipo_documental_id');
    }
}
