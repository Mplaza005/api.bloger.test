<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     public function imagiable(){
        return $this->morptTo();
    }
}
