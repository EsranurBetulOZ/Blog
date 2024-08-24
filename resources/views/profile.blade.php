@extends('layout.layout')


@section('content')
<head><link href="{{asset('profile/css/styles.css')}}" rel="stylesheet" /></head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top" id="sideNav" style="left: 0; top: 58px; bottom: 0; z-index: 1000; ">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">

                <span class="d-block d-lg-none">{{ Auth::user()->username }}</span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{asset('profile/assets/img/profile.jpg')}}" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#blog">Blog Yazılarım</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#resetpassword">Şifre yenileme</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#userdelete">Kullanıcı Sil</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">Awards</a></li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="blog">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                        <span class="text-primary">Bloglarım</span>
                    </h1>
                    <div style="position: relative; margin-bottom: 50px;">
                        <button button type="button" class="btn" onclick="window.location.href = '{{ route('addpage') }}';" style="background-color: rgba(189, 94, 56, 0.815); color: white; position: absolute; top: 60px; right: 20px;"<span class="btn-text">Blog Yazısı Ekle +</span></button>

                    </div>
            <div class="p-5">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($iblogs as $iblog)
                        <tr>
                            <td>{{" $iblog->user_email" }}</td>


                            <td><a href=" {{ route('detail', ['slug' => $iblog->slug ])}}">{{ $iblog->title }}</a></td>



                            <td>{{ substr($iblog->content, 0, 100) }}...</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Content</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
            <hr class="m-0" />


            <!-- Reset Form-->
            <section class="resume-section" id="resetpassword">
                <div class="resume-section-content">
                    <h2 class="mb-5">Şifre Yenileme</h2>
                    <form action="{{ route('resetpassword') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Eski Şifre:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Yeni Şifre:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Şifreyi Onayla:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Şifreyi Değiştir</button>
                    </form>
                </div>
            </section>




            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="userdelete">
                <div class="resume-section-content">
                    <h2 class="mb-5">Kullanıcı Hesabımı Sil</h2>
                    <p class="mb-5">Kullanıcı Hesabınızı sildiğinizde profiliniz kalıcı olarak silinecektir. Bu işlemi yapmak için parolanızı doğru bir şekilde girmelisiniz
                    </p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="deleteForm" method="POST" action="{{ route('user.delete') }}" style="display: inline;">
                        @csrf

                        <!-- Şifre giriş alanını ekleyin -->
                        <input type="password" name="password" id="passwordField" placeholder="Şifrenizi girin" style="display: none;" required>
                        <!-- Butona basıldığında şifreyi gizlice almak için gizli bir alan -->
                        <input type="hidden" name="password" id="password">
                        <button type="button" class="btn" onclick="confirmDelete()" style="background-color: rgb(92, 99, 106); color: white;">Kullanıcımı Sil</button>
                    </form>


                </div>
            </section>

<script>
    function confirmDelete() {
    var password = prompt("Lütfen şifrenizi girin:");
    if (password != null) {
        // Şifreyi gizli alanına ata
        document.getElementById('password').value = password;

        // Kullanıcıya silme işlemi için onay mesajı göster
        if (confirm('Kullanıcı profilinizi silmek istediğinize emin misiniz?')) {
            // Formu gönder
            document.getElementById('deleteForm').submit();
        } else {
            // İptal edildiğinde hata mesajı göster
            alert('Silme işlemi iptal edildi.');
        }
    } else {
        // Şifre girilmediğinde hata mesajı göster
        alert('Şifre girilmedi.');
    }
}


</script>
            <hr class="m-0" />



            <!-- Awards-->
            <section class="resume-section" id="awards">
                <div class="resume-section-content">
                    <h2 class="mb-5">Awards & Certifications</h2>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            Google Analytics Certified Developer
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            Mobile Web Specialist - Google Certification
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - University of Colorado Boulder - Emerging Tech Competition 2009
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - University of Colorado Boulder - Adobe Creative Jam 2008 (UI Design Category)
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            2
                            <sup>nd</sup>
                            Place - University of Colorado Boulder - Emerging Tech Competition 2008
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - James Buchanan High School - Hackathon 2006
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            3
                            <sup>rd</sup>
                            Place - James Buchanan High School - Hackathon 2005
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <!-- Bootstrap core JS-->
        <script src="{{asset('profile/https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('profile/js/scripts.js')}}"></script>
    </body>
</html>












<style>
    .nav.flex-column {
        background-color: #f8f9fa; /* Arka plan rengi */
        border-radius: 8px; /* Kenar yuvarlaklığı */
        padding: 10px; /* İçerik boşluğu */
        width: 250px; /* Genişlik */
    }

    .nav-link {
        color: #333; /* Yazı rengi */
        font-size: 16px; /* Yazı boyutu */
        padding: 8px 16px; /* Yazı iç boşluğu */
        margin-bottom: 5px; /* Linkler arası boşluk */
        border-radius: 4px; /* Kenar yuvarlaklığı */
        transition: background-color 0.3s ease; /* Geçiş efekti */
    }

    .nav-link:hover {
        background-color: #ddd; /* Üzerine gelindiğinde arka plan rengi */
    }

    .nav-link.active {
        background-color: #007bff; /* Aktif sayfa arka plan rengi */
        color: #fff; /* Aktif sayfa yazı rengi */
    }
</style>

@endsection
