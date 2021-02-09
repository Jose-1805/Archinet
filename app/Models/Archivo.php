<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = "archivos";

    protected $fillable = [
        'nombre',
        'ubicacion',
    ];

    public function urlAlmacen(){
        $ubicaion = str_replace('/','-',$this->ubicacion).'-'.$this->nombre;
        return url('almacen/'.$ubicaion);
    }
}
