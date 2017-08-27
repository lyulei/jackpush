@extends('layouts')
@section('content')
<div style="padding: 15px;">
    <!-- 面包屑 -->
    <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a><cite>代码分类</cite></a>
    </span>

    <!-- 空白段落 -->
    <div style="margin: 15px 0;"></div>

    <!-- 提示信息显示区域 -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif

    <!-- 代码分类编辑表单 -->
    <form method="post" class="layui-form" action="{{url('CodeSpecies/'.$edit->codetypeid)}}">
        <input type="hidden" name="_method" value="put">
        {!! csrf_field() !!}
        <label class="layui-inline">代码类型:</label>
        <div class="layui-inline">
            <input type="text" name="codetype" required  lay-verify="required" placeholder="请输入代码类型" autocomplete="off" class="layui-input" value="{{$edit->codetype}}">
        </div>
        <label class="layui-inline">父级分类:</label>
        <div class="layui-inline">
            <select name="speciesid" lay-verify="">
                {{$selected = 'selected="selected"'}}
                <option value="1" @if($edit->speciesid == 1){{$selected}}@endif>移动</option>
                <option value="2" @if($edit->speciesid == 2){{$selected}}@endif>联通</option>
                <option value="3" @if($edit->speciesid == 3){{$selected}}@endif>电信</option>
                <option value="4" @if($edit->speciesid == 4){{$selected}}@endif>短信类型</option>
            </select>
        </div>
        <div class="layui-inline">
            <button class="layui-btn layui-btn-primary">编辑</button> <a href="{{url('CodeSpecies')}}" class="layui-btn">取消</a>
        </div>
    </form>

    <!-- 空白段落 -->
    <div style="margin: 15px 0;"></div>

    <!-- 代码分类列表 -->
    <table class="layui-table">
        <colgroup>
            <col width="100">
            <col width="100">
            <col width="100">
            <col width="100">
        </colgroup>
        <thead>
        <tr>
            <th>分类编号</th>
            <th>代码类型</th>
            <th>父级分类</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $res)
            <tr>
                <td>{{$res->codetypeid}}</td>
                <td>{{$res->codetype}}</td>
                <td>@if($res->speciesid == 1)移动@elseif($res->speciesid == 2)联通@elseif($res->speciesid == 3)电信@else($res->speciesid == 4)短信类型@endif</td>
                <td><a href="{{url('CodeSpecies/'.$res->codetypeid.'/edit')}}">编辑</a> | <a href="javascript:;" onclick="delCodeSpecies({{$res->codetypeid}})">删除</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection