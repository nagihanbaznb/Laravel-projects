<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kitaplar extends Model
{
    protected $guarded = [];  // tüm alanlara erişim sağlayacak.  Yazılan kodda belirtilmemiş kısımlar da eklenir
}
