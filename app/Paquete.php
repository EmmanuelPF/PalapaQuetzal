<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';
    protected $guarded = [];

    // protected $fillable=[
    //     "Nombre_Tienda",
    //     "Contrasena",
    //     "Encargado",
    //     "Pais",
    //     "Estado",
    //     "Colonia"
    // ];

    protected function CaracteristicasPaquete(){
        return $this->hasOne(Caracteristica_Paquete::class,'id', 'Caracteristicas_Id');
    }

}
 