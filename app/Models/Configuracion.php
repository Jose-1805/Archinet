<?php

namespace Archinet\Models;

use Archinet\User;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = "configuraciones";

    protected $fillable = [
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}