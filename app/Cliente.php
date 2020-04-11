<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    public function solicituds(){

        return $this->hasMany(Solicitud::class);

    }

}
