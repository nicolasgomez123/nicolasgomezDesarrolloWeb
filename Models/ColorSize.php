<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";

    //relacion uno a muchos inversa
    public function color(){
        return $this->BelongsTo(Color::class);
    }

    //relacion uno a muchos inversa
    public function size(){
        return $this->BelongsTo(Size::class);
    }
}
