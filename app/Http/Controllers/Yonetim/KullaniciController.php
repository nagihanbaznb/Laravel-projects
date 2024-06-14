<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KullaniciController extends Controller
{
    public function giris()
    {

        if (request()->isMethod('POST'))
        {
            $this->validate(request(), [
                'email' => 'required|email',
                'password'=> 'required'
            ]);

            $credentials = [
                'email'=> request()->get('email'),
                'password'=> request()->get('password'),
                'permission' => 1
            ];
            if(auth()->attempt($credentials, request()->has('benihatirla')))
            {
                return redirect()->route('admin.index');
            }
            else
            {
                return back()->withInput()->withErrors(['email'=>'Giriş hatalı']);
            }

        }
        return view('yonetim.giris');
    }
}
