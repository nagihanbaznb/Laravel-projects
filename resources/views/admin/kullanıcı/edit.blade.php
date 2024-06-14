@extends('layouts.admin')
@section('content')

<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session("status"))
                            <div class="alert alert-primary"  role="alert">
                                {{session("status")}}
                            </div>
                            @endif

                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Kullanıcı Düzenle</h4>
                                    <p class="category">{{$data[0]['name']}}</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('admin.kullanıcı.edit.post',['id'=>$data[0]['id']])}}" method="POST">
                                    {{csrf_field()}} <!--Post işleminin gerçekleşmesi için-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <input type="text" value="{{$data[0]['name']}}" name="name" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <input type="text" value="{{$data[0]['email']}}" name="email" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <input type="text" value="{{$data[0]['password']}}" name="password" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">

                                                    <select name="permission" value="{{$data[0]['permission']}}" class="form-control">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Kullanıcı Düzenle</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection
