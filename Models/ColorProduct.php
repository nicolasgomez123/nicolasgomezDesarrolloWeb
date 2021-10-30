<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = "color_product";

    //llaves foraneas

    //relacion uno a muchos inversa
    public function color(){        //se llama a la clase o modelo
        return $this->BelongsTo(Color::class);
    }

     //relacion uno a muchos inversa
    public function product(){
        return $this->BelongsTo(Product::class); 
    }

}
