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

    {{-- <div style="margin-bottom: 20px;">
        <select name="Makaleler" id="selectBlog" class="form-control">
            <option value="" selected disabled>Değiştirmek istediğiniz makalenizi seçiniz &#9660;</option>
            @foreach($blogYazi as $blog)
                <option value="{{ $blog->slug }}">{{ $blog->title }}</option>
            @endforeach
        </select>
    </div> --}}

    {{-- <select id="title_dropdown">
        <option value="">Başlık Seçin</option>
        @foreach($posts as $post)
            <option value="{{ $post->id}}">{{$post->title}}</option>
        @endforeach
    </select> --}}


    <div class="p-5 mt-5">
    <form action="{{route('update', ['slug' => $blogYazi->slug])}}" method="post" class="user" >
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
            <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror"
            input type="text" id="title_input" name="title" placeholder="Başlık" value="{{ old('title', $blogYazi->title) }}">

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group "style="margin-bottom: 20px; margin-top: 20px; ">
            <textarea class="form-control form-control-user @error('content') is-invalid @enderror"
            id="content_input" name="content" placeholder="İçerik" rows="16">{{ old('content', $blogYazi->content) }}</textarea>


                      @error('content')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
         </div>
         <div>
                      <button type="submit" class="btn btn-user btn-block custom-button" style="background-color: rgba(117, 71, 40, 0.356); color: rgb(0, 0, 0);"" >Güncelle</button>

</div>

</form>

</div>


<script>
    // Renk değiştiğinde içerik rengini güncelleyen işlev
    function changeContentColor() {
        // Seçilen renk değerini al
        var selectedColor = document.getElementById('content_color').value;
        // İçerik giriş alanını seçilen renk ile biçimlendir
        document.getElementById('content_input').style.color = selectedColor;
    }
</script>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#selectBlogYazi').change(function(){
            var blogYaziId = $(this).val();
            $.ajax({
                url: '/getBlogYazi', // Bu, controller yönteminizin rotası olmalı
                type: 'POST',
                data: {
                    'blogYaziId': blogYaziId,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response){
                    $('#titleInput').val(response.title);
                    $('#contentInput').val(response.content);
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}
{{--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // Dropdown değiştiğinde
        $('#title_dropdown').change(function(){
            var post_id = $(this).val(); // Seçilen başlık id'sini al
            $.ajax({
                url: '{{ route("getTitle") }}',
                type: 'GET',
                dataType: 'json',
                data: {post_id: post_id},
                success: function(response){
                    $('#title_input').val(response.title);
                    $('#content_input').val(response.content);
                }
            });
        });
    });
</script> --}}


        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
{{-- </body> --}}
@endsection
</html>
