@extends('layouts.app')
<link href="{{ asset('css/talk.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if(isset($key1))
                <div class="card-header">
                    <div class="title" style=" text-align:center; font-size:17px;">
                        検索結果<strong>『{{ $key1 }}』</strong>
                    </div>
                </div>
                @else
                <div class="card-header" style="background-color:lightblue;">
                    <div class="title" style=" text-align:center; font-size:17px;">
                        検索結果<strong>『{{ $key2 }}』</strong>
                    </div>
                </div>
                @endif
                @if(isset($key1))
                <div class="card-body">
                    <div class="messages">
                        <ul class="messages">
                            @foreach($results as $result)
                            @if($auth->id != $result->user_id)
                            <li class="left-side">
                                <div class="name">
                                    {{ $result->user_name }}<br>
                                    @foreach($users as $user)
                                    @if($user->user_id == $result->user_id)
                                    <form action="privateRoom" method="get">
                                        @csrf
                                        <input type="image" src="storage/image/{{ $user->image }}" alt="プロフィール画像">
                                        <input type="hidden" value="{{ $result->user_id }}" name="directId">
                                    </form>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="txt">
                                    {{ $result->message }}<br>
                                    <span>{{ $result->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @else
                            <li class="right-side">
                                <div class="name">
                                    {{ $result->user_name }}<br>
                                    @foreach($users as $user)
                                    @if($user->user_id == $result->user_id)
                                    <img src="storage/image/{{ $user->image }}" alt="プロフィール画像">
                                    @endif
                                    @endforeach
                                </div>
                                <div class="txt">
                                    {{ $result->message }}<br>
                                    <span>{{ $result->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <div class="card-body" style="background-color:lightcyan">
                    <div class="messages">
                        <ul class="messages">
                            @if(isset($leftMessage))
                            @foreach($leftMessage as $message)
                            <li class="left-side">
                                <div class="name">
                                    @foreach($users as $user)
                                    @if($user->user_id == $message->user_id)
                                    {{ $user->nickName }}<br>
                                    <img src="storage/image/{{ $user->image }}" alt="プロフィール画像">
                                    @endif
                                    @endforeach
                                </div>
                                <div class="txt">
                                    {{ $message->message }}<br>
                                    <span>{{ $message->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @endforeach
                            @endif

                            @if(isset($rightMessage))
                            @foreach($rightMessage as $message)
                            <li class="right-side">
                                <div class="name">
                                    @foreach($users as $user)
                                    @if($user->user_id == $auth->id)
                                    {{ $user->nickName }}<br>
                                    <img src="storage/image/{{ $user->image }}" alt="プロフィール画像">
                                    @endif
                                    @endforeach
                                </div>
                                <div class="txt">
                                    {{ $message->message }}<br>
                                    <span>{{ $message->created_at->format('m/d H:i') }}</span>
                                </div>
                            </li>
                            @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection