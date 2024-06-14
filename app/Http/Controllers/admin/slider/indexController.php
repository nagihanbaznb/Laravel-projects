<?php

namespace App\Http\Controllers\admin\slider;

use App\Helper\imageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;

class indexController extends Controller
{
    public function index()
    {
        $data = Slider::paginate(10);
        return view('admin.slider.index',['data'=>$data]);
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $all['image'] = imageUpload::singleUpload(rand(1,9000),"slider",$request->file('image'));
        if($all['image']!="")
        {
            $insert = Slider::create($all);
            if($insert)
            {
                return redirect()->back()->with('status','Slider başarıyla eklendi.');
            }
            else
            {
                return redirect()->back()->with('status','Slider eklenemedi.');
            }
        }
        else
        {
            return redirect()->back()->with('status','Slider eklenemedi.');
        }

/*
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $imageName = rand(1, 9000) . '.' . $request->image->extension();
        $request->image->move(public_path('images/slider'), $imageName);

        $data = new Slider();
        $data->image = $imageName;

        if ($data->save()) {
            return redirect()->back()->with('status', 'Slider başarıyla eklendi.');
        } else {
            return redirect()->back()->with('status', 'Slider eklenemedi.');
        }
        */
    }

    public function edit($id)
    {
        $data = Slider::where('id','=',$id)->get();
        return view('admin.slider.edit',['data'=>$data]);
    }

    public function update(Request $request)
    {
        $id = $request->route('id');
        $data = Slider::where('id','=',$id)->get();
        $all['image'] = imageUpload::singleUploadUpdate(rand(1,9000),"slider",$request->file('image'),$data,"image");
        if($all['image']!="")
        {
            $insert = Slider::where('id','=',$id)->update($all);
            if($insert)
            {
                return redirect()->back()->with('status','Slider başarıyla düzenlendi.');
            }
            else
            {
                return redirect()->back()->with('status','Slider düzenlenemedi.');
            }
        }
        else
        {
            return redirect()->back()->with('status','Slider düzenlenemedi.');
        }
    }

    public function delete($id)
    {
        $data = Slider::where('id','=',$id)->delete();
        return redirect()->back();
    }
}
