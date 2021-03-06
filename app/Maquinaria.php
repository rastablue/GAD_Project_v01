<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{

    public function tareas(){

        return $this->belongsToMany(Tarea::class)->withPivot('estado_tarea', 'operador_id', 'fecha_inicio', 'fecha_fin');

    }

    public function operarios(){

        return $this->belongsTo(Operario::class, 'operario_id');

    }

    public function mantenimientos(){

        return $this->hasMany(Mantenimiento::class);

    }

    public function marcas(){

        return $this->belongsTo(Marca::class, 'marca_id');

    }

}
