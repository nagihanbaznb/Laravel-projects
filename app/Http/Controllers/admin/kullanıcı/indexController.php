<?php

namespace App\Http\Controllers\admin\kullanıcı;
use Illuminate\Support\Str;
use App\Helper\mHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class indexController extends Controller
{
    public function index()
    {
        //veri göndermek için indexe.paginate sayfalamayı otomatik yapar.
        $data = User::paginate(10);
        return view("admin.kullanıcı.index",["data"=>$data]);
    }
    public function create()
    {
        return view("admin.kullanıcı.create"); //bu sayfayı çağırıyooruz
    }
    public function store(Request $request)
    { /*
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password')); //şifreyi gizliyor
        $user->permission = $request->input('permission');
        $user->save(['remember_token' => Str::random(60)]); */

        $all = $request->except('_token'); //formdan gelen verileri alıyor
        $all['remember_token'] = Str::random(60);
        $all['password'] = bcrypt($all['password']);

// ekleme işlemi
        $insert = User::create($all);
        if($insert)
        {
            return redirect()->back()->with('status','Kullanıcı Başarıyla eklendi.');
        }
        else
        {
            return redirect()->back()->with('status','Kullanıcı eklenemedi.');
        }
    }
    public function edit($id)
    {
        //kontrol için
        $c = User::where('id','=',$id)->count();
        if($c!=0) {
        $data = User::where('id','=',$id)->get(); //bilgileri al
        return view('admin.kullanıcı.edit',['data'=>$data]); //data olarak gönder
        }
        else
        {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $id = $request->route('id'); //routedan gelen id yi alıyor
        $c = User::where('id','=',$id)->count();
        if($c!=0)
        {
            $all = $request->except('_token'); //formdan gelen verileri alıyor

            $update = User::where('id','=',$id)->update($all); // all=arraye göre update
            if($update)
            {
                return redirect()->back()->with('status','Kullanıcı düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Kullanıcı düzenlenemedi.');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function delete($id)
    {
        $c = User::where('id','=',$id)->count();
        if($c!=0)
        {
            $delete = User::where('id','=',$id)->delete();
            return redirect()->back();

        }
        else
        {
            return redirect('/');
        }
    }
}
