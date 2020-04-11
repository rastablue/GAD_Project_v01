<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Solicitud extends Model
{

    public function tareas(){

        return $this->hasMany(Tarea::class);

    }

    public function users(){

        return $this->belongsTo(User::class, 'user_id');

    }

    public function clientes(){

        return $this->belongsTo(Cliente::class, 'cliente_id');

    }

    public static function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
          $v = trim( $value, "'" );
          $enum = Arr::add($enum, $v, $v);
        }
        return $enum;
    }

}
