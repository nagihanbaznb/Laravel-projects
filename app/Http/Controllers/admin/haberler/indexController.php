<?php

namespace App\Http\Controllers\admin\haberler;
use App\Haber;
use App\Helper\imageUpload;
use App\Helper\mHelper;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        $data = Haber::paginate(10);
        return view('admin.haberler.index',['data'=>$data]);
    }
    public function create()
    {
        return view('admin.haberler.create');
    }

    public function store(Request $request)
    {
        $all = $request->except('_token'); //formdan gelen verileri alıyor
        $all['selflink'] = mHelper::permalink($all['name']); //selflinki ayarlar
        $all['image'] = imageUpload::singleUpload(rand(1,9000), "haberler",$request->file('image'));

        $insert = Haber::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Haber başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Haber eklenemedi.');
        }
    }

    public function edit($id)
    {
        //kontrol
        $c = Haber::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Haber::where('id','=',$id)->get(); //bilgileri al
            return view('admin.haberler.edit',['data'=>$data]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    // güncelleme yaparken resmi silmemesi için
    public function update(Request $request)
    {
        $id = $request->route('id');
        $c = Haber::where('id','=',$id)->count();
        if($c!=0)
        {
            $data = Haber::where('id','=',$id)->get();
            $all = $request->except('_token'); //formdan gelen verileri alıyor
            $all['selflink'] = mHelper::permalink($all['name']); //isim değişirse selflink de değişir
            $all['image'] = imageUpload::singleUploadUpdate(rand(1,9000),"haberler",$request->file('image'),$data,"image");
            $update = Haber::where('id','=',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Haber başarıyla düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Haber düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = Haber::where('id','=',$id)->count();
        if($c!=0)
        {
            $w = Haber::where('id','=',$id)->get();
            File::delete('public/'.$w[0]['image']); //resmi siler
            Haber::where('id','=',$id)->delete(); //yazar siler
            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }
}
