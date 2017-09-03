@extends('layouts')
@section('content')
    <div style="padding: 15px;">
        <!-- 面包屑 -->
        <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a href="{{url('CodeInfo')}}">游戏基本信息</a>
            <a><cite>道具/代码基本信息</cite></a>
        </span>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>
        <!-- 提示信息显示区域 -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
    <!-- 代码配置编辑表单 -->
        <form method="post" class="layui-form" action="{{url('CodeInfoConf/'.$newedit['itemnumber'])}}">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="gamenumber" value="{{$newedit['gamenumber']}}">
            {!! csrf_field() !!}
            {!! $inputstr !!}
            <label class="layui-inline">激活:</label>
            <div class="layui-inline">
                <input type="checkbox" checked="" name="status" lay-skin="switch" lay-filter="switchTest" lay-text="YES|NO">
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-primary">编辑</button> <a href="{{url('CodeInfoConf/'.$newedit['gamenumber'])}}" class="layui-btn">取消</a>
            </div>
        </form>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>

        <!-- 代码分类列表 -->
        <table class="layui-table">
            {!! $tbstr !!}
        </table>
    </div>
@endsection