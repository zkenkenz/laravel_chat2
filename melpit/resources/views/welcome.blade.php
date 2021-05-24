<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>未経験エンジニアの為のチャット</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background: url("https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/brain-5870352_1920.jpg");
            background-size: cover;
            background-color: rgba(255, 255, 255, 0.3);
            background-blend-mode: lighten;
            color: #222222;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 40px;
            font-weight: 600;
        }
        .subTitle {
            font-size: 20px;
            font-weight: 600;
        }


        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            top: 50px;
        }

        .login {
            margin-top: 100px;
        }

        .login>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            background-color: rgb(255, 255, 255)
        }


        .m-b-md {
            margin: 50px 0 80px 0;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title">
                ララチャット
            </div>
            <div class="subTitle m-b-md">
                〜未経験エンジニアによる未経験エンジニアのためのチャット〜
            </div>

            <div class="links">
                <a href="https://twitter.com/dntz1225"><img src="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/twitter.png" class="image" style="width: 50px; height: 50px; border-radius: 30%;"></a>
                <a href="https://github.com/zkenkenz/laravel_chat2"><img src="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/github.png" class="image" style="width: 50px; height: 50px; border-radius: 10%;"></a>
            </div>

            @if (Route::has('login'))
            <div class="login">
                @auth
                <a href="{{ url('/selection') }}">トーク一覧へ</a>
                @else
                <a href="{{ route('login') }}">{{ __('Login') }}</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </div>
</body>

</html>
