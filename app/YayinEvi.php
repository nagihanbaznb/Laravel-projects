<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YayinEvi extends Model
{
    protected $guarded = []; // tüm alanlara erişim sağlayacak. Yazılan kodda belirtilmemiş kısımlar da eklenir

    static function getField($id,$field)
    {
        $c = YayinEvi::where('id','=',$id)->count();
        if($c!=0)
        {
            $w = YayinEvi::where('id','=',$id)->get();
            return $w[0][$field];
        }
        else
        {
            return "Silinmiş Yayın Evi";
        }
    }
}
