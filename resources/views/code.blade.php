@extends('layouts')
@section('content')
    <div id="content">
        <div id="title"><a href="{{url('/')}}">首页</a> >> 代码管理</div>
        <div id="title"><a href="{{url('/create')}}">新增</a></div><br>
        <div id="gameinfo">
            <!-- 表格1开始 -->
            <table>
                <tr>
                    <th>游戏编号</th><th>游戏名称</th><th>PPID</th><th>激活状态</th>
                </tr>
                @foreach($result as $res)
                    <tr>
                        <td>{{$res->gamenumber}}</td><td>{{$res->gamename}}</td><td>{{$res->ppid}}</td><td>{{$res->status}}</td>
                    </tr>
                @endforeach
            </table>
            <!-- 表格1结束 -->
        </div>
    </div>
@endsection