{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>BlogTable</title>
</head> --}}

@extends('layout.layout')
<head>
    <link href="{{ asset('home/css/styles.css')}}" rel="stylesheet" />
    <style>
        .btn-text {
            font-family: 'Roboto', sans-serif; /* Roboto fontunu kullanıyoruz */
            font-size: 16px; /* Yazı boyutunu isteğinize göre ayarlayabilirsiniz */
        }
    </style>
</head>
@section('content')

{{-- <body> --}}


    <div class="p-5 mt-5">
        <!-- Button added in the top right corner -->

        <br>
        <br>
        <div style="position: relative; margin-bottom: 50px;">
            <button button type="button" class="btn" onclick="window.location.href = '{{ route('addpage') }}';" style="background-color: rgba(92, 99, 106, 0.425); color: white; position: absolute; top: 60px; right: 20px;"<span class="btn-text">Blog Yazısı Ekle</span></button>

        </div>





        {{-- <div class="p-5">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td>{{" $blog->user_email" }}</td>


                        <td><a href=" {{ route('detail', ['slug' => $blog->slug ])}}">{{ $blog->title }}</a></td>



                        <td>{{ substr($blog->content, 0, 100) }}...</td>

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
        </div> --}}


<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Blogs </h2>
            <h3 class="section-subheading text-muted">Dünyanın Kozmik Köşesi: Keşfetmek İçin Beklenen Bloglar!</h3>
        </div>
        @php $chunks = $blogs->chunk(3); @endphp
        @foreach ($chunks as $chunk)
            <div class="row">
                @foreach ($chunk as $blog)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link"  href="{{ route('detail', ['slug' => $blog->slug ]) }}">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="{{ asset('upload/' . $blog->imagepath) }}" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">{{$blog->title}}</div>
                            @if($blog->user) <!-- Kullanıcı var mı diye kontrol edin -->
                                <div class="portfolio-caption-subheading text-muted">{{$blog->user->username}}</div>
                            @else
                                <div class="portfolio-caption-subheading text-muted">Kullanıcı Bulunamadı</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>


<script src="{{ asset('home/js/scripts.js')}}"></script>
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
@endsection
