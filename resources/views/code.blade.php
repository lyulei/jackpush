@extends('layouts')
@section('content')
    <div id="content">
        <div id="title"><a href="{{url('/')}}">首页</a> >> 代码管理</div>

        <div id="gameinfo">
            <!-- 样式表 开始 -->

            <!-- 样式表 结束 -->
            <!-- 表格1开始 -->
            @foreach($result as $res)
                {{$res->gamenumber}}{{$res->gamename}}{{$res->ppid}}{{$res->status}}
            @endforeach
            <!-- 表格1结束 -->
        </div>
    </div>
@endsection