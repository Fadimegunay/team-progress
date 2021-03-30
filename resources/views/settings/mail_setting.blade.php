@extends('layouts.home.app')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Mail Ayarları</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('home') }}">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" href="">Mail</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                    <li class="active">Ayarları</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel">
                    <div class="col-lg-12"> 
                        <h3 class="panel-heading">Mail Ayarları</h3>
                    </div>
                    <div class="panel-body">
                        @if(session()->has('message'))
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                            {{ session()->forget('message') }}
                        @endif
                        <form action="{{ route('mail_setting.update') }}" method="POST" >
                            @csrf

                            @php $driver = ''; @endphp 
                            @if(isset($mailSetting->mail_driver)) 
                                @php $driver = $mailSetting->mail_driver; @endphp 
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" name="driver" value="{{ $driver  }}" required>
                                        <label class="mdl-textfield__label">Mail Driver</label>
                                    </div>
                                </div>
                            </div>
                            @php $host = ''; @endphp 
                            @if(isset($mailSetting->mail_host)) 
                                @php $host = $mailSetting->mail_host; @endphp 
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" name="host" value="{{ $host  }}" required>
                                        <label class="mdl-textfield__label">Mail Host</label>
                                    </div>
                                </div>
                            </div>
                            @php $port = ''; @endphp 
                            @if(isset($mailSetting->mail_port)) 
                            @php $port = $mailSetting->mail_port; @endphp 
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label style="color:rgb(180, 180, 180);">Mail Port</label>
                                        <select class="form-control" required name="port">
                                            <option <?php if($port == ""){ echo "selected"; }?> value = "">Port Seçiniz</option>
                                            <option <?php if($port == "587"){ echo "selected"; } ?> value = "587">587</option>
                                            <option <?php if($port == "465"){ echo "selected"; } ?> value = "465">465</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @php $username = ''; @endphp 
                            @if(isset($mailSetting->mail_username)) 
                            @php $username = $mailSetting->mail_username; @endphp 
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" name="username" value="{{ $username  }}" required>
                                        <label class="mdl-textfield__label">Mail Kullanıcı Adı</label>
                                    </div>
                                </div>
                            </div>

                            @php $placeholder = ''; @endphp 
                            @if(isset($mailSetting->mail_password)) 
                            @php $placeholder = 'Şifreniz Kaydedilmiştir'; @endphp 
                            @endif
                            <div class="form-group">
                                <div class="col-lg-12"> 
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="password" placeholder = '{{ $placeholder }}' name="password" >
                                        <label class="mdl-textfield__label">Şifre</label>
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

@endsection