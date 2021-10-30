<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //Al se muchos cammpos utilizamos la variable $guarde para seleccionar los campos que no queremos que se incluyan en la Asignacion masiva de campos
    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];//campos que no queremos cambiar


    //status del producto o orden
    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;

    //relacion entre modelos

    //relacion uno a muchos inversa entre departamentos y ordenes
    public function department(){
        return $this->belongsTo(Department::class);
    }

    //relacion uno a muchos inversa entre ciudades y ordenes
    public function city(){
        return $this->belongsTo(City::class);
    }

    //relacion uno a muchos inversa entre distritos y ordenes
    public function district(){
        return $this->belongsTo(District::class);
    }

    //relacion uno a muchos inversa entre usuarios y ordenes
    public function user(){
        return $this->belongsTo(User::class);
    }
}
