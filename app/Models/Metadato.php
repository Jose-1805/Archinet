<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class Metadato extends Model
{
    protected $table = "metadatos";
    public $timestamps = false;

    protected $fillable = [
    ];

    public function documento(){
        return $this->belongsTo(Documento::class,'documento_id');
    }
}
