<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = ['comment', 'rating', 'user_id', 'product_id' ];

    //relacion uno a muchos inversa entr user y review
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion uno a muchos inversa entre review y product
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
