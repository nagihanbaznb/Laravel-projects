<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class KullaniciController extends Controller
{
    public function giris()
    {
        if (request()->isMethod('POST')) //gelen istek post ise
        {
            $this->validate(request(), [ //email ve şifrenin boş olmadığını kontrol eder
                'email' => 'required|email',
                'password'=> 'required'
            ]);

            $credentials = [  //dizi olarak tanımlar giriş yapılacak değerler
                'email'=> request()->get('email'),
                'password'=> request()->get('password'),
                'permission' => 1
            ];
            //müsteri arayüzünden bağımsız giris. yani giriş yaptığında sitede giriş yapmaz
            if(Auth::guard('admin')->attempt($credentials, request()->has('benihatirla')))
            {
                return redirect()->route('admin.index');
            }
            else
            {
                return back()->withInput()->withErrors(['email'=>'E-mail veya şifre hatalı']);
            }

        }
        return view('admin.giris'); //view admin içinde giris
    }

    public function cikis()
    {
        Auth::guard('admin')->logout(); //adminle giriş yapılan giriş işlmeini sonlandır
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect('admin/giris');
    }
    
}
