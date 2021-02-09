<?php

namespace Archinet\Models;

use Illuminate\Database\Eloquent\Model;

class CertificadoLaboral extends Model
{
    protected $table = "certificados_laborales";

    protected $fillable = [
        'anio',
        'consecutivo',
        'user_id'
    ];

    public static function ultimo($anio = false){
        if($anio)
            return CertificadoLaboral::where('anio',$anio)
                ->orderBy('created_at','DESC')->first();

        return CertificadoLaboral::orderBy('created_at','DESC')->first();
    }

    public static function siguiente(){
        $anio = date('Y');
        $consecutivo = 1;

        //ultimo certificado laboral del presente año
        $ultimo = CertificadoLaboral::ultimo($anio);

        if($ultimo){
            $consecutivo = $ultimo->consecutivo + 1;
        }

        if($consecutivo < 10)$consecutivo = '00'.$consecutivo;
        else if($consecutivo < 100)$consecutivo = '0'.$consecutivo;

        return new CertificadoLaboral(['anio'=>$anio, 'consecutivo'=>$consecutivo]);

    }
}
