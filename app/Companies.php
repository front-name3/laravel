<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    Public function products()
  {
    //  Productsモデルのデータを引っ張てくる
    return $this->hasOne('App\Products');
  }
}
