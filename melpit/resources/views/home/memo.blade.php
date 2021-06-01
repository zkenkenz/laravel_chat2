@extends('layouts.app')
<link href="{{ asset('css/memo.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        <strong>メモ</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="wrapper" style="padding: 0 50px;">
                        <form method="post" action="add" enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered">

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">日付</label>

                                    <div class="col-md-6">
                                        <input id="date" type="date" class="form-control　@error('date') is-invalid @enderror" name="date" required value="{{ old('date') }}">
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">タイトル</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror " name="title" required value="{{ old('title') }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-md-4 col-form-label text-md-right">内容</label>
                                    <div class="col-md-6">
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror " name="content" style="height: 200px;" required>{{ old('content') }}</textarea>
                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img" class="col-md-4 col-form-label text-md-right">画像</label>
                                    <div class="col-md-6">
                                        <input class="form-control form-control-sm" id="img" type="file" name="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="radio" style="margin:0 auto;">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="serect" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">投稿する</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="serect" id="inlineRadio2" value="2" checked>
                                            <label class="form-check-label" for="inlineRadio2">投稿しない</label>
                                        </div>
                                        @error('serect')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class=" form-group row mb-0">
                                    <div class="col-md-4 offset-md-8">
                                        <button type="button" class="btn btn-primary" onclick="submit();">
                                            登録する
                                        </button>
                                        <input type="hidden" value="{{ $auth->id }}" name="user_id">
                                    </div>
                                </div>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="wrapperTwo">

                        @foreach($memos as $memo)
                        <table style="margin:0 auto; width:50%;">
                            <tr>
                                <td style="border:solid .5px rgb(214,214,214);">
                                    @if($memo->serect === 1)
                                    <table id="content" style="background-color:lightcyan">
                                        <tr>
                                            <td>
                                                <p class="tdata">◯{{ $memo->date->format('Y-m-d') }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                    @elseif($memo->serect === 2)
                                    <table id="content" style="background-color:gainsboro;">
                                        <tr>
                                            <td>
                                                <p class="tdata">{{ $memo->date->format('Y-m-d') }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif
                                    <table id="content" style="background-color:white;">
                                        <tr>
                                            <td>
                                                <a href="{{ action('MemoController@detail',$memo->id) }}">
                                                    <p class="tdata">{{ $memo->title }}</p>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table><br>
                        @endforeach
                    </div>
                    <div class="message" style="text-align: center;">
                        ※投稿されているメモには◯が付いています
                    </div>
                    <div class="Pagination" style="float: right;">
                        {{ $memos->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection