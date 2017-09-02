@extends('layouts')
@section('content')
    <div style="padding: 15px;">
        <!-- 面包屑 -->
        <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a><cite>游戏基本信息</cite></a>
        </span>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>
        <!-- 提示信息显示区域 -->
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
        <!-- 代码基本信息新增表单 -->
        <form method="post" class="layui-form" action="{{url('CodeInfo')}}">
            {!! csrf_field() !!}
            <label class="layui-inline">游戏名称:</label>
            <div class="layui-inline">
                <input type="text" name="gamename" required  lay-verify="required" placeholder="请输入游戏名称" autocomplete="off" class="layui-input">
            </div>
            {!! $inputstr !!}
            <label class="layui-inline">激活:</label>
            <div class="layui-inline">
                <input type="checkbox" checked="" name="status" lay-skin="switch" lay-filter="switchTest" lay-text="YES|NO">
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-primary">新增</button>
            </div>
        </form>

        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>

        <!-- 代码分类列表 -->
        <table class="layui-table">
            {!! $tbstr !!}
        </table>
    </div>
    <script>
        // 删除
        function delCodeInfo(id) {
            //一般直接写在一个js文件中
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer
                    ,form = layui.form;
                //询问框
                layer.confirm('确定删除这个游戏配置信息吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    $.post("{{url('CodeInfo')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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