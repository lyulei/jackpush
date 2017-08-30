@extends('layouts')
@section('content')
    <div style="padding: 15px;">
        <!-- 面包屑 -->
        <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a href="{{url('CodeType')}}">代码类型</a>
            <a><cite>游戏/道具参数设置</cite></a>
        </span>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>
        <!-- 提示信息显示区域 -->
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
        <!-- 代码配置新增表单 -->
        <form method="post" class="layui-form" action="{{url('CodeConfig')}}">
            {!! csrf_field() !!}
            <input type="hidden" name="codeid" value="{{$codeid}}">
            <label class="layui-inline">参数类型:</label>
            <div class="layui-inline">
                <select name="type" lay-verify="">
                    <option value="1">游戏</option>
                    <option value="2">道具</option>
                </select>
            </div>
            <label class="layui-inline">字段名:</label>
            <div class="layui-inline">
                <input type="text" name="name" required  lay-verify="required" placeholder="请输入字段名" autocomplete="off" class="layui-input">
            </div>
            <label class="layui-inline">参数备注:</label>
            <div class="layui-inline">
                <input type="text" name="remarks" required  lay-verify="required" placeholder="请输入参数备注" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-primary">新增</button>
            </div>
        </form>

        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>
        <!-- 游戏/道具参数设置 -->
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
            </colgroup>
            <thead>
            <tr>
                <th>参数类型</th>
                <th>字段名</th>
                <th>参数备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <th>@if($d->type == 1)游戏@else道具@endif</th>
                    <th>{{$d->name}}</th>
                    <th>{{$d->remarks}}</th>
                    <th>
                        <a href="{{url('CodeConfig/'.$d->id.'/edit')}}">编辑</a> |
                        <a href="javascript:;" onclick="delCodeConfig({{$d->id}})">删除</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        // 删除
        function delCodeConfig(id) {
            //一般直接写在一个js文件中
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer
                    ,form = layui.form;
                //询问框
                layer.confirm('确定删除这个参数吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    $.post("{{url('CodeConfig')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                        if(data.status == 1){
                            location.href = location.href;
                            layer.msg(data.message, {icon: 1});
                        } else {
                            layer.msg(data.message, {icon: 2});
                        }
                    })
                    //layer.msg('的确很重要', {icon: 1});
                }, function(){

                });
            });
        }
    </script>
@endsection