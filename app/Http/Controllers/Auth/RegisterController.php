<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Events\UserDeleted;
use App\Models\User;



class RegisterController extends Controller
{
    public function showLoginForm(){
       return view('auth.register');
    }


    public function register(Request $request){
        // Veri doğrulama (validation)
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $name= $request->name;
    $userId = Str::uuid();
    $email=$request->email;
    $password=$request->password;
    $hashedPassword = Hash::make($password);

    User::create([
        "username"=>$name,
        "user_id" => $userId, // Rastgele user_id'yi kullanıcıya atayın
        "email"=>$email,
        "password"=>$hashedPassword,
    ]);
    Session::flash('success', 'Kayıt işleminiz başarıyla gerçekleşti! Lütfen giriş yapın.');
    return redirect()->route('login');


}

public function deregister(Request $request)
{
    // Kullanıcıdan gelen isteği doğrulayın
    $request->validate([
        'password' => 'required|string',
    ]);

    $user = Auth::user();

    // Girilen şifrenin kullanıcının şifresiyle eşleşip eşleşmediğini kontrol edin
    if (!Hash::check($request->password, $user->password)) {
        // Hatalı şifre durumunda aynı sayfada kalacak şekilde hata mesajını döndür
        return back()->withErrors(['password' => 'Hatalı şifre. Lütfen tekrar deneyin.']);}

    event(new UserDeleted($user));
    $user->delete();

    // Şifre doğruysa başarılı mesajını döndür
    return redirect()->route('login')->with('success', 'Kullanıcı başarıyla silindi.');
}






}




