<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table = "secciones";

    protected $fillable = [
    ];

    public function tiposDocumentales(){
        return $this->hasMany(TipoDocumental::class,'seccion_id');
    }
}
