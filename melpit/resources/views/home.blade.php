@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="post" action="selection" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $auth->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nickName" class="col-md-4 col-form-label text-md-right">ニックネーム</label>

                            <div class="col-md-6">
                                @if(!isset($informations->nickName))
                                <input id="nickName" type="text" class="form-control @error('nickName') is-invalid @enderror" name="nickName" 　placeholder="※こちらは公開されます(10文字以内)" required autocomplete="nickName" value="{{ old('nickName') }}">
                                @else
                                <input id="nickName" type="text" class="form-control @error('nickName') is-invalid @enderror " name="nickName" value="{{ old('nickName') ? : $informations->nickName }}" placeholder="必ず入力してください(10文字以内)" required autocomplete="nickName">
                                @endif

                                @error('nickName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">アイコン</label>
                            <div class="col-md-6">
                                @if(!isset($informations->image))
                                <img src="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/img.png" alt="プロフィール画像" style="width: 100px; height: 100px; border:solid 1px rgb(229,229,229)">
                                <input class="form-control form-control-sm" id="img" type="file" name="image">
				                @else
                                <img src="{{ $informations->image }}" alt="プロフィール画像" style="width: 100px; height: 100px; border:solid 1px rgb(229,229,229)">
                                <input class="form-control form-control-sm" id="img" type="file" name="image">
                                <input type="hidden" value="{{ $informations->image }}" name="previousImg">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inlineRadio3" class="col-md-4 col-form-label text-md-right">性別</label>
                            <div class="col-md-6" style="margin:auto 0;">
                                @if(!isset($informations))
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">男</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">女</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio3" value="9" checked>
                                    <label class="form-check-label" for="inlineRadio3">未選択</label>
                                </div>
                                @else
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio1" value="1" <?php if ($informations->sex == 1) echo "checked"?>>
                                    <label class="form-check-label" for="inlineRadio1">男</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio2" value="2" <?php if ($informations->sex == 2) echo "checked"?>>
                                    <label class="form-check-label" for="inlineRadio2">女</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="inlineRadioOptions" id="inlineRadio3" value="9" <?php if ($informations->sex == 9) echo "checked"?>>
                                    <label class="form-check-label" for="inlineRadio3">未選択</label>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="html_css" class="col-md-4 col-form-label text-md-right" 　checked="html_css">言語</label>
                            <div class="col-md-6">
                                @if(!isset($informations))
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/html_css" id="html_css" checked>
                                    <label class="form-check-label" for="html_css">
                                        HTML,CSS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/javaScript" id="javaScript">
                                    <label class="form-check-label" for="javaScript">
                                        JavaScript
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/java" id="java">
                                    <label class="form-check-label" for="java">
                                        Java
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/php" id="php">
                                    <label class="form-check-label" for="php">
                                        PHP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/ruby" id="ruby">
                                    <label class="form-check-label" for="ruby">
                                        Ruby
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c1" id="c1">
                                    <label class="form-check-label" for="c#">
                                        C#
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/python" id="python">
                                    <label class="form-check-label" for="python">
                                        Python
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c2" id="c2">
                                    <label class="form-check-label" for="c++">
                                        C++
                                    </label>
                                </div>
                                @else

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/html_css" id="html_css" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/html_css', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="html_css">
                                        HTML,CSS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/javaScript" id="javaScript" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/javaScript', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="javaScript">
                                        JavaScript
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/java" id="java" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/java', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="java">
                                        Java
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/php" id="php" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/php', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="php">
                                        PHP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/ruby" id="ruby" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/ruby', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="ruby">
                                        Ruby
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c1" id="c1" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c1', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="c1">
                                        C#
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/python" id="python" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/python', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="python">
                                        Python
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="language[]" value="https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c2" id="c2" <?php if (in_array('https://laravel-chat2-bucket.s3-ap-northeast-1.amazonaws.com/c2', $value)) echo "checked" ?>>
                                    <label class="form-check-label" for="c2">
                                        C++
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="introduction" class="col-md-4 col-form-label text-md-right">自己紹介</label>
                            <div class="col-md-6">
                                @if(!isset($informations->introduction))
                                <textarea id="introduction" class="form-control @error('introduction') is-invalid @enderror" name="introduction" placeholder="簡単に記入してください(255文字以内)" required autocomplete="introduction">{{ old('introduction')}}</textarea>
                                @else
                                <textarea id="introduction" class="form-control @error('introduction') is-invalid @enderror" name="introduction" placeholder="必ず入力してください(255文字以内)" required autocomplete="introduction">{{ old('introduction') ? : $informations->introduction }}</textarea>
                                @endif

                                @error('introduction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class=" form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="submit();">
                                    @if(!isset($informations))
                                    登録する
                                    @else
                                    編集する
                                    @endif
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
