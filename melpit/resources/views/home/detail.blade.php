@extends('layouts.app')
<link href="{{ asset('css/memo.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @foreach($detail as $value)
                <div class="card-header">
                    <div class="title">
                        <strong>{{ $value->title }}</strong>
                    </div>
                    @if($auth->id === $value->user_id )
                    <div class="btn" style="float: right;  padding:3px;">
                        <form action="delete" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm" onClick="delete_alert(event);return false;">削除</button>
                            <input type="hidden" value="{{ $value->id }}" name="memoId">
                        </form>
                    </div>
                    <div class="btn" style="float: right; padding:3px;">
                        <form action="edit" method="get">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm">編集</button>
                            <input type="hidden" value="{{ $value->id }}" name="memoId">
                        </form>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="wrapperTwo">
                        <table style="margin:0 auto; width:100%;">
                            <tr>
                                <td>
                                    <table id="content" style="background-color:azure; border:solid .5px rgb(214,214,214); margin:10px auto;">
                                        <tr>
                                            <td>
                                                {!! nl2br(e($value->content)) !!}
                                            </td>
                                        </tr>
                                    </table>
                                    @if($image != 'NULL')
                                    <table id="content">
                                        <tr>
                                            <td>
                                            <img src="{{ $image }}" alt="プロフィール画像" style="width: 50%; max-height:50hv; border:solid 1px rgb(229,229,229);">
                                            </td>
                                        </tr>
                                    </table>
                                    @endif
                                    <table id="content" style="background-color:darkgray; border:solid .5px rgb(214,214,214);">
                                        <tr>
                                            <td>
                                                {{ $value->date->format('Y-m-d') }}<br>
                                                {{ $nickName->nickName }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function delete_alert(e) {
        if (!window.confirm('メモを削除しますか？')) {
            window.alert('キャンセルしました');
            return false;
        }
        document.deleteform.submit();
    };
</script>