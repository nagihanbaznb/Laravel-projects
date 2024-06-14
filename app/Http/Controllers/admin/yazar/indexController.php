<?php

namespace App\Http\Controllers\admin\yazar;

use App\Yazarlar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\imageUpload;
use App\Helper\mHelper;
use File;

class indexController extends Controller
{
    public function index()
    {
        $data = Yazarlar::paginate(10);
        return view('admin.yazar.index',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.yazar.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token'); //formdan gelen verileri alıyor
        $all['selflink'] = mHelper::permalink($all['name']); //selflinki ayarlar
        $all['image'] = imageUpload::singleUpload(rand(1,9000), "yazar",$request->file('image')); //random isim atıyor ve images içinde yazar isimli dosyaya atıyor

        $insert = Yazarlar::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Yazar başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Yazar eklenemedi.');
        }
    }

    public function edit($id)
    {
        //kontrol
        $c = Yazarlar::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Yazarlar::where('id','=',$id)->get(); //bilgileri al
            return view('admin.yazar.edit',['data'=>$data]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    // güncelleme yaparken resmi silmemesi için helper a ekleme yap
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Yazarlar::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Yazarlar::where('id','=',$id)->get();
            $all = $request->except('_token'); //formdan gelen verileri alıyor
            $all['selflink'] = mHelper::permalink($all['name']); //isim değişirse selflink de değişir
            $all['image'] = imageUpload::singleUploadUpdate(rand(1,9000),"yazar",$request->file('image'),$data,"image");
            $update = Yazarlar::where('id','=',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Yazar başarıyla düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Yazar düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = Yazarlar::where('id','=',$id)->count();
        if($c!=0)
        {
            $w = Yazarlar::where('id','=',$id)->get();
            File::delete('public/'.$w[0]['image']); //resmi siler
            Yazarlar::where('id','=',$id)->delete(); //yazar siler
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }
}
