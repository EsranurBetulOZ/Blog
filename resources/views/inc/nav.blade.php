<style>
    /* Custom CSS */
    #mainNav {
        background-color: rgb(234, 116, 56);


    }
</style>
<div>
<nav class="navbar navbar-expand-lg navbar-light justify-content-between" id="mainNav">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('index')}}">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <a href=".html" class="js-logo-clone"></a>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0 ">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('index')}}">Ana Sayfa</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{route('iblog')}}">Hesabım</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}">Çıkış Yap [-></a></li>
            </ul>
        </div>
    </div>
</nav>



</div>

