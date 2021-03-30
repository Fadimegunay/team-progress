@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Görev Listesi</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="">Görev</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Listesi</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Görevler</header>
                    </div>
                    <div class="card-body " id="bar-parent">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            {{ session()->forget('message') }}
                        @endif
                        @can('access', 'task-new')
                        <a class="btn btn-primary btn-outline btn-input" href="{{ route('tasks.create') }}">YENİ Oluştur</a>
                        @endcan
                        <div style="margin-top: 15px;">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0" >
                                    <thead>
                                        <tr>
                                            <th>Takım</th>
                                            <th>Başlatan</th>
                                            <th>Başlık</th>
                                            <th>Durumu</th>
                                            <th>Başlangıç Tarihi</th>
                                            <th>Bitiş Tarihi</th>
                                            <th>İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                        @foreach($tasks as $item)
                                        <tr>
                                            <td>{{ $item->team->name }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->header }}</td>
                                            <td>{{$item->status->status}}</td>
                                            <td>{{ date('d.m.Y',strtotime($item->created_at)) }}</td>
                                            <td>{{ date('d.m.Y',strtotime($item->end_date)) }} </td>
                                            <td>
                                                @can('access', 'task-show')
                                                <a class="btn btn-warning btn-xs" href="{{ route('tasks.show',['task' => $item->id]) }}"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('access', 'task-edit')
                                                <a class="btn btn-primary btn-xs" href="{{ route('tasks.edit',['task' => $item->id]) }}"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('access', 'task-delete')
                                                <a class="btn btn-danger btn-xs task-delete" data-id="{{ $item->id }}" href="#"><i class="fa fa-trash-o"></i></a>
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
                               {{$tasks->links()}}
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