<?php

namespace App\Http\Controllers\admin\kitap;
use App\Helper\imageUpload;
use App\Helper\mHelper;
use App\Kategoriler;
use App\Kitaplar;
use App\Yazarlar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\YayinEvi;
use File;

class indexController extends Controller
{
    public function index()
    {
        $data = Kitaplar::paginate(10);
        return view('admin.kitap.index',['data'=>$data]);

    }

    public function create()
    {
        // diğer veritabanları için
        $yazar = Yazarlar::all();
        $yayinevi = YayinEvi::all();
        $kategori = Kategoriler::all();
        return view('admin.kitap.create',['yazar'=>$yazar,'yayinevi'=>$yayinevi,'kategori'=>$kategori]);

    }

    public function store(Request $request)
    {
        $all = $request->except('_token'); //formdan gelen verileri çekiyor
        $all['selflink'] = mHelper::permalink($all['name']);
        $all['image'] = imageUpload::singleUpload(rand(1,9000),"kitap",$request->file('image')); // resim yükleme işlemi

        $insert = Kitaplar::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Kitap başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Kitap eklenemedi.');
        }
    }

    public function edit($id)
    {
        $c = Kitaplar::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Kitaplar::where('id','=',$id)->get(); //bilgileri al
            $yazar = Yazarlar::all();
            $yayinevi = YayinEvi::all();
            $kategori = Kategoriler::all();
            return view('admin.kitap.edit',['data'=>$data,'yazar'=>$yazar,'yayinevi'=>$yayinevi,'kategori'=>$kategori]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Kitaplar::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Kitaplar::where('id','=',$id)->get(); //bilgileri al
            $all = $request->except('_token'); //post ile gelen tüm verileri çeker
            $all['selflink'] = mHelper::permalink($all['name']);
            $all['image'] = imageUpload::singleUploadUpdate(rand(1,9000),"kitap",$request->file('image'),$data,"image");
            $update = Kitaplar::where('id','=',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Kitap başarıyla düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Kitap düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {

        $c = Kitaplar::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Kitaplar::where('id','=',$id)->get(); //bilgileri al
            File::delete('public/'.$data[0]['image']);
            Kitaplar::where('id','=',$id)->delete();
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }
}
