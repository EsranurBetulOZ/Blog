@extends('layout.layout')
<head>
    <style>
  .masthead {
    height: 50vh; /* Ekran yüksekliğinin yarısı kadar */
    max-height: 500px; /* Maksimum 500px yükseklik */
    min-height: 250px; /* Minimum 250px yükseklik */
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}




.masthead .masthead-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Resmi container boyutuna göre doldurur */
    z-index: -1; /* Başlığın üzerine yerleşmesi için */
}

</style>
</head>
@section('content')
    {{-- <body> --}}
        <!-- Navigation-->

        <script>
            function confirmDelete() {
                if(confirm('Blog yazısını silmek istediğinize emin misiniz?')) {
                    document.getElementById('deleteForm').submit();
                }
            }
        </script>

        <!-- Page Header-->
        <div class="p-5 ">
            <div class="mt-5">
                <header class="masthead" style="background-image: url('{{ asset('upload/' . $blogYazi->imagepath) }}')">
                    <div class="container position-relative px-4 px-lg-5">
                        <div class="row gx-4 gx-lg-5 justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-7">
                                <div class="page-heading">
                                    <h1 class="blog-title">{{ $blogYazi->title }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>

        <!-- Main Content-->
        @if(Auth::check() && Auth::user()->email == $blogYazi->user_email)
        <div class="row justify-content-md-end mb-3"> <!-- Değişiklik: Butonları sağa hizalamak için 'justify-content-md-end' sınıfını kullandık -->
            <div class="col-md-4 mb-3"> <!-- Butonların yer alacağı sütunun boyutunu belirledik -->
                <form action="{{ route('imagesave') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slug" value="{{ $blogYazi->slug }}">
                    <label for="photo" class="me-2">Kapak Fotoğrafı</label>
                    <input type="file" name="imagepath" class="form-control-file me-2" style="margin: 5px;">
                    <input type="submit" value="Resmi Yükle" class="btn "style="background-color: rgb(36, 78, 114); color: white; margin: 5px;" > <!-- Butonları düzgün bir şekilde hizalamak için Bootstrap'un btn ve btn-primary sınıflarını kullandık -->
                </form>
            </div>

            <div class="col-md-4 mb-3"> <!-- Butonların yer alacağı sütunun boyutunu belirledik -->
                <a href="{{ route('updateblog', ['slug' => $blogYazi->slug]) }}" class="btn"style="background-color: rgb(36, 78, 114); color: white;" >Güncelle</a> <!-- Butonları düzgün bir şekilde hizalamak için Bootstrap'un btn ve btn-primary sınıflarını kullandık -->
            </div>

            <div class="col-md-4 mb-3"> <!-- Butonların yer alacağı sütunun boyutunu belirledik -->
                <form method="POST" action="{{ route('deleteblog', ['slug' => $blogYazi->slug]) }}" onsubmit="return confirm('Bu blog yazısını silmek istediğinizden emin misiniz?')">
                    @csrf
                    <button type="submit" class="btn btn-danger">Blog Yazımı Sil</button> <!-- Butonları düzgün bir şekilde hizalamak için Bootstrap'un btn ve btn-danger sınıflarını kullandık -->
                </form>
            </div>

        </div>
        @endif
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>{!! nl2br(htmlspecialchars($blogYazi->content)) !!}</p>
                    </div>
                </div>
            </div>
        </main>
        </div>
    @endsection
