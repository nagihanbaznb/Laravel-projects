<?php

namespace App\Http\Controllers\admin\yayinevi;

use App\Helper\mHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\YayinEvi;

class indexController extends Controller
{
    public function index()
    {
        //veri göndermek için indexe.paginate sayfalamayı otomatik yapar.
        $data = YayinEvi::paginate(10);
        return view("admin.yayinevi.index",["data"=>$data]);
    }
    public function create()
    {
        return view("admin.yayinevi.create"); //bu sayfayı çağırıyooruz
    }
    public function store(Request $request)
    {
        $all = $request->except('_token'); //formdan gelen verileri alıyor
        $all['selflink'] = mHelper::permalink($all['name']); //permalik all un içerisindeki name i selflink yapacak
// ekleme işlemi
        $insert = YayinEvi::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Yayın Evi Başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Yayın Evi eklenemedi.');
        }
    }
    public function edit($id)
    {
        //kontrol için
        $c = YayinEvi::where('id','=',$id)->count();
        if($c!=0) {
        $data = YayinEvi::where('id','=',$id)->get(); //bilgileri al
        return view('admin.yayinevi.edit',['data'=>$data]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id'); //routedan gelen id yi alıyor
        $c = YayinEvi::where('id','=',$id)->count();
        if($c!=0)
        {
            $all = $request->except('_token'); //formdan gelen verileri alıyor
            $all['selflink'] = mHelper::permalink($all['name']);
            $update = YayinEvi::where('id','=',$id)->update($all); // all=arraye göre update
            if($update)
            {
                return redirect()->back()->with('status','Yayın Evi düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Yayın Evi düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = YayinEvi::where('id','=',$id)->count();
        if($c!=0)
        {
            $delete = YayinEvi::where('id','=',$id)->delete();
            return redirect()->back();

        }
        else
        {
            return redirect('/');
        }
    }
}
