@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Kullanıcı Listesi</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="">Kullanıcı</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Listesi</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Kullanıcılar</header>
                    </div>
                    <div class="card-body " id="bar-parent">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            {{ session()->forget('message') }}
                        @endif
                        @can('access', 'users-new')
                        <a class="btn btn-primary btn-outline btn-input" href="{{ route('users.create') }}">YENİ Oluştur</a>
                        @endcan
                        <div style="margin-top: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0" >
                                    <thead>
                                        <tr>
                                            <th>Takım Adı</th>
                                            <th>Ad Soyad</th>
                                            <th>Mail Adresi</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @foreach($users as $user)
                                        <tr>
                                            @if(isset($user->team_id))
                                            <td>{{$user->team->name}}</td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @can('access', 'users-edit')
                                                <a class="btn btn-primary btn-xs" href="{{ route('users.edit',['user' => $user->id]) }}"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('access', 'users-delete')
                                                <a class="btn btn-danger btn-xs users-delete" data-id="{{ $user->id }}" href="#"><i class="fa fa-trash-o"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="center">
                            <div class="pagination">
                               {{$users->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script type='text/javascript' src="{{ asset('js/delete.js') }}"></script>
@endsection