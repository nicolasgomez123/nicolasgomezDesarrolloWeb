<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    const BORRADOR = 1;
    const PUBLICADO = 2;

    //asignacion maiva de los campos
    protected $guarded = ['id', 'created_at', 'updated_at'];

    //accesores

    public function getStockAttribute()
    {

        if ($this->subcategory->size) {
            return ColorSize::whereHas('size.product', //verifica la relacion con el modelo size y luego con el modelo product 
                function (Builder $query){ //me trae todos los objetos con builder y lo almacena en la variable query
                    $query->where('id', $this->id); //trae el id
                })->sum('quantity'); // suma el campo quantity
        
        } elseif ($this->subcategory->color) {
            return ColorProduct::whereHas('product', function (Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        
        } else {
            return $this->quantity;
        }
    }

    //relacion uno a muchos
    public function sizes(){
        return $this->hasMany(Size::class);
    }

    //relacion uno a muchos
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    //relacion uno a muchos inversa
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    //relacion uno a muchos inversa
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    //relacion muchos a muchos con la tabla users
    public function users(){
        return $this->belongsToMany(User::class);
    }

    //relacion muchos a muchos
    public function colors(){                                            //pivote rescata la informacion
        return $this->belongsToMany(Color::class)->withPivot('quantity', 'id');
    }

    //relacion uno a muchos polimorfica
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }


    //url amigables
    public function getRouteKeyName(){
        return 'slug';
    }
}
