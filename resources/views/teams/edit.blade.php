@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Takımlar</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="{{ route('teams.index') }}">Takım</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Güncelle</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel">
                    <div class="col-lg-12"> 
                        <h3 class="panel-heading">Takım Güncelle</h3>
                    </div>
                    <div class="panel-body">
                        @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                            {{ session()->forget('message') }}
                        @endif
                        <form action="{{ route('teams.update',['team' => $team->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" name="name" required value="{{$team->name}}">
                                        <label class="mdl-textfield__label">Takım Adı</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20"> 
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection