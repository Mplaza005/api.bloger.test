<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $fillable = ['name']; //Campos que se van a asignacion masiva:


    //relacion uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function scopeIncluded(Builder $query)
    {

        $relations = explode(',', request('included'));

        $query->with($relations); //se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

    }




}
