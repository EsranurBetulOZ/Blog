<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Model\User;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {


            return redirect('/');
        }
        if (Auth::attempt($credentials)) {
            // Başarılı giriş
            return redirect('/'); // Yönlendirme yapılacak sayfanın adresi
        }
        else{
        // Giriş başarısız
        return back()->withErrors(['login' => 'Giriş bilgileri geçersiz']);
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function resetPassword(Request $request)
    {
        // Doğrulama kurallarını tanımla
        $rules = [
            'email' => 'required|email',
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];

        // Doğrulama kurallarını uygula
        $request->validate($rules);

        // Kullanıcıyı bul
        $user = Auth::user();

        // Eğer kullanıcı mevcut değilse veya eski şifre doğru değilse hata döndür
        if (!$user || !Hash::check($request->input('old_password'), $user->password)) {
            return back()->withErrors(['old_password' => 'Eski şifre hatalı'])->withInput();
        }

        // Yeni şifreyi ayarla ve kaydet
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Başarılı mesaj ile birlikte kullanıcıyı yönlendir
        return redirect()->back()->with('success', 'Şifre başarıyla yenilendi');
    }


}
