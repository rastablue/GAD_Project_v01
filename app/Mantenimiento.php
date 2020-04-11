<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Mantenimiento extends Model
{

    public function trabajos(){

        return $this->hasMany(Trabajo::class);

    }

    public function maquinarias(){

        return $this->belongsTo(Maquinaria::class, 'maquinaria_id');

    }

    public function getUrlPathAttribute(){
        return \Storage::url($this->path);
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
