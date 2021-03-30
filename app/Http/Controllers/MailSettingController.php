<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\MailSetting;

class MailSettingController extends Controller
{
    public function edit() 
    {
        if (Gate::denies('access', 'mailSettings-edit')) {
            return redirect()->route('home');
        }
        $data = [];
        $data['mailSetting'] = MailSetting::first();
        return view('settings.mail_setting',$data);
    }

    public function update(Request $request){
        $mailSetting = MailSetting::exists();
        if($mailSetting){
            $settings = MailSetting::first();
        }else{
            $settings = new MailSetting();
        }
        $settings->mail_driver = $request->input('driver');
        $settings->mail_host = $request->input('host');
        $settings->mail_port = $request->input('port');
        $settings->mail_username = $request->input('username');
        if($request->input('password'))
            $settings->mail_password = base64_encode(base64_encode($request->input('password')));
        $settings->save();
        return redirect()->route('mail_setting.edit');
    }
}
