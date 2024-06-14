@extends('layouts.admin')
@section('content')

<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('admin.kullanıcı.create')}}" class="btn btn-success">Yeni Kullanıcı Ekle</a>
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Kullanıcılar</h4>
                                    <p class="category">Burada eklenen Kullanıcılar listesini bulabilirsiniz.</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <tr>
                                            <th>İsim</th>
                                            <th>E-Mail</th>
                                            <th>Permission</th>
                                            <th>Düzenle</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Controllerdan gelen data -->
                                            @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{$value['name']}}</td>
                                                <td>{{$value['email']}}</td>
                                                <td>{{$value['permission']}}</td>
                                                <td><a href="{{route('admin.kullanıcı.edit',['id'=>$value['id']])}}">Düzenle</a></td>
                                                <td><a href="{{route('admin.kullanıcı.delete',['id'=>$value['id']])}}">Sil</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- sayfalamaların tasarımı paginate dediğimiz için -->
                                    {{$data->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
</div>
@endsection
