@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Takım Listesi</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="">Takım</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Listesi</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Takımlar</header>
                    </div>
                    <div class="card-body " id="bar-parent">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            {{ session()->forget('message') }}
                        @endif
                        @can('access', 'team-new')
                        <a class="btn btn-primary btn-outline btn-input" href="{{ route('teams.create') }}">Yeni Oluştur</a>
                        @endcan
                        <div style="margin-top: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0" >
                                    <thead>
                                        <tr>
                                            <th>Takım Adı</th>
                                            <th>İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @foreach($teams as $team)
                                        <tr>
                                            <td>{{$team->name}}</td>
                                            <td>
                                                @can('access', 'team-edit')
                                                <a class="btn btn-primary btn-xs" href="{{ route('teams.edit',['team' => $team->id]) }}"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('access', 'team-delete')
                                                <a class="btn btn-danger btn-xs team-delete" data-id="{{ $team->id }}" href="#"><i class="fa fa-trash-o"></i></a>
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
                               {{$teams->links()}}
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