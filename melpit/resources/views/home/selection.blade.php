@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"  style="text-align: center;">
                    <strong>参加したいトークを選んでください</strong>
                </div>
                <div class="card-body">
                    <div class="wrapper" style="display: flex; flex-wrap: wrap; justify-content: center; text-align: center; padding:100px;">
                            @foreach($value as $image)
                            @if($image == "")
                            <form action="talk" method="get" name="talk">
                                @csrf
                                <a href="javascript:talk.submit()"><img src="storage/image/html_css.png" class="image" style="width: 200px; height: 200px; margin: 20px ;border:solid 1px rgb(229,229,229); border-radius: 30%;"></a>
                            </form>
                            @else
                            <form action="talk" method="get" name="{{ $image }}">
                                @csrf
                                <a href="javascript:{{ $image }}.submit()"><img src="storage/image/{{$image}}.png" class="image" style="width: 200px; height: 200px; margin: 20px ;border:solid 1px rgb(229,229,229); border-radius: 30%;"></a>
                                <input type="hidden" value="{{ $image }}" name="language">
                            </form>
                            @endif
                            @endforeach
                       
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection