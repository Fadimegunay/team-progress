<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\ForgotPassword;

use App\Mail\ForgotPassword as forgot_password;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = md5($request->input('password'));
        $user = User::where([
                        'email' => $email,
                        'password' => $password,
                        'is_active' => true
                    ])->first();
        
        if($user == null){
            return  redirect()->route('login')->with('message', 'E-Posta veya Parola hatalı!');
        }
        Auth::login($user);
        $request->session()->put('user',$user->id);
        
        return redirect()->route('home');
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect()->route('login');
    }

    public function forgotPassword(){
        return view('login.forgot-password');
    }

    public function forgotPasswordCheck(Request $request){
        $email_ = $request->input('email');
        $email = User::where('email', $email_);
        if($email->exists()){
            $user_ = $email->first();
            $code = new ForgotPassword();
            $code->user_id = $user_->id;
            $code->code = Str::uuid();
            $code->save();

            $user = new \stdClass();
            $user->email = $user_->email;
            $user->name = $user_->name;
            Mail::to([$user])->send(new forgot_password($code));

            return redirect()->route('forgot_password')->with('message','Sıfırlama kodu gönderilirdi. Mail Adresinizi Kontrol edebilirsiniz.');
        }else{
            return redirect()->route('forgot_password')->with('message','Mail Adresi Bulunamamıştır!');
        }
    }

    public function changePassword($code){
        $password = ForgotPassword::where('code',$code);
        if($password->exists()){
            $password_ = $password->first();
            $data['code'] = $password_->code;
            return view('login.change-password',$data);
            
        }else{
            return abort("404");
        }
    }

    public function changePasswordAction(Request $request, $code){
        $password = ForgotPassword::where('code',$code);
        if($password->exists()){
            $password_ = $password->first();
            $code = $password_->code;
            if($request->input('password') == $request->input('return_password')){
                $user = User::where('email',$password_->user->email)->first();
                $user->password = md5($request->input('password'));
                $user->save();
                $password->delete();
                return redirect()->route('login')->with('message','Parola Güncellendi, Giriş Yapabilirsiniz.');
            }else{
                return redirect()->route('changePassword',['code' => $code])->with("message","Parolalar eşleşmiyor!");
            }
        }else{
            return abort("404");
        }
    }
}
