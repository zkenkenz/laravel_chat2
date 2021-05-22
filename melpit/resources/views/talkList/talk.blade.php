@extends('layouts.app')
<link href="{{ asset('css/talk.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style=" text-align:center; font-size:17px;">
                        @if($language === 'c1')
                        <strong>C#</strong>トークルーム
                        @elseif($language === 'c2')
                        <strong>C++</strong>トークルーム
                        @else
                        <strong>{{ $language }}</strong>トークルーム
                        @endif
                    </div>
                    <div class="search" style="float: right;">
                        <form action="search" method="get">
                            @csrf
                            <input type="text" name="key1" placeholder="Search" style="width:100px; height:25px;">
                            <button type="submit" class="btn btn-primary btn-sm">検索</button>
                            <input type="hidden" value="{{ $language }}" name="language">
                        </form>
                    </div>
                    {{$userMessages->appends(request()->input())->links()}}
                </div>
                <div class="card-body">
                    <div class="messages">
                        <ul class="messages">
                            @foreach($userMessages as $message)
                            @if($auth->id != $message->user_id)
                            <li class="left-side">
                                <div class="name">
                                    {{ $message->user_name }}<br>
                                    @foreach($users as $user)
                                    @if($user->user_id == $message->user_id)
                                    <form action="privateRoom" method="get">
                                        @csrf
                                        <input type="image" src="{{ $user->image }}" alt="プロフィール画像">
                                        <input type="hidden" value="{{ $user->user_id }}" name="directId">
                                    </form>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="txt">
                                    {!! nl2br(e($message->message)) !!}<br>
                                    <span>{{ $message->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @else
                            <li class="right-side">
                                <div class="name">
                                    {{ $message->user_name }}<br>
                                    @foreach($users as $user)
                                    @if($user->user_id == $message->user_id)
                                    <img src="{{ $user->image }}" alt="プロフィール画像"><br>
                                    @endif
                                    @endforeach
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
                <div class="card-body">
                    <form action="message" method="post">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control @error('Msg') is-invalid @enderror" name="Msg" placeholder="message" required autocomplete="Msg">{{ old('Msg') }}</textarea>
                            @error('Msg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">送信</button>
                            <input type="hidden" value="{{ $language }}" name="language">
                            <input type="hidden" value="{{ $auth->id }}" name="user_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
