<?php
/**
 * Created by PhpStorm.
 * User: jose1805
 * Date: 1/04/18
 * Time: 05:14 PM
 */

namespace Archinet\Observers;


use Archinet\Models\Log;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    public function created($model)
    {
        $user_id = null;
        if(Auth::check())$user_id = Auth::user()->id;

        $data = [
            'tipo' => 'Crear',
            'estado' => 'realizado',
            'tabla_relacionada' => $model->getTable(),
            'tabla_relacionada_id' => $model->id,
            'descripcion' => 'Inserción de un registro en la tabla '.$model->getTable(),
            'clase' => get_class($model),
            'user_id' => $user_id,
        ];

        Log::create($data);
    }

    public function saved($model)
    {
        $user_id = null;
        if(Auth::check())$user_id = Auth::user()->id;

        $data = [
            'tipo' => 'Editar',
            'estado' => 'realizado',
            'tabla_relacionada' => $model->getTable(),
            'tabla_relacionada_id' => $model->id,
            'descripcion' => 'Edición de un registro en la tabla '.$model->getTable(),
            'clase' => get_class($model),
            'user_id' => $user_id,
        ];

        Log::create($data);
    }

    public function updated($model)
    {
        $user_id = null;
        if(Auth::check())$user_id = Auth::user()->id;
        $data = [
            'tipo' => 'Editar',
            'estado' => 'realizado',
            'tabla_relacionada' => $model->getTable(),
            'tabla_relacionada_id' => $model->id,
            'descripcion' => 'Edición de un registro en la tabla '.$model->getTable(),
            'clase' => get_class($model),
            'user_id' => $user_id,
        ];

        Log::create($data);
    }

    public function deleted($model)
    {
        $user_id = null;
        if(Auth::check())$user_id = Auth::user()->id;

        $data = [
            'tipo' => 'Eliminar',
            'estado' => 'realizado',
            'tabla_relacionada' => $model->getTable(),
            'tabla_relacionada_id' => $model->id,
            'descripcion' => 'Eliminado de un registro en la tabla '.$model->getTable(),
            'clase' => get_class($model),
            'user_id' => $user_id,
        ];

        Log::create($data);
    }
}
