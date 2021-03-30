@extends('layouts.login.app')

@section('content')
<div class="wrap-login100">
    <form class="login100-form validate-form" action="{{ route('forgotPassword') }}" method="POST">
        @csrf
        <span class="login100-form-logo">
            <i class="zmdi zmdi-flower"></i>
        </span>
        <span class="login100-form-title p-b-34 p-t-27">
            Şifremi Unuttum
        </span>
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
            {{ session()->forget('message') }}
        @endif
        <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input class="input100" type="text" name="email" required placeholder="Mail Adresi">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                Gönder
            </button>
        </div>
        <div class="text-center p-t-90">
            <a class="txt1" href="">
                Giriş
            </a>
        </div>
    </form>
</div>
@endsection