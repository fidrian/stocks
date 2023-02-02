<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB; 
use Hash;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->intended('/dashboard');
        }

        return view('login');
    }

    public function authenticate(Request $request) {
        $user = User::where('email',$request->email)->where('role','!=','user')->where('role_extra','stock')->first();
        
        if($user && Hash::check($request->password, $user->password)) {
             $credentials = [
            'email' => $request->email,
            'password' => $request->password
            ];

            if (Auth::guard('web')->attempt($credentials)) {
        
                $request->session()->regenerate();
            
                User::where('email',$request->email)->update(['last_login'=> date('Y-m-d H:i:s')]);
                
                return redirect()->intended('/dashboard');
            }

        }
        
        return back()->with("gagal","Email atau password tidak benar");
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function reset_password(Request $request) {
       $email = $request->email;
       $user = User::where('email', $email)->where('role','!=','user')->first();

        if($user) {
            $hp  = $user->no_hp;

            if($hp) {
                $name = $user->name;
                $password = Str::random(4).date('is');
    
                $user->password  = Hash::make($password);
                $user->save();
    
                $wa = new WAService();
                $wa->ResetAkunBackoffice($hp, $name, $password);
    
                return back()->with("sukses","Password telah dikirim ke nomor $hp, silakan cek WA kamu.");
    
            }
            else {
                return back()->with("gagal","No HP untuk akun $email tidak terdaftar, silakan kontak admin");
            }
           
        }

        return back()->with("gagal","Akun $email tidak terdaftar, silakan kontak admin");
    }
   
}
