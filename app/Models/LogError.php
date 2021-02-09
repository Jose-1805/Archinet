<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    protected $table = "logs_errors";

    protected $fillable = [
        'descripcion',
        'log_id',
    ];

    public function log(){
        return $this->belongsTo(Log::class,'log_id');
    }
}