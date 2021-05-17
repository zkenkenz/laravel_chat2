@extends('layouts.app')
<link href="{{ asset('css/memo.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        <strong>編集画面</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="wrapper" style="padding: 0 50px;">
                        <form method="post" action="update">
                            @csrf
                            <table class="table table-bordered">

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">日付</label>
                                    <div class="col-md-6">
                                        <input id="date" type="date" class="form-control　@error('date') is-invalid @enderror" name="date" required value="{{ old('date') ? : $memo->date->format('Y-m-d')}}">
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
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror " name="title" required value="{{ old('title') ? : $memo->title}}">
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
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror " name="content" style="height: 200px;" required>{{ old('content') ? : $memo->content}}</textarea>
                                        @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="radio" style="margin:0 auto;">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="serect" id="inlineRadio1" value="1" <?php if ($memo->serect == 1) echo "checked" ?>>
                                            <label class="form-check-label" for="inlineRadio1">投稿する</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="serect" id="inlineRadio2" value="2" <?php if ($memo->serect == 2) echo "checked" ?>>
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
                                            編集する
                                        <input type="hidden" value="{{ $memo->id }}" name="memoId">
                                        </button>
                                    </div>
                                </div>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection