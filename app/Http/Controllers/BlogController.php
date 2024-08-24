<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->get();

        return view('home', ['blogs' => $blogs]);

    }

    public function iblogshow()
    {
        // Giriş yapmış kullanıcının email adresini al
        $userId = Auth::user()->id;

        // Kullanıcının email adresine sahip olan blogları al
        $iblogs = Blog::where('user_id', $userId)->get();
        // Kullanıcının bloglarını view'e geçir
        return view('profile', ['iblogs' => $iblogs]);
    }


    public function addpage(Request $request)
    {
        // Tüm blog yazılarını al

        $blogs = Blog::all();
        // View'a tüm blog yazılarını geçir
        return view('addblog', ['blogs' => $blogs]);
    }

  // $slide_id =$request->id;
        // if($request->file('imagepath')){
        //     $image= $request->file('imagepath');
        //     $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(800, 500)->save('upload/'.$name_gen);
        //     $save_url='upload'.$name_gen;
        //     Blog::findOrFail($slide_id)->update([
        //         'imagepath'=>$save_url,
        //     ]);


        public function imagesave(Request $request)
        {
            $request->validate([
                'imagepath' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // İlgili slug'a göre blog yazısını al
            $slug = $request->input('slug');
            $blog = Blog::where('slug', $slug)->first();

            // Blog yazısı var mı diye kontrol et
            if (!$blog) {
                return redirect()->route('detail')->with('error', 'Blog yazısı bulunamadı!');
            }

            // Eski resmi sil
            if ($request->hasFile('imagepath') && $blog->imagepath) {
                $eskiResimYolu = public_path('upload') . '/' . $blog->imagepath;
                if (file_exists($eskiResimYolu)) {
                    unlink($eskiResimYolu);
                }
            }

            // Yeni bir resim yüklendiğinde güncelle
            if ($request->hasFile('imagepath')) {
                $uzanti = $request->file('imagepath')->extension();
                $son_ad = 'blog-' . time() . '.' . $uzanti;
                $request->file('imagepath')->move(public_path('upload'), $son_ad);
                $blog->imagepath = $son_ad;
                $blog->save();
                return redirect()->route('detail', ['slug' => $slug])->with('success', 'Resim güncellendi!');
            }

            return redirect()->route('detail', ['slug' => $slug])->with('error', 'Resim yüklenemedi!');
        }



        // try {
        //     $imagename = $request->file('resim')->getClientOriginalName();
        //     $save = $request->file('resim')->move(public_path('images'), $imagename);
        //     return view('addblog', compact('imagename'));
        // } catch (\Exception $e) {
        //     Hata oluşursa burada işlem yapabilirsiniz
        //     return redirect()->back()->withErrors(['error' => 'Resim yüklenirken bir hata oluştu.']);
        // }


    public function addblog(Request $request)
    {


        $email= $request->email;
        $title=$request->title;
        $content=$request->content;
        $user = User::where('email', $email)->first(); // Fetch the user by email

        if (!$user) {
            // Handle case when user with given email doesn't exist
            return redirect()->back()->with('error', 'User not found');
        }

        $userId = $user->id; // Get the user ID
        $slug = Str::slug($title . '-' . uniqid(), '-');

        Blog::create([

            "user_email"=>$email,
            "title"=>$title,
            "content"=>$content,
            "slug"=>$slug,
            "user_id" => $userId, // Rastgele user_id'yi kullanıcıya atayın
            // "imagepath" =>  $imagePath,

        ]);
        return redirect()->route('index');
    }

    public function detailshow($slug)
    {
        // $blogYazi = Blog::find($id);
        $blogYazi = Blog::where('slug', $slug)->firstOrFail();
        if (!$blogYazi) {
            // Eğer id'ye uygun bir blog yazısı bulunamazsa, 404 sayfasını döndürebilirsiniz.
            abort(404);
        }

        return view('detail', ['blogYazi' => $blogYazi]);

    }

    public function deleteblog($slug)
    {

   $blogYazi = Blog::where('slug', $slug)->firstOrFail();
   $blogYazi->delete();
    return redirect()->route('index');

   }


   public function getTitleList()
   {
       $posts = Blog::all(); // Tüm blog gönderilerini al
       return view('index', ['posts' => $posts]);
   }


   public function updateblog($slug)
{
    // Belirtilen slug'a sahip blog yazısını bul
    $blogYazi = Blog::where('slug', $slug)->first();

    // Blog yazısı bulunamazsa uygun bir hata mesajı döndür
    if (!$blogYazi) {
        abort(404, 'Blog yazısı bulunamadı.');
    }

    // Blog yazısının başlık ve içeriği, ilgili değişkenlere atanır
    $baslik = $blogYazi->title;
    $icerik = $blogYazi->content;

    // Güncelleme formunu gösterirken, bu başlık ve içerik bilgileriyle birlikte view'e gönderilir
    return view('updateblog', compact('blogYazi', 'baslik', 'icerik'));
}


   public function updatebutton(Request $request, $slug)
   {
       // Gelen isteği doğrula
       $request->validate([
           'title' => 'required',
           'content' => 'required',
       ]);

       // Belirtilen slug'a sahip blog yazısını bul
       $blogYazi = Blog::where('slug', $slug)->first();

       // Blog yazısı bulunamazsa uygun bir hata mesajı döndür
       if (!$blogYazi) {
           abort(404, 'Blog yazısı bulunamadı.');
       }

       // Güncelleme işlemini gerçekleştir
       $blogYazi->title = $request->title;
       $blogYazi->content = $request->content;
       $blogYazi->save();

       // Kullanıcıyı yönlendir
       return redirect()->route('index', ['slug' => $slug])->with('success', 'Blog yazısı güncellendi.');
   }







}
