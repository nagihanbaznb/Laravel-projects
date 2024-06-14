<?php

namespace App\Http\Controllers\front\haber;

use App\Haber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index($selflink)
    {
        $c = Haber::where('selflink','=',$selflink)->count();
        if($c!=0)
        {
            $w = Haber::where('selflink','=',$selflink)->get();
            return view('front.haber.index',['data'=>$w]);
        }
        else
        {
            return redirect('/');
        }
    }
}
