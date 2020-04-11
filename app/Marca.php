<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{

    public function maquinarias(){

        return $this->hasMany(Maquinaria::class);

    }

}
