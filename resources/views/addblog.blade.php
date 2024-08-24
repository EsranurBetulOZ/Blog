@extends('layout.layout')
<head>
    <style>
.custom-button {
    background-color: rgb(36, 78, 114);
    color: white;
    width: fit-content; /* Düğmenin içeriğine uygun genişlikte olmasını sağlar */
    max-width: 200px; /* İstediğiniz maksimum genişliği buradan ayarlayabilirsiniz */
    margin: 0 auto; /* Butonu ortalamak için */
}
    </style>
</head>
@section('content')
{{-- <body> --}}

    <div class="mt-5 p-5"> <!-- Adding margin-top for visual separation -->
        <div class="hero bg-secondary text-black text-center" style="background-image: url('{{ asset('upload/blog.png') }}')">

            <div class="container p-5">
                <h1 class="display-4">Selam Yaratıcı Yazarlar!</h1> <div class="p-5">
                <p class="lead">

Burada blog yazma yolculuğunuzda size rehberlik edecek 8 altın kural var! Hazır mısınız? Hadi başlayalım! 🎉</p>

<p> Kitleyi Bulun: Yazınızı yazarken, kimin için yazdığınızı düşünün. Gençler mi? Hobiseverler mi? İçeriğinizi onlara göre şekillendirin!</p>

Başlıkta Parlayın: Başlık, yazınızın pırıltılı tacıdır! İlgi çekici, merak uyandırıcı ve biraz da sıradışı başlıklar seçin. Kimi zaman "Patates Salatası Nasıl Yapılır?" kafi gelmeyebilir, değil mi? 🥗🔍

<p>Değerli İçerik Sunun: İçeriğinizin değerli olması önemli! Okuyucularınızı eğlendirin, bilgilendirin ya da ilham verin. Değer katan yazılar, sadık bir okuyucu kitlesi yaratır. 💡💬</p>

<p>Görsel Şölen Yaratın: Sıkıcı bir metin yerine, görsel bir şölen sunun! Renkli grafikler, ilginç fotoğraflar ve göz alıcı videolarla yazınızı süsleyin. Görseller bazen bin kelimeden daha fazla anlatabilir! 🎨📸</p>

<p>Kısa ve Öz Olun: Kelimeleri tasarruflu kullanın ve lafı uzatmayın! Kısa ve öz yazılar, okuyucularınızın dikkatini çeker. Ama yine de ne olduğunu anlayabilsinler! 🚀🔍</p>

<p>Düzeltmeleri Yapın: Yazınızı bitirdikten sonra, geriye yaslanıp kahvenizi yudumlamayın! Düzeltmeleri yapın, dil hatalarını bulun ve içeriğinizi kontrol edin. Hepsini bir arada yapabilirsiniz, öyle değil mi? ☕✍️</p>

Eğlenin!: Son ama en önemlisi, eğlenin! Yazmak bir macera, keşfedilmeyi bekleyen bir yolculuktur. Yaratıcılığınızı konuşturun, sınırları zorlayın ve keyfini çıkarın! 🎉🚀

Hazır mısınız? Şimdi kalemizi, klavyemizi veya telefonumuzu alıp, bu blog yolculuğunda yeni bir maceraya adım atalım! 🚀✍️

Yazın, paylaşın ve unutmayın; her kelime bir hazine olabilir! 💎📝</p>
            </div>
        </div>
        </div>
        <div class="p-5">
    <form action="{{route('addpage')}}" method="post" class="user" >
        @csrf
        <div class="form-group" style="margin-bottom: 20px; margin-top: 20px; ">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                placeholder="E-posta Adresinizi Girin..." value="{{ auth()->user()->email }}" readonly>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group" style="margin-bottom: 20px; margin-top: 20px; ">
            <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror""
                id="titleInput" name="title"placeholder="Başlık" >

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group "style="margin-bottom: 20px; margin-top: 20px; ">
            <textarea class="form-control form-control-user @error('content') is-invalid @enderror"
                      id="contentInput" name="content" placeholder="İçerik" rows="5"></textarea>

            @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        <!-- Ana sayfadan geldiyse -->

        <div class="mt-5">
        <form action="{{ route('addblog') }}" method="POST">
            @csrf
            <!-- Kaydetme formu alanları -->

            <button type="submit" class="btn btn-user btn-block custom-button" style="background-color: rgba(117, 71, 40, 0.356); color: rgb(0, 0, 0);">Kaydet</button>
        </form>
        </div>


        <hr>
        <a href="index.html" class="btn btn-google btn-user btn-block">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="index.html" class="btn btn-facebook btn-user btn-block">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a>
    </form>
 </div>
        </div>
@endsection

