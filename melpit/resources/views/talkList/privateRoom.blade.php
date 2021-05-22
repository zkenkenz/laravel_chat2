@extends('layouts.app')
<link href="{{ asset('css/talk.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color:lightblue;">
                    <div class="title" style=" text-align:center; font-size:17px;">
                        {{ $dmUser->nickName }}プライベートルーム
                    </div>
                    <div class="search" style="float: right;">
                        <form action="search" method="get">
                            @csrf
                            <input type="text" name="key2" placeholder="Search" style="width:100px; height:25px;">
                            <button type="submit" class="btn btn-primary btn-sm">検索</button>
                            <input type="hidden" value='{{ $user_id }}' name='directId'>
                        </form>
                    </div>
                    {{$messages->appends(request()->input())->links()}}
                </div>
                <div class="card-body" style="background-color:lightcyan">
                    <div class="messages">

                        <p style='text-align:center;'>メッセージを送りましょう</p>

                        <ul class="messages">
                            @foreach($messages as $message)
                            @if($message->destination === $auth->id)
                            <li class="left-side">

                                <div class="name">
                                    {{ $dmUser->nickName }}<br>
                                    <img src="{{ $dmUser->image }}" alt="プロフィール画像">

                                </div>
                                <div class="txt">
                                    {!! nl2br(e($message->message)) !!}<br>
                                    <span>{{ $message->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @else
                            <li class="right-side">

                                <div class="name">
                                    {{ $login->nickName }}<br>
                                    <img src="{{ $login->image }}" alt="プロフィール画像">
                                </div>

                                <div class="txt">
                                    {!! nl2br(e($message->message)) !!}<br>
                                    <span>{{ $message->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @endif
                            @endforeach



                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background-color:lightcyan">
                    <form action="directMsg" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control @error('Msg') is-invalid @enderror" name="Msg" placeholder="message" required autocomplete="Msg">{{ old('Msg') }}</textarea>
                            @error('Msg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">送信</button>
                            <input type="hidden" value='{{ $user_id }}' name='directId'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
