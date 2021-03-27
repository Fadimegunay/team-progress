@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Görevler</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                        <li><a class="parent-item" href="{{ route('tasks.index') }}">Görev</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                        <li class="active">Güncelle</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="panel">
                        <div class="col-lg-12"> 
                            <h3 class="panel-heading">Görev Güncelle</h3>
                        </div>
                        <div class="panel-body">
                            @if(session()->has('message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message') }}
                                </div>
                                {{ session()->forget('message') }}
                            @endif
                            <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if($authUser->is_super_admin == 1)
                                    <div class="form-group">
                                        <div class="col-lg-12"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label for="simpleFormEmail" style="color:rgb(180, 180, 180);">Takım</label>
                                                <select class="form-control" name="team" id="team" disabled>
                                                    @foreach($teams as $team)
                                                    @php $check = ""; @endphp
                                                    @if($task->team_id == $team->id)
                                                    @php $check = "selected"; @endphp
                                                    @endif
                                                    <option {{$check}} value="{{$team->id}}">{{$team->name}} </option>
                                                    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="team" id=team value="{{$authUser->team_id}}" />
                                @endif
                                <div class="form-group">
                                    <div class="col-lg-12"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label for="simpleFormEmail" style="color:rgb(180, 180, 180);">Kullanıcılar</label>
                                            <select class="  form-control " multiple id="users" name="users[]">
                                                @foreach($users as $user)
                                                    @php $check = ""; @endphp
                                                    @foreach($task->users as $item)
                                                        @if($user->id == $item->id)
                                                            @php $check = "selected"; @endphp
                                                        @endif
                                                    @endforeach
                                                    <option {{ $check }} value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-12"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label for="simpleFormEmail" style="color:rgb(180, 180, 180);">Görev Durumu</label>
                                            <select class="form-control" name="task_status" required>
                                                @foreach($taskStatus as $status)
                                                    @php $check = ""; @endphp
                                                    @if($status->id == $task->task_status_id)
                                                        @php $check = "selected"; @endphp
                                                    @endif
                                                <option {{$check}} value="{{$status->id}}">{{$status->status}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12"> 
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="header" value="{{$task->header}}" required>
                                            <label class="mdl-textfield__label">Başlık</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating col-lg-12">
                                    <label for="simpleFormEmail" style="color:rgb(180, 180, 180);">Açıklama</label>
                                </div>
                                <div class="form-group label-floating col-lg-12">
                                    <textarea class="col-lg-12" id="summernote" name="description"  rows="10">{{$task->description}} </textarea>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label style="color:rgb(180, 180, 180);">Bitiş Tarihi</label>
                                            <input class = "mdl-textfield__input" type="date" name="end_date" value="{{ date('Y-m-d',strtotime($task->end_date)) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                                        <label class="control-label" style="color:rgb(180, 180, 180);">Dosya Yükle</label>
                                        <div class="dropzone">
                                            <div class="dz-message" style="margin: 25px;">
                                                <div class="col-md-12" style="padding: 18px 5px 0 0;">
                                                    <input type="file" class="upload" name="file" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 p-t-20"> 
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
@section('scripts')
<script type="text/javascript" src = "{{ asset('js/task-new.js') }}"></script>
@endsection