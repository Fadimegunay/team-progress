@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Görev Detay</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="{{ route('tasks.index') }}">Görev</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Detay</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>{{$task->header}}</header>
                        <div class="pull-right">
                            @php  $color = ''; @endphp
                            @if($task->status->status == 'Yapılacak')
                            @php  $color = 'red'; @endphp
                            @elseif($task->status->status == 'Yapıldı')
                            @php  $color = 'rgb(63 81 181)'; @endphp
                            @elseif($task->status->status == 'Yapılıyor')
                            @php  $color = '#ffc107'; @endphp
                            @endif
                            <span style="background-color: {{$color}};
                                        color: white;
                                        margin: 8px;
                                        padding: 8px; ">
                                {{$task->status->status}}
                            </span>
                        </div>
                    </div>
                    <div class="card-body " id="bar-parent">
                        <div style="margin-top: 15px;">
                            <div class="form-group label-floating col-lg-12">
                                {!! $task->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <b> {{$task->user->name}}</b> tarafından <b>{{ date('d.m.Y',strtotime($task->created_at)) }} </b>tarihinde başlatıldı.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection