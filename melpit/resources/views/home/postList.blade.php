@extends('layouts.app')
<link href="{{ asset('css/memo.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title">
                        <strong>掲示板</strong>
                    </div>
                    <div class="search" style="float: right;">
                        <form action="postList" method="get">
                            @csrf
                            <input type="text" name="key" placeholder="Search" style="width:100px; height:25px;">
                            <button type="submit" class="btn btn-primary btn-sm">検索</button>
                        </form>
                    </div>
                    <div class="Pagination" style="float: left;">
                        @if(isset($list))
                        {{ $list->links() }}
                        @else
                        {{$results->appends(request()->input())->links()}}
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="wrapperTwo">
                        @if(!isset($results))
                        @foreach($list as $value)
                        <table style="margin:10px auto; width:50%;">
                            <tr>
                                <td style="border:solid .5px rgb(214,214,214); padding:5px;">
                                    <table id="content" style="background-color:lightcyan;">
                                        <tr>
                                            <td>
                                                <a href="{{ action('MemoController@detail',$value->id) }}">
                                                    <p class="tdata">{{ $value->title }}</p>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <table id="content" style="background-color:white;">
                                        <tr>
                                            <td>
                                                <p class="tdata">{{ $value->content }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table><br>
                        @endforeach
                        @else
                        @foreach($results as $result)
                        <table style="margin:auto;">
                            <tr>
                                <td style="border:solid .5px rgb(214,214,214); padding:5px;">
                                    <table id="content" style="background-color:lightcyan;">
                                        <tr>
                                            <td>
                                                <a href="{{ action('MemoController@detail',$result->id) }}">
                                                    <p class="tdata">{{ $result->title }}</p>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <table id="content" style="background-color:white;">
                                        <tr>
                                            <td>
                                                <p class="tdata">{{ $result->content }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table><br>
                        @endforeach
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection