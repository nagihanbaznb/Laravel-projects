@extends('layouts.admin')
@section('content')

<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                        <a href="{{route('admin.kitap.create')}}" class="btn btn-success">Yeni Kitap Ekle</a>
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Kitap Listesi</h4>
                                    <p class="category">Burada eklenen kitapların listesini bulabilirsiniz.</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                            <th>İsim</th>
                                            <th>Yazar</th>
                                            <th>Yayın Evi</th>
                                            <th>Resim</th>
                                            <th>Düzenle</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Controllerdan gelen data -->
                                            @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{$value['name']}}</td>
                                                <td>{{\App\Yazarlar::getField($value['yazarid'],"name")}}</td>
                                                <td>{{\App\YayinEvi::getField($value['yazarid'],"name")}}</td>
                                                <td><img src="{{asset($value['image'])}}" style="width: 120px; height: 120px;" alt=""></td>
                                                <td><a href="{{route('admin.kitap.edit',['id'=>$value['id']])}}">Düzenle</a></td>
                                                <td><a href="{{route('admin.kitap.delete',['id'=>$value['id']])}}">Sil</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- sayfalamaların tasarımı -->
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
</div>
@endsection
