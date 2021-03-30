@extends('layouts.home.app')
@section('styles')
<link href="{{ asset('css\home.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Anasayfa</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                </ol>
            </div>
        </div>
        <!-- end widget -->
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Atanan Görevler</header>
                        
                    </div>
                    <div class="card-body ">
                      <div class="table-wrap">
                            <div class="table-responsive tblHeightSet">
                                <table class="table display product-overview mb-30" id="support_table">
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