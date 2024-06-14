<?php

namespace App\Http\Controllers\admin\kategori;

use App\Helper\mHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kategoriler;
use Yajra\Datatables\Datatables;

class indexController extends Controller
{
    public function index()
    {
        //veri göndermek için indexe.paginate sayfalamayı otomatik yapar.
        $data = Kategoriler::paginate(10);
        return view("admin.kategori.index",["data"=>$data]);
    }
    public function create()
    {
        return view("admin.kategori.create"); //bu sayfayı çağırıyooruz
    }
    public function store(Request $request)
    {
        $all = $request->except('_token'); //formdan gelen verileri alıyor
        $all['selflink'] = mHelper::permalink($all['name']);
        $insert = Kategoriler::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Kategori Başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Kategori eklenemedi.');
        }
    }
    public function edit($id)
    {
        //kontrol için
        $c = Kategoriler::where('id','=',$id)->count();
        if($c!=0) {
        $data = Kategoriler::where('id','=',$id)->get(); //bilgileri al
        return view('admin.kategori.edit',['data'=>$data]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id'); //routedan gelen id yi alıyor
        $c = Kategoriler::where('id','=',$id)->count();
        if($c!=0)
        {
            $all = $request->except('_token'); //formdan gelen verileri alıyor
            $all['selflink'] = mHelper::permalink($all['name']);
            $update = Kategoriler::where('id','=',$id)->update($all);
            if($update)
            {
                return redirect()->back()->with('status','Kategori düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Kategori düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = Kategoriler::where('id','=',$id)->count();
        if($c!=0)
        {
            $delete = Kategoriler::where('id','=',$id)->delete();
            return redirect()->back();

        }
        else
        {
            return redirect('/');
        }
    }

}
