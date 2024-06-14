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
                                    <h4 class="title">Kullanıcı Ekle</h4>
                                    <p class="category">Kullanıcı Oluşturunuz.</p>
                                </div>
                                <div class="card-content">
                                    <form action="{{route('admin.kullanıcı.create.post')}}" method="POST">
                                    {{csrf_field()}} <!--Post işleminin gerçekleşmesi için-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Kullanıcı Adı:</label>
                                                    <input type="text" name="name" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">E-Mail:</label>
                                                    <input type="text" name="email" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Şifre:</label>
                                                    <input type="text" name="password" class="form-control">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Permission:</label>
                                                    <select name="permission" class="form-control">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Kullanıcı Ekle</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection

