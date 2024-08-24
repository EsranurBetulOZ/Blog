<!-- resources/views/auth/user-login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS ekleyin -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
			font-family: 'Montserrat', sans-serif;
        }

        #res {
		    position: relative;
		    overflow: hidden;
		    width: 100%;
		    height: 100%;
		}

        #res img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
			filter: contrast(0.5);
        }
		.logo {
		    position: absolute;
		    top: 5%;
		    left: 7%;
		}
        #res .overlay {
		    position: absolute;
		    top: 0;
		    left: 7%;
		    width: 100%;
		    height: 100%;
		    display: flex;
		    flex-direction: column;
		    align-items: flex-start;
		    justify-content: center;
		}
        #res .overlay h1{
		    color: #fff;
		    font-size: 40px;
		    width: 50%;
		}
        #res .overlay p{
		    color: #FFFFFF;
		    font-size: 20px;
			margin-top: 20px;
			width: 70%;
		}
        #res .overlay {
            color:#fff;
        }

        #res2 {
            background-color: rgba(255, 255, 255, 0.8); /* Beyaz opak arka plan */
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            height: 600px;
            margin-top: 20px;
        }
       #res2 h3{
        	text-align: left;
    		margin-left: 15%;
    		margin-top: 11%;
			font-size: 30px;
			font-weight: 700;
       }
        #res2 h1, #res2 h3, #res2 p {
            text-align: left;
        }
        .form-1{
            margin-left: 15%;
    		margin-right: 15%;
    		margin-top: 4%;
        }
        #buton-1{
         margin: 0 auto;
    display: block;
    width: 100%;
    background: #cc2323;
    border-color: #cc2323;
    height: 50px;
    font-size: 19px;
        }
        .form-control{
        	height: calc(2em + 0.75rem + 2px);
			border: 1px solid #e5e5e6;
        }
        .uye-ol{
            text-align:center !important;
            margin-top:2%;
        }
        .uye-link{
            color:#000;
            font-weight:600;
        }
@media (max-width: 768px) {
			#res {
			    position: relative;
			    overflow: hidden;
			    width: 100%;
			}
			.logo {
			    position: absolute;
			    top: 5%;
			    left: 5%;
			}
			#res .overlay {
			    position: absolute;
			    top: 12%;
			    left: 5%;
			    width: 100%;
				height: auto;
			}
			#res .overlay h1 {
			    font-size: 15px;
			    width: 100%;
			}
			#res .overlay p {
			    color: #FAF1F1;
			    font-size: 12px;
			    margin-top: 0px;
			    width: 95%;
				margin-right: 5px;
			}

			#res2 {
			    padding: 10px;
			    border-radius: 0px;
			    width: 100%;
			    height: 90%;
			    margin-top: 0px;
			    position: absolute;
			    top: 25%;
				height: 370px;
			}
			#res2 h3 {
			    margin-left: 5%;
			    margin-top: 0%;
			    font-size: 20px;
			}
			.form-1 {
			    margin-left: 5%;
			    margin-right: 5%;
			    margin-top: 4%;
			}
		}
    </style>
</head>
<body>

<div id="res">
    <!-- İlk bölge (resimli arka plan) -->
    <img src="https://cdn.pixabay.com/photo/2023/09/25/19/58/piran-8275931_1280.jpg" alt="Arkaplan Resmi">
    <div class="overlay">
        <h1>MY BLOG</h1>
        <p>My Blog yazılarını detaylı görüntüleyebilmek için giriş yapmanız gereklidir</p>
    </div>
</div>

<div id="res2">
    <h3>GİRİŞ SAYFASI</h3>
    <!-- İkinci bölge (form alanı) -->
    <form method="POST" action="{{ route('login.in') }}" class="form-1">
        @csrf

        <!-- Eğer hatalı giriş yapılırsa hataları göster -->
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="form-group">
            <label for="email">Mail Adresi</label>
            <input type="email" name="email" class="form-control" placeholder="Mail Adresinizi Yazınız." required>
        </div>

        <div class="form-group">
            <label for="password">Şifre</label>
            <input type="password" name="password" class="form-control" placeholder="Şifrenizi Yazınız." required>
        </div>

        <button type="submit" id="buton-1" class="btn btn-primary">Giriş Yap</button>
        <p class="uye-ol">Hesabın yoksa hemen <a href="{{route('getregister')}}" class="uye-link"> ÜYE OL </a></p>


    </form>
</div>

<!-- Bootstrap JS ve Popper.js ekleyin -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
