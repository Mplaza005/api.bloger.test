<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const BOORADOR =1;
    const PUBLICADO=2;

     //relacion uno a muchos inversa

    public function user(){
       return  $this->BelongsTo(User::class);
    }
    public function category(){
       return $this->BelongsTo(Category::class);
    }

    //Relacion uno a muchos polimorfica
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }


}
