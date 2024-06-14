<?php
namespace App\Helper;

use Illuminate\Support\Facades\Session;

class sepetHelper
{
    static function add($id,$fiyat,$image,$name)
    {
        $sepet = Session::get('basket');
        // aynı üründen ekleme sepette var mı yok mu
        $array = [
            'id'=>$id,
            'name'=>$name,
            'image'=>$image,
            'fiyat'=>$fiyat
        ];
        Session::put('basket.'.rand(1,9000),$array); //aynı id ile ekleyince silmemesi için random sayı
    }
    //silme işlemi için
    static function remove($id)
    {
        $s = Session::get('basket');
        Session::forget('basket.'.$id);
    }

    //sepette kaç ürün var
    static function countData()
    {
        return count(Session::get('basket'));
    }

    static function allList()
    {
        $x = Session::get('basket');
        return $x;
    }

    static function totalPrice()
    {
        $data = self::allList();
        return collect($data)->sum('fiyat');
    }
}
